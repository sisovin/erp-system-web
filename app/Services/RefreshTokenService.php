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

    /**
     * Revoke a specific refresh token by ID
     * 
     * @param int $tokenId Token ID to revoke
     * @param int|null $adminUserId Admin user performing revocation (for audit)
     * @return bool True if revoked, false if not found
     */
    public static function revokeById(int $tokenId, ?int $adminUserId = null): bool
    {
        $pdo = Database::getPdo();
        
        // Get token info before revoking
        $stmt = $pdo->prepare('SELECT user_id, family FROM refresh_tokens WHERE id = ? LIMIT 1');
        $stmt->execute([$tokenId]);
        $token = $stmt->fetch();
        
        if (!$token) {
            return false;
        }

        // Mark as revoked
        $stmt = $pdo->prepare('UPDATE refresh_tokens SET revoked = 1 WHERE id = ?');
        $stmt->execute([$tokenId]);
        $success = $stmt->rowCount() > 0;

        if ($success) {
            // Log revocation
            require_once __DIR__ . '/AuditService.php';
            $ip = $_SERVER['REMOTE_ADDR'] ?? null;
            AuditService::log(
                $adminUserId ?? (int)$token['user_id'],
                'refresh_token_revoked',
                'refresh_tokens',
                $tokenId,
                ['token_id' => $tokenId, 'user_id' => $token['user_id'], 'family' => $token['family']],
                null,
                $ip,
                'warning'
            );
        }

        return $success;
    }

    /**
     * Revoke all tokens in a family (useful for security)
     * 
     * @param string $family Family identifier
     * @param int|null $adminUserId Admin user performing revocation
     * @return int Number of tokens revoked
     */
    public static function revokeFamily(string $family, ?int $adminUserId = null): int
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('UPDATE refresh_tokens SET revoked = 1 WHERE family = ? AND revoked = 0');
        $stmt->execute([$family]);
        $count = $stmt->rowCount();

        if ($count > 0) {
            require_once __DIR__ . '/AuditService.php';
            $ip = $_SERVER['REMOTE_ADDR'] ?? null;
            AuditService::log(
                $adminUserId,
                'refresh_token_family_revoked',
                'refresh_tokens',
                null,
                ['family' => $family, 'affected' => $count],
                null,
                $ip,
                'warning'
            );
        }

        return $count;
    }

    /**
     * Get all refresh tokens for a user
     * 
     * @param int $userId User ID
     * @param bool $includeRevoked Include revoked tokens
     * @return array Array of token records
     */
    public static function getAllForUser(int $userId, bool $includeRevoked = false): array
    {
        $pdo = Database::getPdo();
        $sql = 'SELECT * FROM refresh_tokens WHERE user_id = ?';
        
        if (!$includeRevoked) {
            $sql .= ' AND revoked = 0';
        }
        
        $sql .= ' ORDER BY created_at DESC';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get active tokens count for a user
     * 
     * @param int $userId User ID
     * @return int Number of active tokens
     */
    public static function getActiveCountForUser(int $userId): int
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM refresh_tokens WHERE user_id = ? AND revoked = 0 AND expires_at > NOW()');
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return (int)($result['count'] ?? 0);
    }

    /**
     * Get all active tokens (admin view)
     * 
     * @param int $limit Limit results
     * @param int $offset Offset for pagination
     * @return array Array of tokens with user info
     */
    public static function getAllActive(int $limit = 50, int $offset = 0): array
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('
            SELECT rt.*, u.username, u.email
            FROM refresh_tokens rt
            JOIN users u ON rt.user_id = u.id
            WHERE rt.revoked = 0 AND rt.expires_at > NOW()
            ORDER BY rt.created_at DESC
            LIMIT ? OFFSET ?
        ');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all tokens (admin view with filters)
     * 
     * @param array $filters Filters: user_id, revoked, expired
     * @param int $limit Limit results
     * @param int $offset Offset for pagination
     * @return array Array of tokens with user info
     */
    public static function getAll(array $filters = [], int $limit = 50, int $offset = 0): array
    {
        $pdo = Database::getPdo();
        $where = [];
        $params = [];

        if (isset($filters['user_id'])) {
            $where[] = 'rt.user_id = ?';
            $params[] = $filters['user_id'];
        }

        if (isset($filters['revoked'])) {
            $where[] = 'rt.revoked = ?';
            $params[] = $filters['revoked'] ? 1 : 0;
        }

        if (isset($filters['expired'])) {
            if ($filters['expired']) {
                $where[] = 'rt.expires_at <= NOW()';
            } else {
                $where[] = 'rt.expires_at > NOW()';
            }
        }

        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        $sql = "
            SELECT rt.*, u.username, u.email
            FROM refresh_tokens rt
            JOIN users u ON rt.user_id = u.id
            {$whereClause}
            ORDER BY rt.created_at DESC
            LIMIT ? OFFSET ?
        ";

        $stmt = $pdo->prepare($sql);
        
        $i = 1;
        foreach ($params as $param) {
            $stmt->bindValue($i++, $param);
        }
        $stmt->bindValue($i++, $limit, PDO::PARAM_INT);
        $stmt->bindValue($i, $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get token statistics
     * 
     * @return array Statistics
     */
    public static function getStatistics(): array
    {
        $pdo = Database::getPdo();

        // Total tokens
        $stmt = $pdo->query('SELECT COUNT(*) as count FROM refresh_tokens');
        $total = $stmt->fetch()['count'];

        // Active tokens
        $stmt = $pdo->query('SELECT COUNT(*) as count FROM refresh_tokens WHERE revoked = 0 AND expires_at > NOW()');
        $active = $stmt->fetch()['count'];

        // Revoked tokens
        $stmt = $pdo->query('SELECT COUNT(*) as count FROM refresh_tokens WHERE revoked = 1');
        $revoked = $stmt->fetch()['count'];

        // Expired tokens
        $stmt = $pdo->query('SELECT COUNT(*) as count FROM refresh_tokens WHERE expires_at <= NOW()');
        $expired = $stmt->fetch()['count'];

        // Tokens by user (top 10)
        $stmt = $pdo->query('
            SELECT u.username, COUNT(*) as count
            FROM refresh_tokens rt
            JOIN users u ON rt.user_id = u.id
            WHERE rt.revoked = 0 AND rt.expires_at > NOW()
            GROUP BY u.username
            ORDER BY count DESC
            LIMIT 10
        ');
        $byUser = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        return [
            'total' => $total,
            'active' => $active,
            'revoked' => $revoked,
            'expired' => $expired,
            'by_user' => $byUser
        ];
    }

    /**
     * Clean up expired tokens (for maintenance)
     * 
     * @param int $daysOld Delete tokens expired more than X days ago
     * @return int Number of deleted tokens
     */
    public static function cleanupExpired(int $daysOld = 30): int
    {
        $pdo = Database::getPdo();
        $cutoffDate = date('Y-m-d H:i:s', strtotime("-{$daysOld} days"));
        
        $stmt = $pdo->prepare('DELETE FROM refresh_tokens WHERE expires_at < ?');
        $stmt->execute([$cutoffDate]);
        
        return $stmt->rowCount();
    }
}

