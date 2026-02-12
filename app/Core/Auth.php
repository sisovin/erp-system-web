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

/**
 * Check if the current user has a specific permission
 */
function has_permission(string $permission): bool
{
    $user = current_user();
    if (!$user) {
        return false;
    }
    
    $repo = new UserRepository();
    return $repo->hasPermission($user->id, $permission);
}

/**
 * Require that the current user has a specific permission
 * Sends 403 Forbidden and exits if permission is missing
 */
function require_permission(string $permission): void
{
    $user = require_login();
    
    $repo = new UserRepository();
    if (!$repo->hasPermission($user->id, $permission)) {
        http_response_code(403);
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body { font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .container { text-align: center; padding: 2rem; }
        h1 { font-size: 4rem; margin: 0; }
        p { font-size: 1.25rem; margin: 1rem 0; }
        a { color: white; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p><strong>Access Denied</strong></p>
        <p>You do not have permission to access this resource.</p>
        <p>Required permission: <code>' . htmlspecialchars($permission) . '</code></p>
        <p><a href="/dashboard">← Back to Dashboard</a></p>
    </div>
</body>
</html>';
        exit;
    }
}

/**
 * Check if the current user has a specific role
 */
function has_role(string $role): bool
{
    $user = current_user();
    if (!$user) {
        return false;
    }
    
    $repo = new UserRepository();
    return $repo->hasRole($user->id, $role);
}

/**
 * Require that the current user has a specific role
 * Sends 403 Forbidden and exits if role is missing
 */
function require_role(string $role): void
{
    $user = require_login();
    
    $repo = new UserRepository();
    if (!$repo->hasRole($user->id, $role)) {
        http_response_code(403);
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body { font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .container { text-align: center; padding: 2rem; }
        h1 { font-size: 4rem; margin: 0; }
        p { font-size: 1.25rem; margin: 1rem 0; }
        a { color: white; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p><strong>Access Denied</strong></p>
        <p>You do not have the required role to access this resource.</p>
        <p>Required role: <code>' . htmlspecialchars($role) . '</code></p>
        <p><a href="/dashboard">← Back to Dashboard</a></p>
    </div>
</body>
</html>';
        exit;
    }
}

/**
 * Check if the current user is an admin
 */
function is_admin(): bool
{
    return has_role('admin');
}

/**
 * Require admin role (shortcut for require_role('admin'))
 */
function require_admin(): void
{
    require_role('admin');
}

/**
 * Get all permissions for the current user
 */
function get_user_permissions(): array
{
    $user = current_user();
    if (!$user) {
        return [];
    }
    
    $repo = new UserRepository();
    return $repo->getPermissionNames($user->id);
}

/**
 * Get all roles for the current user
 */
function get_user_roles(): array
{
    $user = current_user();
    if (!$user) {
        return [];
    }
    
    $repo = new UserRepository();
    return $repo->getRoleNames($user->id);
}
