<?php
// Migration to create scheduled_exports table
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
$db = Database::getPdo();

$sql = "CREATE TABLE IF NOT EXISTS scheduled_exports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `columns` TEXT NULL,
    `format` VARCHAR(20) NOT NULL DEFAULT 'csv',
    schedule_type ENUM('daily','cron') DEFAULT 'daily',
    schedule_time TIME NULL,
    schedule_cron VARCHAR(255) NULL,
    `retention_days` INT NOT NULL DEFAULT 30,
    `upload_to_s3` TINYINT(1) NOT NULL DEFAULT 0,
    `enabled` TINYINT(1) NOT NULL DEFAULT 1,
    `created_by` INT NULL,
    `last_run_at` DATETIME NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

try {
    $db->exec($sql);
    echo "Created table scheduled_exports\n";
} catch (PDOException $e) {
    echo "Error creating scheduled_exports: " . $e->getMessage() . "\n";
    exit(1);
}

exit(0);
