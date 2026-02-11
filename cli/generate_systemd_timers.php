<?php
// Generate per-schedule systemd unit + timer files for daily schedules with times
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';

$pdo = app\Services\Database::getPdo();
try {
    $stmt = $pdo->query("SELECT * FROM scheduled_exports WHERE enabled = 1 AND schedule_type = 'daily' AND schedule_time IS NOT NULL");
    $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    echo "No scheduled_exports table or error: " . $e->getMessage() . "\n";
    exit(1);
}

$dir = __DIR__ . '/../deploy/systemd';
if (!is_dir($dir)) mkdir($dir, 0755, true);

foreach ($rows as $r) {
    $id = (int)$r['id'];
    $time = $r['schedule_time']; // HH:MM:SS
    $parts = explode(':', $time);
    $hour = $parts[0] ?? '00';
    $min = $parts[1] ?? '00';

    $service = "[Unit]\nDescription=Scheduled export ({$r['name']})\nAfter=network.target\n\n[Service]\nType=oneshot\nUser=www-data\nGroup=www-data\nWorkingDirectory=/var/www/erp-system\nExecStart=/usr/bin/php /var/www/erp-system/cli/generate_scheduled_exports.php --run-schedule={$id}\n\n[Install]\nWantedBy=multi-user.target\n";

    $timer = "[Unit]\nDescription=Timer for scheduled export ({$r['name']})\n\n[Timer]\nOnCalendar=*-*-* {$hour}:{$min}:00\nPersistent=true\n\n[Install]\nWantedBy=timers.target\n";

    $svcFile = $dir . "/scheduled-export-{$id}.service";
    $tFile = $dir . "/scheduled-export-{$id}.timer";
    file_put_contents($svcFile, $service);
    file_put_contents($tFile, $timer);
    echo "Generated: {$svcFile} and {$tFile}\n";
}

exit(0);
