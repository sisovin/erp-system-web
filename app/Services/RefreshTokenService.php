<?php
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/Database.php';

class RefreshTokenService
{
    // Hash a token for storage/lookup
    public static function hashToken(string $token): string
    {
        return hash_hmac('sha256', $token, JWT_SECRET);
    }

    // Create a new refresh token (returns raw token and expires_at)
    public static function createForUser(int $userId, ?int $ttlSeconds = null, ?string $family = null): array
    {
        if ($ttlSeconds === null) {
            $ttlSeconds = (int) JWT_REFRESH_EXPIRE;
        }
        $raw = bin2hex(random_bytes(64));
        $hash = self::hashToken($raw);
        $expires = date('Y-m-d H:i:s', time() + $ttlSeconds);
        if ($family === null) {
            $family = bin2hex(random_bytes(16));
        }
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('INSERT INTO refresh_tokens (user_id, token, expires_at, family, created_at) VALUES (?, ?, ?, ?, NOW())');
        $stmt->execute([$userId, $hash, $expires, $family]);
        return ['token' => $raw, 'expires_at' => $expires, 'family' => $family];
    }

    // Find record by raw token (returns row or null)
    public static function findByRawToken(string $raw, bool $includeRevoked = false): ?array
    {
        $hash = self::hashToken($raw);
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM refresh_tokens WHERE token = ? LIMIT 1');
        $stmt->execute([$hash]);
        $row = $stmt->fetch();
        if (!$row) return null;
        if (isset($row['expires_at']) && strtotime($row['expires_at']) < time()) {
            return null; // expired
        }
        if (!$includeRevoked && !empty($row['revoked'])) {
            return null; // revoked or rotated
        }
        return $row;
    }

    // Rotate a refresh token: invalidate old, create a new one. Returns new raw token or null on failure
    public static function rotate(string $raw): ?array
    {
        $pdo = Database::getPdo();
        $pdo->beginTransaction();
        try {
            // find token even if revoked (to detect replay)
            $old = self::findByRawToken($raw, true);
            if (!$old) {
                $pdo->rollBack();
                return null;
            }

            // If token already has been replaced, this is a replay attack.
            if (!empty($old['replaced_by']) || !empty($old['revoked'])) {
                // Revoke all refresh tokens for this user as a safety action
                self::revokeAllForUser((int)$old['user_id']);

                // Log replay detection in audit logs (critical)
                require_once __DIR__ . '/AuditService.php';
                $ip = $_SERVER['REMOTE_ADDR'] ?? null;
                AuditService::log((int)$old['user_id'], 'refresh_token_replay_detected', 'refresh_tokens', (int)$old['id'], ['token_id' => $old['id'], 'family' => $old['family']], null, $ip, 'critical');

                $pdo->commit();
                return null;
            }

            // create new token in same family
            $new = self::createForUser((int)$old['user_id'], null, $old['family']);
            // mark old as revoked and set replaced_by
            $stmtUpd = $pdo->prepare('UPDATE refresh_tokens SET revoked = 1, replaced_by = ?, last_used_at = NOW() WHERE id = ?');
            $stmtUpd->execute([$pdo->lastInsertId(), $old['id']]);

            // Log rotation event (info)
            require_once __DIR__ . '/AuditService.php';
            $ip = $_SERVER['REMOTE_ADDR'] ?? null;
            AuditService::log((int)$old['user_id'], 'refresh_token_rotated', 'refresh_tokens', (int)$old['id'], ['old_token_id' => $old['id']], ['new_token_id' => $pdo->lastInsertId()], $ip, 'info');
            $pdo->commit();
            return ['new' => $new, 'user_id' => (int)$old['user_id']];
        } catch (Exception $e) {
            $pdo->rollBack();
            return null;
        }
    }

    public static function revoke(string $raw): bool
    {
        $hash = self::hashToken($raw);
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('DELETE FROM refresh_tokens WHERE token = ?');
        $stmt->execute([$hash]);
        return $stmt->rowCount() > 0;
    }

    public static function revokeAllForUser(int $userId): int
    {
        $pdo = Database::getPdo();
        // mark revoked flag rather than deleting for auditability
        $stmt = $pdo->prepare('UPDATE refresh_tokens SET revoked = 1 WHERE user_id = ? AND revoked = 0');
        $stmt->execute([$userId]);
        $count = $stmt->rowCount();

        // Log the revoke all action (warning)
        require_once __DIR__ . '/AuditService.php';
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        AuditService::log($userId, 'revoked_all_refresh_tokens', 'refresh_tokens', null, ['affected' => $count], null, $ip, 'warning');

        return $count;
    }
}
