<?php
namespace app\Repositories;

use app\Services\Database;
use app\Services\Secrets;

class SettingsRepository
{
    public static function get(string $key, $default = null)
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT v, is_secret FROM settings WHERE `k` = :k');
        $stmt->execute(['k' => $key]);
        $r = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$r) return $default;
        if ($r['is_secret']) {
            try {
                return Secrets::decrypt($r['v']);
            } catch (\Exception $e) {
                return $default;
            }
        }
        return $r['v'];
    }

    public static function set(string $key, $value, bool $isSecret = false): bool
    {
        $pdo = Database::getPdo();
        $v = $value;
        if ($isSecret && $value !== null) $v = Secrets::encrypt($value);
        $stmt = $pdo->prepare('INSERT INTO settings (`k`, `v`, `is_secret`) VALUES (:k, :v, :is_secret) ON DUPLICATE KEY UPDATE `v` = VALUES(`v`), is_secret = VALUES(is_secret), updated_at = NOW()');
        return $stmt->execute(['k' => $key, 'v' => $v, 'is_secret' => $isSecret ? 1 : 0]);
    }
}
