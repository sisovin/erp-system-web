<?php
// Simple seeder to insert default roles, permissions and admin user
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/Services/Database.php';

$pdo = Database::getPdo();

try {
    $pdo->beginTransaction();

    // ========== ROLES ==========
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

    // ========== PERMISSIONS ==========
    $permissions = [
        // User Management
        'users.view' => 'View users',
        'users.create' => 'Create users',
        'users.edit' => 'Edit users',
        'users.delete' => 'Delete users',
        
        // HR Module
        'hr.view_employees' => 'View employees',
        'hr.create_employee' => 'Create employee',
        'hr.edit_employee' => 'Edit employee',
        'hr.delete_employee' => 'Delete employee',
        'hr.view_attendance' => 'View attendance',
        'hr.manage_attendance' => 'Manage attendance',
        'hr.view_payroll' => 'View payroll',
        'hr.process_payroll' => 'Process payroll',
        
        // Inventory Module
        'inventory.view_products' => 'View products',
        'inventory.create_product' => 'Create product',
        'inventory.edit_product' => 'Edit product',
        'inventory.delete_product' => 'Delete product',
        'inventory.manage_stock' => 'Manage stock movements',
        'inventory.view_suppliers' => 'View suppliers',
        'inventory.manage_suppliers' => 'Manage suppliers',
        
        // Sales Module
        'sales.view_orders' => 'View sales orders',
        'sales.create_order' => 'Create sales order',
        'sales.edit_order' => 'Edit sales order',
        'sales.delete_order' => 'Delete sales order',
        'sales.view_customers' => 'View customers',
        'sales.manage_customers' => 'Manage customers',
        'sales.view_invoices' => 'View invoices',
        'sales.generate_invoice' => 'Generate invoices',
        
        // Accounts Module
        'accounts.view_chart' => 'View chart of accounts',
        'accounts.manage_accounts' => 'Manage accounts',
        'accounts.view_ledger' => 'View ledger',
        'accounts.post_entry' => 'Post ledger entries',
        'accounts.view_expenses' => 'View expenses',
        'accounts.manage_expenses' => 'Manage expenses',
        'accounts.view_reports' => 'View financial reports',
        'accounts.generate_reports' => 'Generate financial reports',
        
        // System Administration
        'system.view_audit' => 'View audit logs',
        'system.manage_settings' => 'Manage system settings',
        'system.manage_roles' => 'Manage roles and permissions',
        'system.manage_tokens' => 'Manage refresh tokens',
    ];
    
    $permissionIds = [];
    $stmtPerm = $pdo->prepare('INSERT IGNORE INTO permissions (name, label) VALUES (?, ?)');
    foreach ($permissions as $name => $label) {
        $stmtPerm->execute([$name, $label]);
        $permissionIds[$name] = $pdo->lastInsertId() ?: (function() use ($pdo, $name) {
            $s = $pdo->prepare('SELECT id FROM permissions WHERE name = ? LIMIT 1');
            $s->execute([$name]);
            return $s->fetchColumn();
        })();
    }

    // ========== ROLE-PERMISSION ASSIGNMENTS ==========
    $rolePermissions = [
        'admin' => array_keys($permissions), // All permissions
        
        'hr_manager' => [
            'users.view',
            'hr.view_employees', 'hr.create_employee', 'hr.edit_employee', 'hr.delete_employee',
            'hr.view_attendance', 'hr.manage_attendance',
            'hr.view_payroll', 'hr.process_payroll',
        ],
        
        'inventory_manager' => [
            'inventory.view_products', 'inventory.create_product', 'inventory.edit_product', 'inventory.delete_product',
            'inventory.manage_stock',
            'inventory.view_suppliers', 'inventory.manage_suppliers',
        ],
        
        'sales_manager' => [
            'sales.view_orders', 'sales.create_order', 'sales.edit_order', 'sales.delete_order',
            'sales.view_customers', 'sales.manage_customers',
            'sales.view_invoices', 'sales.generate_invoice',
            'inventory.view_products', // Can view products for orders
        ],
        
        'accountant' => [
            'accounts.view_chart', 'accounts.manage_accounts',
            'accounts.view_ledger', 'accounts.post_entry',
            'accounts.view_expenses', 'accounts.manage_expenses',
            'accounts.view_reports', 'accounts.generate_reports',
            'sales.view_invoices', // Can view invoices for accounting
        ],
        
        'user' => [
            'users.view',
        ],
    ];
    
    $stmtRolePerm = $pdo->prepare('INSERT IGNORE INTO permission_role (role_id, permission_id) VALUES (?, ?)');
    foreach ($rolePermissions as $roleName => $perms) {
        $roleId = $roleIds[$roleName] ?? null;
        if (!$roleId) continue;
        
        foreach ($perms as $permName) {
            $permId = $permissionIds[$permName] ?? null;
            if ($permId) {
                $stmtRolePerm->execute([$roleId, $permId]);
            }
        }
    }

    // ========== DEFAULT ADMIN USER ==========
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

    // ========== SAMPLE PRODUCTS ==========
    $stmtProduct = $pdo->prepare('INSERT IGNORE INTO products (sku, name, description, price, stock, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmtProduct->execute(['SKU001', 'Laptop Computer', 'High-performance business laptop', '1299.99', 25]);
    $stmtProduct->execute(['SKU002', 'Office Desk', 'Ergonomic adjustable desk', '499.99', 15]);
    $stmtProduct->execute(['SKU003', 'Office Chair', 'Ergonomic mesh office chair', '299.99', 30]);
    $stmtProduct->execute(['SKU004', 'Monitor 27"', '4K UHD monitor', '399.99', 20]);
    $stmtProduct->execute(['SKU005', 'Wireless Mouse', 'Bluetooth wireless mouse', '29.99', 100]);

    // ========== SAMPLE CUSTOMERS ==========
    $stmtCust = $pdo->prepare('INSERT IGNORE INTO customers (name, email, phone, created_at) VALUES (?, ?, ?, NOW())');
    $stmtCust->execute(['Acme Corporation', 'contact@acmecorp.com', '+1-555-0101']);
    $stmtCust->execute(['Global Solutions Inc', 'info@globalsolutions.com', '+1-555-0202']);
    $stmtCust->execute(['Tech Innovators Ltd', 'sales@techinnovators.com', '+1-555-0303']);

    // ========== CHART OF ACCOUNTS ==========
    $stmtAcc = $pdo->prepare('INSERT IGNORE INTO accounts (code, name, type, created_at) VALUES (?, ?, ?, NOW())');
    $stmtAcc->execute(['1000', 'Cash', 'asset']);
    $stmtAcc->execute(['1100', 'Accounts Receivable', 'asset']);
    $stmtAcc->execute(['1200', 'Inventory', 'asset']);
    $stmtAcc->execute(['2000', 'Accounts Payable', 'liability']);
    $stmtAcc->execute(['2100', 'Salaries Payable', 'liability']);
    $stmtAcc->execute(['3000', 'Owner Equity', 'equity']);
    $stmtAcc->execute(['4000', 'Sales Revenue', 'revenue']);
    $stmtAcc->execute(['5000', 'Cost of Goods Sold', 'expense']);
    $stmtAcc->execute(['5100', 'Operating Expenses', 'expense']);

    $pdo->commit();
    
    echo "✅ Seeding completed successfully!\n\n";
    echo "==========================================\n";
    echo "Default Admin Credentials:\n";
    echo "Email: $email\n";
    echo "Password: $passwordPlain\n";
    echo "==========================================\n\n";
    echo "Roles created: " . count($roles) . "\n";
    echo "Permissions created: " . count($permissions) . "\n";
    echo "Products seeded: 5\n";
    echo "Customers seeded: 3\n";
    echo "Accounts seeded: 9\n\n";
    
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "❌ Seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}

