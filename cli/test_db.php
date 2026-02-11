<?php
// Simple CLI to test database connection
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';

try {
    $pdo = Database::getPdo();
    $version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) ?: 'unknown';
    echo "Database connection successful. Server version: $version" . PHP_EOL;
    exit(0);
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
