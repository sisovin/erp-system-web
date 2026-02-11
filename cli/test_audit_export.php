<?php
require_once __DIR__ . '/../app/Services/AuditService.php';
// insert a known audit entry
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();
$pdo->prepare('INSERT INTO audit_logs (user_id, action, model, model_id, before_data, after_data, ip, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')
    ->execute([1,'export_test','refresh_tokens',null,json_encode(['a'=>1]),json_encode(['b'=>2]),'127.0.0.1', date('Y-m-d H:i:s')]);

$entries = AuditService::queryEntries(null, null, null, 100, 0);
$csv = fopen('php://temp', 'r+');
fputcsv($csv, ['id','action','user_id','model','model_id','before_data','after_data','ip','created_at'], ',', '"', '\\');
foreach ($entries as $e) fputcsv($csv, [$e['id'],$e['action'],$e['user_id'],$e['model'],$e['model_id'],$e['before_data'],$e['after_data'],$e['ip'],$e['created_at']], ',', '"', '\\');
rewind($csv);
$contents = stream_get_contents($csv);
if (strpos($contents, "export_test") === false) { echo "Export content missing\n"; exit(1); }

echo "Audit export test OK (contains export_test)\n";
exit(0);
