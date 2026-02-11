<?php
// Generate scheduled daily audit exports (previous day) and save to storage
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/ExportService.php';
require_once __DIR__ . '/../app/Services/AuditService.php';
require_once __DIR__ . '/../app/Services/Database.php';

// Config
$enabled = env('AUDIT_EXPORT_SCHEDULE_ENABLE', 'true');
if ($enabled !== 'true' && $enabled !== true) {
    echo "Audit export scheduling disabled.\n";
    exit(0);
}

$daysBack = (int) env('AUDIT_EXPORT_DAILY_RANGE_DAYS', 1); // number of days back to include
$expiresDays = (int) env('AUDIT_EXPORT_RETENTION_DAYS', 30);
$columnsEnv = env('AUDIT_EXPORT_COLUMNS', 'id,action,user_id,model,model_id,before_data,after_data,ip,created_at');
$columns = array_map('trim', explode(',', $columnsEnv));

// For yesterday
$start = date('Y-m-d', strtotime("-{$daysBack} days"));
$end = date('Y-m-d', strtotime('-1 day'));

function isScheduleDue($s, DateTime $now, int $windowMinutes = 15): bool
{
    // If schedule_type is daily, check schedule_time (HH:MM)
    $type = $s->schedule_type ?? 'daily';
    if ($type === 'daily') {
        if (empty($s->schedule_time)) return true; // no time set -> run
        $sched = DateTime::createFromFormat('H:i:s', $s->schedule_time);
        if (!$sched) $sched = DateTime::createFromFormat('H:i', $s->schedule_time);
        if (!$sched) return true;
        // combine today's date with scheduled time
        $scheduled = DateTime::createFromFormat('Y-m-d H:i:s', $now->format('Y-m-d') . ' ' . $sched->format('H:i:s'));
        $diff = ($now->getTimestamp() - $scheduled->getTimestamp()) / 60; // minutes
        // due if within [0, windowMinutes)
        return $diff >= 0 && $diff < $windowMinutes;
    }

    if ($type === 'cron') {
        $expr = $s->schedule_cron ?? '';
        if (empty($expr)) return false;
        try {
            $cron = \Cron\CronExpression::factory($expr);
            return $cron->isDue($now);
        } catch (\Exception $e) {
            return false;
        }
    }

    return false;
}

$now = new DateTime();

// CLI override: --run-schedule={id}
$runScheduleId = null;
if (isset($argv) && is_array($argv)) {
    foreach ($argv as $arg) {
        if (str_starts_with($arg, '--run-schedule=')) {
            $parts = explode('=', $arg, 2);
            $runScheduleId = (int)($parts[1] ?? 0);
        }
    }
}

$handled = false;
// If scheduled_exports table exists, iterate enabled schedules and run due ones
try {
    $pdo = app\Services\Database::getPdo();
    $stmt = $pdo->query("SELECT 1 FROM scheduled_exports LIMIT 1");
    if ($stmt) {
        require_once __DIR__ . '/../app/Repositories/ScheduledExportRepository.php';
        require_once __DIR__ . '/../app/Services/NotificationService.php';
        $schedules = app\Repositories\ScheduledExportRepository::allEnabled();
        foreach ($schedules as $s) {
            // if CLI override, only run that schedule id
            if ($runScheduleId && $runScheduleId !== (int)$s->id) continue;

            if (!$runScheduleId && !isScheduleDue($s, $now, 15)) {
                continue;
            }

            // ensure we haven't run this schedule recently: check last_run_at
            $last = $s->last_run_at ? new DateTime($s->last_run_at) : null;
            if ($last && $last->format('Y-m-d H:i') === $now->format('Y-m-d H:i')) {
                // already ran in this minute
                continue;
            }

            $cols = $s->columns ? array_map('trim', explode(',', $s->columns)) : $columns;
            $fmt = $s->format ?: 'csv';
            $ret = $s->retention_days ?: $expiresDays;
            $note = "Scheduled export ({$s->name}) for {$start} to {$end}";

            $entries = AuditService::queryEntries(null, $start, $end, 10000, 0);
            if (!$entries) {
                echo "No audit entries to export for {$start} - {$end} (schedule: {$s->name})\n";
                continue;
            }

            $result = ExportService::saveAuditExport($entries, $cols, $fmt, $ret, null, $note);

            $uploaded = false;
            if ($s->upload_to_s3 && env('AWS_S3_BUCKET', null)) {
                $uploaded = ExportService::uploadToS3($result);
            }

            // update last_run_at
            $upd = $pdo->prepare("UPDATE scheduled_exports SET last_run_at = NOW() WHERE id = :id");
            $upd->execute(['id' => $s->id]);

            $payload = ['filename' => $result['filename'], 'path' => $result['path'], 'uploaded' => $uploaded, 'schedule_id' => $s->id];
            AuditService::log(null, 'audit_export_created', 'audit_exports', $result['id'], null, $payload, null, 'info');

            // send notification (Slack + email) if configured
            app\Services\NotificationService::notifyExportCreated(array_merge($result, ['public_url' => $uploaded ? ExportService::getS3Url($result) : $result['path']]), $uploaded);

            echo "Export created (schedule: {$s->name}): " . $result['filename'] . ($uploaded ? ' (uploaded to S3)' : '') . "\n";
            $handled = true;
        }
    }
} catch (\Exception $e) {
    // table does not exist or other DB issue; fallback to env-based single scheduled export
}

if (!$handled) {
    $entries = AuditService::queryEntries(null, $start, $end, 10000, 0);
    if (!$entries) {
        echo "No audit entries to export for {$start} - {$end}\n";
        exit(0);
    }

    $note = "Scheduled export for {$start} to {$end}";
    $result = ExportService::saveAuditExport($entries, $columns, 'csv', $expiresDays, null, $note);

    // Try upload to S3 if configured
    $uploaded = false;
    if (env('AWS_S3_BUCKET', null)) {
        $uploaded = ExportService::uploadToS3($result);
    }

    // Log the export
    require_once __DIR__ . '/../app/Services/AuditService.php';
    $payload = ['filename' => $result['filename'], 'path' => $result['path'], 'uploaded' => $uploaded];
    AuditService::log(null, 'audit_export_created', 'audit_exports', $result['id'], null, $payload, null, 'info');

    // send notification (Slack + email) if configured
    require_once __DIR__ . '/../app/Services/NotificationService.php';
    app\Services\NotificationService::notifyExportCreated(array_merge($result, ['public_url' => $uploaded ? ExportService::getS3Url($result) : $result['path']]), $uploaded);

    echo "Export created: " . $result['filename'] . ($uploaded ? ' (uploaded to S3)' : '') . "\n";
}
exit(0);
