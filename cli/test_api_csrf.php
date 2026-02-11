<?php
require_once __DIR__ . '/../app/Core/JwtService.php';
require_once __DIR__ . '/../app/Core/ApiAuth.php';

// generate token with csrf
$csrf = bin2hex(random_bytes(16));
$token = JwtService::generateToken(1, 3600, ['csrf' => $csrf]);

// simulate header
$_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . $token;
$GLOBALS['api_jwt_payload'] = null;
$payload = require_api_auth(false);
if (!$payload) {
    echo "API auth failed\n";
    exit(1);
}

// simulate missing header
$_SERVER['HTTP_X_CSRF_TOKEN'] = null;
$res = api_require_csrf(false);
if ($res !== false) {
    echo "CSRF should fail when header missing\n";
    exit(1);
}

// simulate correct header
$_SERVER['HTTP_X_CSRF_TOKEN'] = $csrf;
$payload = require_api_auth(false);
$res2 = api_require_csrf(false);
if ($res2 !== true) {
    echo "CSRF header verification failed\n";
    exit(1);
}

echo "API CSRF verification passed\n";
exit(0);
