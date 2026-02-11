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
}
