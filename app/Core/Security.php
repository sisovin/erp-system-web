<?php
// CSRF token and Flash message helpers

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    $token = csrf_token();
    return '<input type="hidden" name="_csrf" value="' . htmlentities($token) . '" />';
}

function csrf_verify(?string $token = null): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($token === null) {
        $token = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
    }
    if (!$token || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Enforce CSRF for all incoming POST requests.
 * If $halt is true, will redirect back (or to $redirect) and exit on failure.
 * Returns true when OK, false when verification failed (and not halted).
 */
function enforce_csrf_on_post(bool $halt = true, string $redirect = '/login'): bool
{
    if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        return true;
    }

    if (csrf_verify()) {
        return true;
    }

    // failed verification
    flash_set('error', 'Invalid CSRF token. Please try again.');
    if ($halt) {
        header('Location: ' . $redirect);
        exit;
    }
    return false;
}

function flash_set(string $key, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'] = $_SESSION['flash'] ?? [];
    $_SESSION['flash'][$key] = $message;
}

function flash_get(string $key): ?string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['flash'][$key])) {
        return null;
    }
    $msg = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $msg;
}

function flash_pop_all(): array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $all = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $all;
}
