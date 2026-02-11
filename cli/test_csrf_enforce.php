<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Core/Security.php';

// Simulate GET (should no-op)
$_SERVER['REQUEST_METHOD'] = 'GET';
if (!enforce_csrf_on_post(false)) {
    echo "GET incorrectly enforced\n";
    exit(1);
}

// Simulate POST without token
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [];
$res = enforce_csrf_on_post(false);
if ($res !== false) {
    echo "POST without token should fail\n";
    exit(1);
}

// Simulate POST with token
$_SESSION = [];
if (session_status() === PHP_SESSION_NONE) session_start();
$token = csrf_token();
$_POST['_csrf'] = $token;
$res2 = enforce_csrf_on_post(false);
if ($res2 !== true) {
    echo "POST with token should pass\n";
    exit(1);
}

echo "CSRF enforcement tests passed\n";
exit(0);
