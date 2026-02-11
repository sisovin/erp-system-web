<?php
// insert an audit row for yesterday so the generator has something to export
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();
$yesterday = date('Y-m-d H:i:s', strtotime('-1 day'));
$pdo->prepare('INSERT INTO audit_logs (action, user_id, model, created_at, severity) VALUES (?, ?, ?, ?, ?)')
    ->execute(['scheduled_export_test', 1, 'test', $yesterday, 'info']);

require_once __DIR__ . '/generate_scheduled_exports.php';
// after running, check audit_exports table for last entry
$stmt = $pdo->query("SELECT * FROM audit_exports ORDER BY id DESC LIMIT 1");
$row = $stmt->fetch();
if (!$row) { echo "No export record found\n"; exit(1); }
if (!file_exists($row['path'])) { echo "Export file not found at path: {$row['path']}\n"; exit(1); }
echo "Scheduled export test passed: {$row['filename']}\n"; exit(0);
