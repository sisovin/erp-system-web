<?php
/**
 * Migration: Add Token Management Permission
 * 
 * Adds system.manage_tokens permission for admin token management functionality
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../app/Services/Database.php';

echo "=== Migration: Add Token Management Permission ===\n\n";

try {
    $pdo = Database::getPdo();
    
    echo "1. Adding system.manage_tokens permission...\n";
    $stmt = $pdo->prepare('INSERT IGNORE INTO permissions (name, label, created_at) VALUES (?, ?, NOW())');
    $stmt->execute(['system.manage_tokens', 'Manage refresh tokens']);
    
    if ($stmt->rowCount() > 0) {
        echo "   ✓ Permission added successfully\n";
    } else {
        echo "   • Permission already exists\n";
    }
    
    // Get the permission ID
    $stmt = $pdo->prepare('SELECT id FROM permissions WHERE name = ? LIMIT 1');
    $stmt->execute(['system.manage_tokens']);
    $permission = $stmt->fetch();
    
    if (!$permission) {
        throw new Exception('Failed to get permission ID');
    }
    
    $permissionId = $permission['id'];
    
    echo "\n2. Assigning permission to admin role...\n";
    
    // Get admin role ID
    $stmt = $pdo->prepare('SELECT id FROM roles WHERE name = ? LIMIT 1');
    $stmt->execute(['admin']);
    $adminRole = $stmt->fetch();
    
    if ($adminRole) {
        $stmt = $pdo->prepare('INSERT IGNORE INTO permission_role (permission_id, role_id) VALUES (?, ?)');
        $stmt->execute([$permissionId, $adminRole['id']]);
        
        if ($stmt->rowCount() > 0) {
            echo "   ✓ Permission assigned to admin role\n";
        } else {
            echo "   • Permission already assigned to admin role\n";
        }
    } else {
        echo "   ⚠ Admin role not found (create it first)\n";
    }
    
    echo "\n✅ Migration completed successfully!\n\n";
    
} catch (Exception $e) {
    echo "\n❌ Migration failed: " . $e->getMessage() . "\n\n";
    exit(1);
}
