<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Repositories/UserRepository.php';

$repo = new UserRepository();
$user = $repo->findByEmail(DEFAULT_ADMIN_EMAIL);
if ($user) {
    echo "Found user: {$user->id} - {$user->name} ({$user->email})\n";
    exit(0);
}

echo "User not found\n";
exit(1);
