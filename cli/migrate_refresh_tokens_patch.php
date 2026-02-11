<?php
// Patch migration: add columns to refresh_tokens table for rotation/replay detection
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();
$queries = [
    "ALTER TABLE refresh_tokens ADD COLUMN IF NOT EXISTS family VARCHAR(64) DEFAULT NULL",
    "ALTER TABLE refresh_tokens ADD COLUMN IF NOT EXISTS revoked TINYINT(1) DEFAULT 0",
    "ALTER TABLE refresh_tokens ADD COLUMN IF NOT EXISTS replaced_by BIGINT DEFAULT NULL",
    "ALTER TABLE refresh_tokens ADD COLUMN IF NOT EXISTS last_used_at DATETIME DEFAULT NULL",
];
foreach ($queries as $q) {
    try {
        $pdo->exec($q);
        echo "Executed: $q\n";
    } catch (PDOException $e) {
        // Some MySQL versions don't support IF NOT EXISTS for ADD COLUMN; try without IF NOT EXISTS
        try {
            $q2 = preg_replace('/IF NOT EXISTS\s+/i', '', $q);
            $pdo->exec($q2);
            echo "Executed: $q2\n";
        } catch (PDOException $e2) {
            echo "Skipped/Failed: " . $e2->getMessage() . "\n";
        }
    }
}

echo "Patch complete.\n";