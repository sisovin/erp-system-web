<?php
require_once __DIR__ . '/../app/Services/ExportService.php';
// create dummy entries
$entries = [ ['id'=>1,'action'=>'test','user_id'=>1,'model'=>null,'model_id'=>null,'before_data'=>null,'after_data'=>null,'ip'=>'127.0.0.1','created_at'=>date('Y-m-d H:i:s')] ];
$columns = ['id','action','user_id','created_at'];
$res = ExportService::saveAuditExport($entries, $columns, 'csv', 1, 1, 'test upload');
if (!$res) { echo "Save failed\n"; exit(1); }
$uploaded = ExportService::uploadToS3($res);
// upload may be false if AWS not configured; that's acceptable. Ensure file exists if not uploaded
if (!$uploaded) {
    if (!file_exists($res['path'])) { echo "File missing after save\n"; exit(1); }
    echo "Saved locally: {$res['filename']}\n";
    exit(0);
}

echo "Uploaded to S3: {$res['filename']}\n";
exit(0);
