<?php
// Migration to create settings table for secure config storage
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();

$sql = "CREATE TABLE IF NOT EXISTS settings (
    `k` VARCHAR(191) PRIMARY KEY,
    `v` TEXT NULL,
    `is_secret` TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

try {
    $pdo->exec($sql);
    echo "Created table settings\n";
} catch (PDOException $e) {
    echo "Error creating settings: " . $e->getMessage() . "\n";
    exit(1);
}

exit(0);
