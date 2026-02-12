<?php
// Minimal routing for demo purposes
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Core/Auth.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Global CSRF enforcement for all POST requests (non-API endpoints)
require_once __DIR__ . '/Core/Security.php';
// Skip enforcement for API endpoints (path starts with /api)
if (strtoupper($method) === 'POST' && !str_starts_with($uri, '/api')) {
    enforce_csrf_on_post(true, '/login');
}

$auth = new AuthController();

// Home page (public)
if ($uri === '/' || $uri === '/index.php') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/index.php';
    exit;
}

// About page (public)
if ($uri === '/about') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/about.php';
    exit;
}

// Businesses page (public)
if ($uri === '/businesses') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/businesses.php';
    exit;
}

// Benefits page (public)
if ($uri === '/benefits') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/benefits.php';
    exit;
}

// Pricing page (public)
if ($uri === '/pricing') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/pricing.php';
    exit;
}

// Contact page (public)
if ($uri === '/contact') {
    $user = null; // Public page, no authentication required
    include __DIR__ . '/../resources/views/home/contact.php';
    exit;
}

if ($uri === '/login' && $method === 'GET') {
    $auth->showLogin();
    exit;
}

if ($uri === '/login' && $method === 'POST') {
    $auth->handleLogin();
    exit;
}

if ($uri === '/register' && $method === 'GET') {
    $user = null; // Public page
    include __DIR__ . '/../resources/views/auth/register.php';
    exit;
}

if ($uri === '/register' && $method === 'POST') {
    // Registration handler (to be implemented)
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordConfirmation = $_POST['password_confirmation'] ?? '';
    $terms = isset($_POST['terms']);
    
    // Basic validation
    if (!$name || !$email || !$password || !$passwordConfirmation) {
        $_SESSION['flash_error'] = 'All fields are required';
        header('Location: /register');
        exit;
    }
    
    if ($password !== $passwordConfirmation) {
        $_SESSION['flash_error'] = 'Passwords do not match';
        header('Location: /register');
        exit;
    }
    
    if (strlen($password) < 8) {
        $_SESSION['flash_error'] = 'Password must be at least 8 characters';
        header('Location: /register');
        exit;
    }
    
    if (!$terms) {
        $_SESSION['flash_error'] = 'You must agree to the Terms of Service';
        header('Location: /register');
        exit;
    }
    
    // TODO: Implement user registration in database
    // For now, redirect to login
    $_SESSION['flash_success'] = 'Registration successful! Please login.';
    header('Location: /login');
    exit;
}

// API: login -> returns JWT + csrf claim
if ($uri === '/api/login' && strtoupper($method) === 'POST') {
    // parse JSON
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $user = (new UserRepository())->findByEmail($email);
    if (!$user || !password_verify($password, $user->password)) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid credentials']);
        exit;
    }

    require_once __DIR__ . '/Core/JwtService.php';
    $csrf = bin2hex(random_bytes(16));
    $token = JwtService::generateToken((int)$user->id, (int) JWT_ACCESS_EXPIRE, ['csrf' => $csrf]);

    header('Content-Type: application/json');
    echo json_encode([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => JWT_ACCESS_EXPIRE,
        'csrf_token' => $csrf,
    ]);
    exit;
}

// example API: get current user
if ($uri === '/api/me' && strtoupper($method) === 'GET') {
    require_once __DIR__ . '/Core/ApiAuth.php';
    $payload = require_api_auth(true);
    $user = api_current_user();
    header('Content-Type: application/json');
    echo json_encode(['id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    exit;
}

// example API: a protected POST endpoint that requires CSRF header
if ($uri === '/api/protected' && strtoupper($method) === 'POST') {
    require_once __DIR__ . '/Core/ApiAuth.php';
    $payload = require_api_auth(true);
    api_require_csrf(true);
    header('Content-Type: application/json');
    echo json_encode(['ok' => true, 'user' => $payload['sub']]);
    exit;
}

// Refresh token endpoint (rotation)
if ($uri === '/api/refresh' && strtoupper($method) === 'POST') {
    // expect JSON {"refresh_token":"..."}
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    $refresh = $data['refresh_token'] ?? null;
    if (!$refresh) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing refresh_token']);
        exit;
    }

    require_once __DIR__ . '/Services/RefreshTokenService.php';
    $rot = RefreshTokenService::rotate($refresh);
    if (!$rot) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid or expired refresh token']);
        exit;
    }

    $userId = (int)$rot['user_id'];
    $newRefresh = $rot['new']['token'];
    $csrf = bin2hex(random_bytes(16));
    $access = JwtService::generateToken($userId, (int) JWT_ACCESS_EXPIRE, ['csrf' => $csrf]);

    header('Content-Type: application/json');
    echo json_encode([
        'access_token' => $access,
        'refresh_token' => $newRefresh,
        'csrf_token' => $csrf,
        'expires_in' => JWT_ACCESS_EXPIRE,
    ]);
    exit;
}

