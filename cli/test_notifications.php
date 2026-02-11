<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Repositories/SettingsRepository.php';
require_once __DIR__ . '/../app/Services/NotificationService.php';

// set temporary settings
\app\Repositories\SettingsRepository::set('notify_emails', 'devnull@example.com');
// Optionally set SMTP server for local test
// \app\Repositories\SettingsRepository::set('smtp_host', '127.0.0.1');
// \app\Repositories\SettingsRepository::set('smtp_port', '1025');

$export = ['filename' => 'test_export.csv', 'path' => '/tmp/test_export.csv'];
$res = \app\Services\NotificationService::notifyExportCreated($export, false);
if ($res) echo "Notification sent\n"; else echo "Notification failed or not configured\n";
