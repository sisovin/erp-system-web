<?php
// Purge old audit logs and expired refresh tokens
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';

$pdo = Database::getPdo();
$daysAudit = (int) env('AUDIT_RETENTION_DAYS', 90);
$daysRefreshKeep = (int) env('REFRESH_TOKEN_RETENTION_DAYS', 30);

$cutAudit = date('Y-m-d H:i:s', strtotime("-{$daysAudit} days"));
$cutRefresh = date('Y-m-d H:i:s', strtotime("-{$daysRefreshKeep} days"));

echo "Purging audit_logs older than $cutAudit...\n";
$stmtA = $pdo->prepare('DELETE FROM audit_logs WHERE created_at < ?');
$stmtA->execute([$cutAudit]);
$deletedA = $stmtA->rowCount();

echo "Purging refresh_tokens expired before $cutRefresh or revoked before $cutRefresh...\n";
$stmtR = $pdo->prepare('DELETE FROM refresh_tokens WHERE (expires_at IS NOT NULL AND expires_at < ?) OR (revoked = 1 AND last_used_at IS NOT NULL AND last_used_at < ?)');
$stmtR->execute([$cutRefresh, $cutRefresh]);
$deletedR = $stmtR->rowCount();

echo "Purge complete. audit_logs_deleted=$deletedA, refresh_tokens_deleted=$deletedR\n";
exit(0);
