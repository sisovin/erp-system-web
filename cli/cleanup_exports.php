<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/ExportService.php';

$days = (int) env('EXPORT_CLEANUP_DAYS', 7);
$deleted = ExportService::cleanupExpired($days);
echo "Cleanup complete. deleted=$deleted\n";
exit(0);
