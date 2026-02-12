<?php
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/Database.php';

class AuditService
{
    public static function log(?int $userId, string $action, ?string $model = null, ?int $modelId = null, $before = null, $after = null, ?string $ip = null, string $severity = 'info'): ?int
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('INSERT INTO audit_logs (user_id, action, model, model_id, before_data, after_data, ip, severity, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');
        $beforeJson = is_null($before) ? null : json_encode($before);
        $afterJson = is_null($after) ? null : json_encode($after);
        $stmt->execute([
            $userId,
            $action,
            $model,
            $modelId,
            $beforeJson,
            $afterJson,
            $ip,
            $severity,
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function lastEntriesForAction(string $action, int $limit = 10): array
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM audit_logs WHERE action = ? ORDER BY id DESC LIMIT ?');
        $stmt->bindValue(1, $action);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function queryEntries(?string $action = null, ?string $startDate = null, ?string $endDate = null, ?int $limit = 50, ?int $offset = 0, ?string $severity = null): array
    {
        $pdo = Database::getPdo();
        $conditions = [];
        $params = [];

        if ($action) {
            $conditions[] = 'action = ?';
            $params[] = $action;
        }
        if ($startDate) {
            $conditions[] = 'created_at >= ?';
            $params[] = $startDate . ' 00:00:00';
        }
        if ($endDate) {
            $conditions[] = 'created_at <= ?';
            $params[] = $endDate . ' 23:59:59';
        }
        if ($severity) {
            $conditions[] = 'severity = ?';
            $params[] = $severity;
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
        $sql = sprintf('SELECT * FROM audit_logs %s ORDER BY id DESC LIMIT ? OFFSET ?', $where);
        $stmt = $pdo->prepare($sql);

        // bind params
        $i = 1;
        foreach ($params as $p) {
            $stmt->bindValue($i++, $p);
        }
        $stmt->bindValue($i++, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue($i, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM audit_logs WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Log user action with automatic IP detection
     * 
     * @param int|null $userId User ID performing the action
     * @param string $action Action description (e.g., 'user.login', 'product.view')
     * @param string|null $model Model name (e.g., 'User', 'Product')
     * @param int|null $modelId Model ID
     * @param string $severity Severity level: 'info', 'warning', 'error', 'critical'
     * @return int|null Audit log ID
     */
    public static function logUserAction(?int $userId, string $action, ?string $model = null, ?int $modelId = null, string $severity = 'info'): ?int
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        return self::log($userId, $action, $model, $modelId, null, null, $ip, $severity);
    }

    /**
     * Log data change with before/after tracking
     * 
     * @param int|null $userId User ID performing the change
     * @param string $action Action performed (e.g., 'employee.update', 'product.delete')
     * @param string $model Model name
     * @param int $modelId Model ID
     * @param array|null $beforeData Data before change
     * @param array|null $afterData Data after change
     * @param string $severity Severity level
     * @return int|null Audit log ID
     */
    public static function logDataChange(?int $userId, string $action, string $model, int $modelId, ?array $beforeData, ?array $afterData, string $severity = 'info'): ?int
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        
        // Remove sensitive fields from audit data
        $sensitiveFields = ['password', 'password_hash', 'token', 'secret', 'api_key'];
        if ($beforeData) {
            $beforeData = self::removeSensitiveFields($beforeData, $sensitiveFields);
        }
        if ($afterData) {
            $afterData = self::removeSensitiveFields($afterData, $sensitiveFields);
        }

        return self::log($userId, $action, $model, $modelId, $beforeData, $afterData, $ip, $severity);
    }

    /**
     * Remove sensitive fields from data array
     * 
     * @param array $data Data array
     * @param array $sensitiveFields Field names to remove
     * @return array Sanitized data
     */
    private static function removeSensitiveFields(array $data, array $sensitiveFields): array
    {
        foreach ($sensitiveFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = '[REDACTED]';
            }
        }
        return $data;
    }

    /**
     * Compare before and after data to detect changes
     * 
     * @param array $before Before data
     * @param array $after After data
     * @return array Changed fields with before/after values
     */
    public static function compareData(array $before, array $after): array
    {
        $changes = [];

        // Check for modified and new fields
        foreach ($after as $key => $newValue) {
            if (!array_key_exists($key, $before)) {
                $changes[$key] = [
                    'type' => 'added',
                    'before' => null,
                    'after' => $newValue
                ];
            } elseif ($before[$key] !== $newValue) {
                $changes[$key] = [
                    'type' => 'modified',
                    'before' => $before[$key],
                    'after' => $newValue
                ];
            }
        }

        // Check for removed fields
        foreach ($before as $key => $oldValue) {
            if (!array_key_exists($key, $after)) {
                $changes[$key] = [
                    'type' => 'removed',
                    'before' => $oldValue,
                    'after' => null
                ];
            }
        }

        return $changes;
    }

    /**
     * Get human-readable change summary
     * 
     * @param int $auditId Audit log ID
     * @return array Change summary
     */
    public static function getChangeSummary(int $auditId): array
    {
        $audit = self::getById($auditId);
        if (!$audit) {
            return [];
        }

        $before = $audit['before_data'] ? json_decode($audit['before_data'], true) : [];
        $after = $audit['after_data'] ? json_decode($audit['after_data'], true) : [];

        if (empty($before) && empty($after)) {
            return ['summary' => 'No data changes recorded'];
        }

        $changes = self::compareData($before, $after);
        $summary = [];

        foreach ($changes as $field => $change) {
            switch ($change['type']) {
                case 'added':
                    $summary[] = sprintf('Added %s: %s', $field, self::formatValue($change['after']));
                    break;
                case 'modified':
                    $summary[] = sprintf('Changed %s from "%s" to "%s"', 
                        $field, 
                        self::formatValue($change['before']), 
                        self::formatValue($change['after'])
                    );
                    break;
                case 'removed':
                    $summary[] = sprintf('Removed %s: %s', $field, self::formatValue($change['before']));
                    break;
            }
        }

        return [
            'summary' => implode('; ', $summary),
            'changes' => $changes,
            'field_count' => count($changes)
        ];
    }

    /**
     * Format value for display
     * 
     * @param mixed $value Value to format
     * @return string Formatted value
     */
    private static function formatValue($value): string
    {
        if (is_null($value)) {
            return 'NULL';
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_array($value)) {
            return json_encode($value);
        }
        return (string) $value;
    }

    /**
     * Get audit history for specific model
     * 
     * @param string $model Model name
     * @param int $modelId Model ID
     * @param int $limit Limit results
     * @return array Audit entries
     */
    public static function getModelHistory(string $model, int $modelId, int $limit = 50): array
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('
            SELECT al.*, u.username 
            FROM audit_logs al
            LEFT JOIN users u ON al.user_id = u.id
            WHERE al.model = ? AND al.model_id = ?
            ORDER BY al.created_at DESC
            LIMIT ?
        ');
        $stmt->bindValue(1, $model);
        $stmt->bindValue(2, $modelId, PDO::PARAM_INT);
        $stmt->bindValue(3, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get recent activity for user
     * 
     * @param int $userId User ID
     * @param int $limit Limit results
     * @return array Audit entries
     */
    public static function getUserActivity(int $userId, int $limit = 50): array
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('
            SELECT * FROM audit_logs
            WHERE user_id = ?
            ORDER BY created_at DESC
            LIMIT ?
        ');
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get statistics for audit logs
     * 
     * @param string|null $startDate Start date (Y-m-d)
     * @param string|null $endDate End date (Y-m-d)
     * @return array Statistics
     */
    public static function getStatistics(?string $startDate = null, ?string $endDate = null): array
    {
        $pdo = Database::getPdo();
        
        $dateFilter = '';
        $params = [];
        if ($startDate) {
            $dateFilter .= ' AND created_at >= ?';
            $params[] = $startDate . ' 00:00:00';
        }
        if ($endDate) {
            $dateFilter .= ' AND created_at <= ?';
            $params[] = $endDate . ' 23:59:59';
        }

        // Total entries
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM audit_logs WHERE 1=1 $dateFilter");
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        $total = $stmt->fetch()['total'];

        // By severity
        $stmt = $pdo->prepare("
            SELECT severity, COUNT(*) as count 
            FROM audit_logs 
            WHERE 1=1 $dateFilter
            GROUP BY severity
        ");
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        $bySeverity = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // By action
        $stmt = $pdo->prepare("
            SELECT action, COUNT(*) as count 
            FROM audit_logs 
            WHERE 1=1 $dateFilter
            GROUP BY action 
            ORDER BY count DESC 
            LIMIT 10
        ");
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        $topActions = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Most active users
        $stmt = $pdo->prepare("
            SELECT u.username, COUNT(*) as count 
            FROM audit_logs al
            JOIN users u ON al.user_id = u.id
            WHERE 1=1 $dateFilter
            GROUP BY u.username 
            ORDER BY count DESC 
            LIMIT 10
        ");
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        $topUsers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        return [
            'total' => $total,
            'by_severity' => $bySeverity,
            'top_actions' => $topActions,
            'top_users' => $topUsers,
            'period' => [
                'start' => $startDate,
                'end' => $endDate
            ]
        ];
    }
}
