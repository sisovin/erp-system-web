<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Repositories/UserRepository.php';

$repo = new UserRepository();
$user = $repo->findByEmail(DEFAULT_ADMIN_EMAIL);
if (!$user) {
    echo "Admin user not found\n";
    exit(1);
}

$attempt = DEFAULT_ADMIN_PASSWORD;
if (password_verify($attempt, $user->password)) {
    echo "Password verified for {$user->email}\n";
    exit(0);
}

echo "Password verification failed\n";
exit(1);
