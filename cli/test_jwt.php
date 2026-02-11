<?php
require_once __DIR__ . '/../app/Core/JwtService.php';

// generate and decode
$token = JwtService::generateToken(1, 3600, ['csrf' => 'deadbeef']);
$payload = JwtService::decodeToken($token);
if (!$payload) {
    echo "Failed to decode token\n";
    exit(1);
}

if ($payload['sub'] !== 1 || $payload['csrf'] !== 'deadbeef') {
    echo "Payload mismatch\n";
    exit(1);
}

echo "JWT generate/validate OK: token={$token}\n";
exit(0);
