<?php
// Minimal JWT service using HS256 (HMAC)
require_once __DIR__ . '/../../config/constants.php';

class JwtService
{
    public static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function sign(string $data, string $secret): string
    {
        return hash_hmac('sha256', $data, $secret, true);
    }

    public static function generateToken(int $userId, ?int $expireSeconds = null, array $extra = []): string
    {
        $header = ['alg' => JWT_ALGO ?? 'HS256', 'typ' => 'JWT'];
        $now = time();
        $payload = array_merge([
            'sub' => $userId,
            'iat' => $now,
        ], $extra);
        if ($expireSeconds === null) {
            $expireSeconds = (int) JWT_ACCESS_EXPIRE;
        }
        if ($expireSeconds > 0) {
            $payload['exp'] = $now + (int) $expireSeconds;
        }

        $segments = [];
        $segments[] = self::base64UrlEncode(json_encode($header));
        $segments[] = self::base64UrlEncode(json_encode($payload));
        $signingInput = implode('.', $segments);
        $signature = self::sign($signingInput, JWT_SECRET);
        $segments[] = self::base64UrlEncode($signature);
        return implode('.', $segments);
    }

    public static function decodeToken(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }
        [$h64, $p64, $s64] = $parts;
        $header = json_decode(self::base64UrlDecode($h64), true);
        $payload = json_decode(self::base64UrlDecode($p64), true);
        $signature = self::base64UrlDecode($s64);
        if (!is_array($payload) || !is_array($header)) {
            return null;
        }

        // verify signature
        $sig = self::sign($h64 . '.' . $p64, JWT_SECRET);
        if (!hash_equals($sig, $signature)) {
            return null;
        }

        // check exp
        if (isset($payload['exp']) && time() > $payload['exp']) {
            return null;
        }

        return $payload;
    }
}
