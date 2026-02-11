<?php
require_once __DIR__ . '/../app/Services/RefreshTokenService.php';

// create for user 1
$rt = RefreshTokenService::createForUser(1, 60);
$raw = $rt['token'];
echo "Created refresh token: $raw\n";

// find it
$found = RefreshTokenService::findByRawToken($raw);
if (!$found) { echo "Failed to find token\n"; exit(1); }

echo "Found token id={$found['id']}\n";

// rotate
$rot = RefreshTokenService::rotate($raw);
if (!$rot) { echo "Rotation failed\n"; exit(1); }

echo "Rotated: new={$rot['new']['token']} user_id={$rot['user_id']}\n";

// old token should no longer be valid
$oldCheck = RefreshTokenService::findByRawToken($raw);
if ($oldCheck) { echo "Old token still valid, rotation incomplete\n"; exit(1); }

echo "Old token invalidated, rotation OK\n";

// revoke the new token
$ok = RefreshTokenService::revoke($rot['new']['token']);
if (!$ok) { echo "Failed to revoke new token\n"; exit(1); }

echo "Revoke succeeded\n";
exit(0);
