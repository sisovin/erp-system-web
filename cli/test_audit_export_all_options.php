<?php
require_once __DIR__ . '/../app/Services/AuditService.php';
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();

// Insert some rows in a specific date range
$now = date('Y-m-d H:i:s');
$pdo->prepare('INSERT INTO audit_logs (action, user_id, model, created_at) VALUES (?, ?, ?, ?)')
    ->execute(['export_all_test', 1, 'test', $now]);

// Query with date range
$start = date('Y-m-d');
$end = date('Y-m-d');
$rows = AuditService::queryEntries('export_all_test', $start, $end, 100, 0);
if (count($rows) === 0) { echo "No rows found for export test\n"; exit(1); }

// Build CSV with selected columns
$cols = ['id','action','created_at'];
$csv = fopen('php://temp', 'r+');
fputcsv($csv, $cols, ',', '"', '\\');
foreach ($rows as $e) {
    $line = [];
    foreach ($cols as $c) $line[] = $e[$c] ?? '';
    fputcsv($csv, $line, ',', '"', '\\');
}
rewind($csv);
$contents = stream_get_contents($csv);
if (strpos($contents, 'export_all_test') === false) { echo "CSV missing data\n"; exit(1); }

// Test JSON export format
$out = [];
foreach ($rows as $e) {
    $row = [];
    foreach ($cols as $c) $row[$c] = $e[$c] ?? null;
    $out[] = $row;
}
$json = json_encode($out);
if (strpos($json, 'export_all_test') === false) { echo "JSON missing data\n"; exit(1); }

echo "Export options test passed\n";
exit(0);
