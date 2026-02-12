<?php
namespace app\Repositories;

require_once __DIR__ . '/../Services/Database.php';

use app\Models\ScheduledExport;

class ScheduledExportRepository
{
    public static function allEnabled(): array
    {
        $pdo = \Database::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM scheduled_exports WHERE enabled = 1");
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $out = [];
        foreach ($rows as $r) {
            $out[] = ScheduledExport::fromRow($r);
        }
        return $out;
    }

    public static function findById($id): ?ScheduledExport
    {
        $pdo = \Database::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM scheduled_exports WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? ScheduledExport::fromRow($row) : null;
    }

    public static function save(ScheduledExport $s): ScheduledExport
    {
        $pdo = \Database::getPdo();
        if (!empty($s->id)) {
            $stmt = $pdo->prepare("UPDATE scheduled_exports SET name = :name, description = :description, `columns` = :columns, `format` = :format, schedule_type = :schedule_type, schedule_time = :schedule_time, schedule_cron = :schedule_cron, retention_days = :retention_days, upload_to_s3 = :upload_to_s3, enabled = :enabled, updated_at = NOW() WHERE id = :id");
            $stmt->execute([
                'name' => $s->name,
                'description' => $s->description,
                'columns' => $s->columns,
                'format' => $s->format,
                'schedule_type' => $s->schedule_type ?? 'daily',
                'schedule_time' => $s->schedule_time ?? null,
                'schedule_cron' => $s->schedule_cron ?? null,
                'retention_days' => $s->retention_days,
                'upload_to_s3' => $s->upload_to_s3 ? 1 : 0,
                'enabled' => $s->enabled ? 1 : 0,
                'id' => $s->id
            ]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO scheduled_exports (name, description, `columns`, `format`, schedule_type, schedule_time, schedule_cron, retention_days, upload_to_s3, enabled, created_by) VALUES (:name, :description, :columns, :format, :schedule_type, :schedule_time, :schedule_cron, :retention_days, :upload_to_s3, :enabled, :created_by)");
            $stmt->execute([
                'name' => $s->name,
                'description' => $s->description,
                'columns' => $s->columns,
                'format' => $s->format ?: 'csv',
                'schedule_type' => $s->schedule_type ?? 'daily',
                'schedule_time' => $s->schedule_time ?? null,
                'schedule_cron' => $s->schedule_cron ?? null,
                'retention_days' => $s->retention_days ?: 30,
                'upload_to_s3' => $s->upload_to_s3 ? 1 : 0,
                'enabled' => $s->enabled ? 1 : 0,
                'created_by' => $s->created_by ?: null
            ]);
            $s->id = $pdo->lastInsertId();
        }
        return $s;
    }

    public static function delete($id): bool
    {
        $pdo = \Database::getPdo();
        $stmt = $pdo->prepare("DELETE FROM scheduled_exports WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
