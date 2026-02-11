<?php
require_once __DIR__ . '/JwtService.php';
require_once __DIR__ . '/../Repositories/UserRepository.php';

function get_bearer_token(): ?string
{
    $hdr = $_SERVER['HTTP_AUTHORIZATION'] ?? ($_SERVER['Authorization'] ?? null);
    if (!$hdr) return null;
    if (stripos($hdr, 'Bearer ') === 0) {
        return substr($hdr, 7);
    }
    return null;
}

function require_api_auth(bool $halt = true): ?array
{
    $token = get_bearer_token();
    if (!$token) {
        if ($halt) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Missing Authorization token']);
            exit;
        }
        return null;
    }

    $payload = JwtService::decodeToken($token);
    if (!$payload) {
        if ($halt) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid or expired token']);
            exit;
        }
        return null;
    }

    // payload should have 'sub'
    if (!isset($payload['sub'])) {
        if ($halt) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid token payload']);
            exit;
        }
        return null;
    }

    // attach payload to global for convenience
    $GLOBALS['api_jwt_payload'] = $payload;
    // return payload
    return $payload;
}

function api_current_user(): ?\User
{
    $payload = $GLOBALS['api_jwt_payload'] ?? null;
    if (!$payload || empty($payload['sub'])) return null;
    $repo = new UserRepository();
    return $repo->findById((int) $payload['sub']);
}

function api_require_csrf(bool $halt = true): bool
{
    // Expect header X-CSRF-TOKEN
    $csrfHeader = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
    $payload = $GLOBALS['api_jwt_payload'] ?? null;
    $csrf = $payload['csrf'] ?? null;
    if (!$csrfHeader || !$csrf || !hash_equals($csrf, $csrfHeader)) {
        if ($halt) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid CSRF token']);
            exit;
        }
        return false;
    }
    return true;
}
