<?php
require_once __DIR__ . '/../app/Services/RefreshTokenService.php';
require_once __DIR__ . '/../app/Services/AuditService.php';

// create token
$rt = RefreshTokenService::createForUser(1, 300);
$old = $rt['token'];

// rotate once
$rot1 = RefreshTokenService::rotate($old);
if (!$rot1) { echo "Rotation 1 failed\n"; exit(1); }
$new = $rot1['new']['token'];

// rotate old (replay)
$rot2 = RefreshTokenService::rotate($old);
if ($rot2 !== null) { echo "Replay not detected\n"; exit(1); }

// check audit entries
$entries = AuditService::lastEntriesForAction('refresh_token_replay_detected', 5);
if (count($entries) === 0) { echo "No replay audit entry found\n"; exit(1); }

$entries2 = AuditService::lastEntriesForAction('revoked_all_refresh_tokens', 5);
if (count($entries2) === 0) { echo "No revoke-all audit entry found\n"; exit(1); }

echo "Audit entries present for replay and revoke-all\n";
exit(0);
