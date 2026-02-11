<?php
// Create a schedule set to now and run generator with --run-schedule override
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
require_once __DIR__ . '/../app/Repositories/ScheduledExportRepository.php';

$pdo = Database::getPdo();
try {
    $pdo->query('SELECT 1 FROM scheduled_exports LIMIT 1');
} catch (Exception $e) {
    echo "scheduled_exports table missing; run php cli/migrate_scheduled_exports.php and patch first\n";
    exit(1);
}

// insert a dummy audit log
$pdo->prepare("INSERT INTO audit_logs (action, user_id, model, model_id, before_data, after_data, ip, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())")->execute([
    'test_action', 1, 'test', 1, '{}', '{}', '127.0.0.1'
]);

$now = new DateTime();
$time = $now->format('H:i');

$s = new \app\Models\ScheduledExport();
$s->name = 'Run now test';
$s->description = 'Test schedule to run now';
$s->columns = 'id,action,user_id,created_at';
$s->format = 'csv';
$s->retention_days = 7;
$s->upload_to_s3 = 0;
$s->enabled = 1;
$s->schedule_type = 'daily';
$s->schedule_time = $time;
s->created_by = 1;
\app\Repositories\ScheduledExportRepository::save($s);

// run generator normally (it will detect due since schedule_time is now)
echo "Running generator...\n";
$cmd = PHP_BINARY . ' ' . __DIR__ . '/generate_scheduled_exports.php';
$out = [];
$code = 0;
exec($cmd, $out, $code);
foreach ($out as $line) echo $line . "\n";
if ($code !== 0) {
    echo "Generator exited with code $code\n";
    exit(1);
}

// check export
$stmt = $pdo->query('SELECT * FROM audit_exports ORDER BY id DESC LIMIT 1');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    echo "Export record created: " . $row['filename'] . "\n";
    echo "Path: " . $row['path'] . "\n";
    exit(0);
}

echo "No export record found\n";
exit(1);
