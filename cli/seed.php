<?php
// Simple seeder to insert default roles, permissions and admin user
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';

$pdo = Database::getPdo();

try {
    $pdo->beginTransaction();

    // Roles
    $roles = ['admin', 'hr_manager', 'inventory_manager', 'sales_manager', 'accountant', 'user'];
    $roleIds = [];
    $stmtRole = $pdo->prepare('INSERT IGNORE INTO roles (name, label) VALUES (?, ?)');
    foreach ($roles as $r) {
        $stmtRole->execute([$r, ucfirst(str_replace('_', ' ', $r))]);
        $roleIds[$r] = $pdo->lastInsertId() ?: (function() use ($pdo, $r) {
            $s = $pdo->prepare('SELECT id FROM roles WHERE name = ? LIMIT 1');
            $s->execute([$r]);
            return $s->fetchColumn();
        })();
    }

    // Default admin user
    $email = DEFAULT_ADMIN_EMAIL;
    $passwordPlain = DEFAULT_ADMIN_PASSWORD;
    $hash = password_hash($passwordPlain, PASSWORD_ARGON2ID);

    $stmtUser = $pdo->prepare('INSERT IGNORE INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())');
    $stmtUser->execute(['Administrator', $email, $hash]);
    $userId = $pdo->lastInsertId() ?: (function() use ($pdo, $email) {
        $s = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $s->execute([$email]);
        return $s->fetchColumn();
    })();

    // Assign admin role
    if (!empty($userId) && !empty($roleIds['admin'])) {
        $stmtAssign = $pdo->prepare('INSERT IGNORE INTO role_user (user_id, role_id) VALUES (?, ?)');
        $stmtAssign->execute([$userId, $roleIds['admin']]);
    }

    // Sample products
    $stmtProduct = $pdo->prepare('INSERT IGNORE INTO products (sku, name, description, price, stock, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmtProduct->execute(['SKU001', 'Sample Product 1', 'Sample product description', '19.99', 100]);
    $stmtProduct->execute(['SKU002', 'Sample Product 2', 'Sample product description', '29.99', 50]);

    // Sample customers
    $stmtCust = $pdo->prepare('INSERT IGNORE INTO customers (name, email, created_at) VALUES (?, ?, NOW())');
    $stmtCust->execute(['Sample Customer A', 'customerA@example.com']);
    $stmtCust->execute(['Sample Customer B', 'customerB@example.com']);

    // Chart of accounts (simple sample)
    $stmtAcc = $pdo->prepare('INSERT IGNORE INTO accounts (code, name, type, created_at) VALUES (?, ?, ?, NOW())');
    $stmtAcc->execute(['1000', 'Cash', 'asset']);
    $stmtAcc->execute(['2000', 'Accounts Payable', 'liability']);

    $pdo->commit();
    echo "Seeding complete. Default admin: $email / $passwordPlain\n";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Seeding failed: " . $e->getMessage() . "\n";
}
