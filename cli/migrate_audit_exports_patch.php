<?php
// Patch migration: add severity column to audit_logs, create audit_exports table
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();

try {
    $pdo->exec("ALTER TABLE audit_logs ADD COLUMN IF NOT EXISTS severity VARCHAR(20) DEFAULT 'info'");
    echo "Added column severity to audit_logs\n";
} catch (PDOException $e) {
    try {
        $pdo->exec("ALTER TABLE audit_logs ADD COLUMN severity VARCHAR(20) DEFAULT 'info'");
        echo "Added column severity to audit_logs\n";
    } catch (PDOException $e2) {
        echo "Failed to add severity column: " . $e2->getMessage() . "\n";
    }
}

try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_exports (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        path VARCHAR(1024) NOT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        expires_at DATETIME DEFAULT NULL,
        note VARCHAR(255) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    echo "Created table audit_exports\n";
} catch (PDOException $e) {
    echo "Failed to create audit_exports: " . $e->getMessage() . "\n";
}

echo "Patch complete.\n";