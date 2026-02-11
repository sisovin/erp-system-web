<?php
require_once __DIR__ . '/../app/Services/RefreshTokenService.php';

// create initial token
$rt = RefreshTokenService::createForUser(1, 300);
$old = $rt['token'];
echo "Initial token: $old\n";

// rotate once -> should return new
$rot1 = RefreshTokenService::rotate($old);
if (!$rot1) { echo "Rotation 1 failed\n"; exit(1); }
$new = $rot1['new']['token'];
echo "Rotated -> new: $new\n";

// attempt to rotate old token again (replay) -> should trigger revokeAll and return null
$rot2 = RefreshTokenService::rotate($old);
if ($rot2 !== null) { echo "Replay not detected (unexpected)\n"; exit(1); }

echo "Replay detected and handled\n";

// ensure new token invalidated (revoked) and cannot be found
$still = RefreshTokenService::findByRawToken($new);
if ($still) { echo "New token still valid after replay handling (expected revoked)\n"; exit(1); }

echo "Replay detection test passed\n";
exit(0);
