<?php
// Migration to add scheduling fields to scheduled_exports
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';
$pdo = Database::getPdo();

$queries = [
    "ALTER TABLE scheduled_exports ADD COLUMN schedule_type ENUM('daily','cron') DEFAULT 'daily', ADD COLUMN schedule_time TIME NULL, ADD COLUMN schedule_cron VARCHAR(255) NULL;"
];

foreach ($queries as $q) {
    try {
        $pdo->exec($q);
        echo "Executed: $q\n";
    } catch (PDOException $e) {
        echo "Error executing: " . $e->getMessage() . "\n";
    }
}

exit(0);
