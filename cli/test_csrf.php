<?php
require_once __DIR__ . '/../app/Core/Security.php';

$token = csrf_token();
if (empty($token)) {
    echo "Failed to generate CSRF token\n";
    exit(1);
}

if (!csrf_verify($token)) {
    echo "CSRF verification failed\n";
    exit(1);
}

echo "CSRF token generated and verified OK: $token\n";
exit(0);
