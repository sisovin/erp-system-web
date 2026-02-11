<?php
// Test purge: insert old audit log and old refresh token, run purge, verify deletion
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
require_once __DIR__ . '/../app/Services/RefreshTokenService.php';

$pdo = Database::getPdo();
// insert an old audit entry
$oldDate = date('Y-m-d H:i:s', strtotime('-400 days'));
$stmt = $pdo->prepare('INSERT INTO audit_logs (action, created_at) VALUES (?, ?)');
$stmt->execute(['test_old_audit', $oldDate]);
$aid = $pdo->lastInsertId();

// create refresh token and mark it expired long ago
$rt = RefreshTokenService::createForUser(1, 1);
$raw = $rt['token'];
$found = RefreshTokenService::findByRawToken($raw, true);
if (!$found) { echo "Failed to create refresh token\n"; exit(1); }
// update expires_at to old date
$oldRefreshDate = date('Y-m-d H:i:s', strtotime('-400 days'));
$pdo->prepare('UPDATE refresh_tokens SET expires_at = ? WHERE id = ?')->execute([$oldRefreshDate, $found['id']]);

// run purge via PHP binary
$cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__DIR__ . '/purge_expired.php');
$out = shell_exec($cmd);
// verify audit deleted
$s = $pdo->prepare('SELECT id FROM audit_logs WHERE id = ?');
$s->execute([$aid]);
if ($s->fetch()) { echo "Audit not deleted\n"; exit(1); }

// verify refresh deleted
$still = RefreshTokenService::findByRawToken($raw, true);
if ($still) { echo "Refresh token not deleted\n"; exit(1); }

echo "Purge test passed\n";
exit(0);