// Logout (revoke refresh token provided)
if ($uri === '/api/logout' && strtoupper($method) === 'POST') {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
    $refresh = $data['refresh_token'] ?? null;
    if (!$refresh) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing refresh_token']);
        exit;
    }
    require_once __DIR__ . '/Services/RefreshTokenService.php';
    $ok = RefreshTokenService::revoke($refresh);
    header('Content-Type: application/json');
    echo json_encode(['revoked' => $ok]);
    exit;
}

if ($uri === '/logout') {
    $auth->logout();
    exit;
}

// Dashboard route
if ($uri === '/dashboard') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/DashboardController.php';
    $controller = new DashboardController();
    $controller->index($user);
    exit;
}

// API: Dashboard metrics
if ($uri === '/api/dashboard/metrics' && strtoupper($method) === 'GET') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/DashboardController.php';
    $controller = new DashboardController();
    $controller->getMetricsJson();
    exit;
}

if ($uri === '/admin') {
    $user = require_login();
    require_admin(); // Require admin role
    $repo = new UserRepository();
    $users = $repo->listAll(50, 0);
    include __DIR__ . '/../resources/views/admin/dashboard.php';
    exit;
}

// Admin: Audit logs viewer
if ($uri === '/admin/audits') {
    $user = require_login();
    require_permission('system.view_audit_logs');
    require_once __DIR__ . '/../app/Services/AuditService.php';
    $action = $_GET['action'] ?? null;
    $start = $_GET['start'] ?? null; // YYYY-MM-DD
    $end = $_GET['end'] ?? null;     // YYYY-MM-DD
    $severity = $_GET['severity'] ?? null;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $perPage = 50;
    $offset = ($page - 1) * $perPage;

    // Export handling with column selection, pagination, and JSON/CSV + export all
    $format = $_GET['format'] ?? 'csv';
    $exportAll = isset($_GET['export_all']) && $_GET['export_all'] === '1';
    $columnsParam = $_GET['columns'] ?? null; // comma-separated
    $availableCols = ['id','action','user_id','model','model_id','before_data','after_data','ip','created_at'];
    $columns = $availableCols;
    if ($columnsParam) {
        $parts = array_filter(array_map('trim', explode(',', $columnsParam)));
        $cols = [];
        foreach ($parts as $p) {
            if (in_array($p, $availableCols)) $cols[] = $p;
        }
        if ($cols) $columns = $cols;
    }

    if ($format === 'csv') {
        header('Content-Type: text/csv');
        $fn = 'audit_logs' . ($start ? "_from_$start" : '') . ($end ? "_to_$end" : '') . ($exportAll ? '_all' : '') . '.' . date('Ymd') . '.csv';
        header('Content-Disposition: attachment; filename="' . $fn . '"');
        $out = fopen('php://output', 'w');
        fputcsv($out, $columns, ',', '"', '\\');

        if ($exportAll) {
            $limit = 1000;
            $offset2 = 0;
            while (true) {
                $rows = AuditService::queryEntries($action, $start, $end, $limit, $offset2);
                if (!$rows) break;
                foreach ($rows as $e) {
                    $line = [];
                    foreach ($columns as $c) $line[] = $e[$c] ?? '';
                    fputcsv($out, $line, ',', '"', '\\');
                }
                $offset2 += $limit;
            }
        } else {
            $entries = AuditService::queryEntries($action, $start, $end, 10000, 0);
            foreach ($entries as $e) {
                $line = [];
                foreach ($columns as $c) $line[] = $e[$c] ?? '';
                fputcsv($out, $line, ',', '"', '\\');
            }
        }
        fclose($out);
        exit;
    }

    if ($format === 'json') {
        if ($exportAll) {
            header('Content-Type: application/x-ndjson');
            $limit = 1000; $offset2 = 0;
            while (true) {
                $rows = AuditService::queryEntries($action, $start, $end, $limit, $offset2);
                if (!$rows) break;
                foreach ($rows as $e) {
                    $outRow = [];
                    foreach ($columns as $c) $outRow[$c] = $e[$c] ?? null;
                    echo json_encode($outRow, JSON_UNESCAPED_SLASHES) . "\n";
                }
                $offset2 += $limit;
            }
            exit;
        } else {
            $entries = AuditService::queryEntries($action, $start, $end, 10000, 0);
            $out = [];
            foreach ($entries as $e) {
                $row = [];
                foreach ($columns as $c) $row[$c] = $e[$c] ?? null;
                $out[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }
    }

    $entries = AuditService::queryEntries($action, $start, $end, $perPage, $offset);
    include __DIR__ . '/../resources/views/admin/audits.php';
    exit;
}

// Admin: Scheduled Exports CRUD
if ($uri === '/admin/scheduled-exports') {
    $user = require_login();
    require_permission('system.manage_exports');
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::index();
    exit;
}

// Admin: Settings
if ($uri === '/admin/settings') {
    $user = require_login();
    require_permission('system.manage_settings');
    require_once __DIR__ . '/Controllers/Admin/SettingsController.php';
    app\Controllers\Admin\SettingsController::edit();
    exit;
}

if ($uri === '/admin/settings/update' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('system.manage_settings');
    require_once __DIR__ . '/Controllers/Admin/SettingsController.php';
    app\Controllers\Admin\SettingsController::update();
    exit;
}

// Admin: Token Management
if ($uri === '/admin/tokens') {
    $user = require_login();
    require_permission('system.manage_tokens');
    include __DIR__ . '/../resources/views/admin/tokens.php';
    exit;
}

if ($uri === '/admin/scheduled-exports/create') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::createForm();
    exit;
}

if ($uri === '/admin/scheduled-exports/generate-timers') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::generateTimers();
    exit;
}

