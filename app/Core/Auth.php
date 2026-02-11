<?php
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/../Repositories/UserRepository.php';

function current_user(): ?User
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    $repo = new UserRepository();
    return $repo->findById((int) $_SESSION['user_id']);
}

function require_login()
{
    $u = current_user();
    if (!$u) {
        header('Location: /login');
        exit;
    }
    return $u;
}
