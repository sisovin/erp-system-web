<?php
/**
 * Simple PDO Database service
 */
require_once __DIR__ . '/../../config/constants.php';

class Database
{
    private static ?PDO $pdo = null;

    public static function getPdo(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $driver = DB_CONNECTION ?: 'mysql';
        $host = DB_HOST;
        $port = DB_PORT;
        $db   = DB_DATABASE;
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;

        $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=utf8mb4', $driver, $host, $port, $db);

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        self::$pdo = new PDO($dsn, $user, $pass, $options);

        return self::$pdo;
    }
}