if ($uri === '/admin/scheduled-exports/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::store();
    exit;
}

if (preg_match('#^/admin/scheduled-exports/([0-9]+)/edit$#', $uri, $m)) {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::editForm((int)$m[1]);
    exit;
}

if (preg_match('#^/admin/scheduled-exports/([0-9]+)/update$#', $uri, $m) && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::update((int)$m[1]);
    exit;
}

if (preg_match('#^/admin/scheduled-exports/([0-9]+)/delete$#', $uri, $m)) {
    $user = require_login();
    require_once __DIR__ . '/Controllers/Admin/ScheduledExportController.php';
    app\Controllers\Admin\ScheduledExportController::delete((int)$m[1]);
    exit;
}

// Admin: Users management
if ($uri === '/admin/users') {
    $user = require_login();
    $repo = new UserRepository();
    $users = $repo->listAll(50, 0);
    include __DIR__ . '/../resources/views/admin/users.php';
    exit;
}

// Admin: Roles & Permissions
if ($uri === '/admin/roles') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Roles & Permissions - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Roles & Permissions</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Role-based access control management coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Departments
if ($uri === '/admin/departments') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Departments - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Departments</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Department management coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Activity Monitor
if ($uri === '/admin/activity') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Activity Monitor - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Activity Monitor</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Real-time activity monitoring coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Reports
if ($uri === '/admin/reports') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Reports - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Reports</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Report generation and analytics coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Background Jobs
if ($uri === '/admin/jobs') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Background Jobs - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Background Jobs</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Job queue management coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Workflows
if ($uri === '/admin/workflows') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Workflows - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Workflows</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Workflow automation coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Notifications
if ($uri === '/admin/notifications') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Notifications - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Notifications</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Notification center coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Integrations
if ($uri === '/admin/integrations') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Integrations - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Integrations</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Third-party integrations management coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Database
if ($uri === '/admin/database') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Database - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Database Management</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Database tools and migration management coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Documentation
if ($uri === '/admin/documentation') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Documentation - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Documentation</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">System documentation coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// Admin: Support
if ($uri === '/admin/support') {
    $user = require_login();
    ?>
    <!doctype html>
    <html><head><title>Support - Nexus ERP</title><link href="/css/tailwind.css" rel="stylesheet"></head>
    <body class="bg-gray-50 p-8">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8"><a href="/admin" class="text-primary-600 hover:text-primary-800">&larr; Back to Dashboard</a></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Support</h1>
        <div class="bg-white shadow rounded-lg p-6">
          <p class="text-gray-600">Support and help desk coming soon.</p>
        </div>
      </div>
    </body></html>
    <?php
    exit;
}

// ============================================================================
// HR MODULE ROUTES
// ============================================================================

// HR: List employees
if ($uri === '/hr') {
    $user = require_login();
    require_permission('hr.view_employees');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->index();
    exit;
}

// HR: Create employee form
if ($uri === '/hr/create') {
    $user = require_login();
    require_permission('hr.create_employee');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->create();
    exit;
}

// HR: Store employee
if ($uri === '/hr/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('hr.create_employee');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->store();
    exit;
}

// HR: Show employee
if (preg_match('#^/hr/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'GET') {
    $user = require_login();
    require_permission('hr.view_employees');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->show((int)$m[1]);
    exit;
}

// HR: Edit employee form
if (preg_match('#^/hr/([0-9]+)/edit$#', $uri, $m)) {
    $user = require_login();
    require_permission('hr.edit_employee');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->edit((int)$m[1]);
    exit;
}

// HR: Update employee
if (preg_match('#^/hr/([0-9]+)/update$#', $uri, $m) && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('hr.edit_employee');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->update((int)$m[1]);
    exit;
}

// HR: Delete employee
if (preg_match('#^/hr/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'DELETE') {
    $user = require_login();
    require_permission('hr.delete_employee');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->destroy((int)$m[1]);
    exit;
}

// HR: Attendance
if ($uri === '/hr/attendance') {
    $user = require_login();
    require_permission('hr.view_attendance');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->attendance();
    exit;
}

// HR: Store attendance
if ($uri === '/hr/attendance/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('hr.manage_attendance');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->storeAttendance();
    exit;
}

// HR: Payroll
if ($uri === '/hr/payroll') {
    $user = require_login();
    require_permission('hr.view_payroll');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->payroll();
    exit;
}

// HR: Store payroll
if ($uri === '/hr/payroll/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('hr.manage_payroll');
    require_once __DIR__ . '/Controllers/HRController.php';
    $controller = new HRController();
    $controller->storePayroll();
    exit;
}

// ============================================================================
// INVENTORY MODULE ROUTES
// ============================================================================

// Inventory: List products
if ($uri === '/inventory') {
    $user = require_login();
    require_permission('inventory.view_products');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->index();
    exit;
}

// Inventory: Create product form
if ($uri === '/inventory/create') {
    $user = require_login();
    require_permission('inventory.create_product');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->create();
    exit;
}

// Inventory: Store product
if ($uri === '/inventory/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('inventory.create_product');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->store();
    exit;
}

// Inventory: Show product
if (preg_match('#^/inventory/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'GET') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->show((int)$m[1]);
    exit;
}

// Inventory: Edit product form
if (preg_match('#^/inventory/([0-9]+)/edit$#', $uri, $m)) {
    $user = require_login();
    require_permission('inventory.edit_product');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->edit((int)$m[1]);
    exit;
}

// Inventory: Update product
if (preg_match('#^/inventory/([0-9]+)/update$#', $uri, $m) && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('inventory.edit_product');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->update((int)$m[1]);
    exit;
}

// Inventory: Delete product
if (preg_match('#^/inventory/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'DELETE') {
    $user = require_login();
    require_permission('inventory.delete_product');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->destroy((int)$m[1]);
    exit;
}

// Inventory: Stock movements
if ($uri === '/inventory/movements') {
    $user = require_login();
    require_permission('inventory.manage_stock');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->movements();
    exit;
}

// Inventory: Store movement
if ($uri === '/inventory/movements/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('inventory.manage_stock');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->storeMovement();
    exit;
}

// Inventory: Suppliers
if ($uri === '/inventory/suppliers') {
    $user = require_login();
    require_permission('inventory.view_suppliers');
    require_once __DIR__ . '/Controllers/InventoryController.php';
    $controller = new InventoryController();
    $controller->suppliers();
    exit;
}

// ============================================================================
// SALES MODULE ROUTES
// ============================================================================

// Sales: List orders
if ($uri === '/sales') {
    $user = require_login();
    require_permission('sales.view_orders');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->index();
    exit;
}

// Sales: Create order form
if ($uri === '/sales/create') {
    $user = require_login();
    require_permission('sales.create_order');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->create();
    exit;
}

// Sales: Store order
if ($uri === '/sales/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('sales.create_order');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->store();
    exit;
}

// Sales: Show order
if (preg_match('#^/sales/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'GET') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->show((int)$m[1]);
    exit;
}

// Sales: Update order status
if (preg_match('#^/sales/([0-9]+)/status$#', $uri, $m) && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->updateStatus((int)$m[1]);
    exit;
}

// Sales: Delete order
if (preg_match('#^/sales/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'DELETE') {
    $user = require_login();
    require_permission('sales.delete_order');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->destroy((int)$m[1]);
    exit;
}

// Sales: Customers
if ($uri === '/sales/customers') {
    $user = require_login();
    require_permission('sales.view_customers');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->customers();
    exit;
}

// Sales: Store customer
if ($uri === '/sales/customers/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->storeCustomer();
    exit;
}

// Sales: Invoices
if ($uri === '/sales/invoices') {
    $user = require_login();
    require_permission('sales.view_invoices');
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->invoices();
    exit;
}

// Sales: Generate invoice
if (preg_match('#^/sales/([0-9]+)/invoice$#', $uri, $m) && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/SalesController.php';
    $controller = new SalesController();
    $controller->generateInvoice((int)$m[1]);
    exit;
}

// ============================================================================
// ACCOUNTS MODULE ROUTES
// ============================================================================

// Accounts: List accounts (chart of accounts)
if ($uri === '/accounts') {
    $user = require_login();
    require_permission('accounts.view_chart');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->index();
    exit;
}

// Accounts: Create account form
if ($uri === '/accounts/create') {
    $user = require_login();
    require_permission('accounts.create_account');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->create();
    exit;
}

// Accounts: Store account
if ($uri === '/accounts/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('accounts.create_account');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->store();
    exit;
}

// Accounts: Show account
if (preg_match('#^/accounts/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'GET') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->show((int)$m[1]);
    exit;
}

// Accounts: Delete account
if (preg_match('#^/accounts/([0-9]+)$#', $uri, $m) && strtoupper($method) === 'DELETE') {
    $user = require_login();
    require_permission('accounts.delete_account');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->destroy((int)$m[1]);
    exit;
}

// Accounts: General ledger
if ($uri === '/accounts/ledger') {
    $user = require_login();
    require_permission('accounts.view_ledger');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->ledger();
    exit;
}

// Accounts: Post ledger entry
if ($uri === '/accounts/ledger/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_permission('accounts.post_entry');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->storeEntry();
    exit;
}

// Accounts: Expenses
if ($uri === '/accounts/expenses') {
    $user = require_login();
    require_permission('accounts.view_expenses');
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->expenses();
    exit;
}

// Accounts: Store expense
if ($uri === '/accounts/expenses/store' && strtoupper($method) === 'POST') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->storeExpense();
    exit;
}

// Accounts: Financial reports
if ($uri === '/accounts/reports') {
    $user = require_login();
    require_once __DIR__ . '/Controllers/AccountsController.php';
    $controller = new AccountsController();
    $controller->reports();
    exit;
}

// 404
http_response_code(404);
?><!doctype html>
<html><body><h1>404 Not Found</h1><p>No route for <?php echo htmlentities($uri); ?></p></body></html>
