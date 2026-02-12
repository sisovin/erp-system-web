# Peanech ERP - System Architecture Documentation

Comprehensive architectural design and technical implementation details.

---

## 📑 Table of Contents

1. [System Overview](#system-overview)
2. [Layered Architecture](#layered-architecture)
3. [Request/Response Flow](#requestresponse-flow)
4. [Authentication Architecture](#authentication-architecture)
5. [Authorization Architecture](#authorization-architecture)
6. [Database Schema Design](#database-schema-design)
7. [File Organization](#file-organization)
8. [Security Architecture](#security-architecture)
9. [Caching Strategy](#caching-strategy)
10. [Performance Optimization](#performance-optimization)
11. [Scalability & High Availability](#scalability--high-availability)
12. [Monitoring & Logging](#monitoring--logging)
13. [Testing Architecture](#testing-architecture)
14. [Deployment Architecture](#deployment-architecture)

---

## System Overview

### High-Level Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                        Client Layer                         │
│  (Browser: HTML, CSS, Tailwind, Vanilla JavaScript)         │
└───────────────────┬─────────────────────────────────────────┘
                    │
                    │ HTTP/HTTPS
                    ▼
┌─────────────────────────────────────────────────────────────┐
│                    Web Server Layer                         │
│  (Apache / Nginx / PHP Built-in Server)                     │
└───────────────────┬─────────────────────────────────────────┘
                    │
                    │ routes.php → URL Routing
                    ▼
┌─────────────────────────────────────────────────────────────┐
│                  Application Layer (PHP)                    │
│                                                              │
│  ┌──────────────┐    ┌──────────────┐   ┌──────────────┐  │
│  │ Controllers  │ ←→ │  Services    │ ← │ Repositories │  │
│  └──────────────┘    └──────────────┘   └──────────────┘  │
│         │                    │                   │          │
│         └────────────────────┼───────────────────┘          │
│                              │                              │
└──────────────────────────────┼──────────────────────────────┘
                               │
                               │ PDO / Redis
                               ▼
┌─────────────────────────────────────────────────────────────┐
│                     Data Layer                              │
│  ┌──────────────────┐          ┌──────────────────┐        │
│  │  MySQL Database │          │  Redis Cache     │        │
│  │  (Persistent)    │          │  (Ephemeral)     │        │
│  └──────────────────┘          └──────────────────┘        │
└─────────────────────────────────────────────────────────────┘
```

### Technology Stack

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Frontend** | HTML5, Tailwind CSS 4.1+, Vanilla JavaScript | User Interface |
| **Backend** | PHP 8.5+ | Application Logic |
| **Database** | MySQL 8.0+ | Data Persistence |
| **Caching** | Redis 7.x | Session & Data Cache |
| **Authentication** | JWT (JSON Web Tokens) | Stateless Auth |
| **Web Server** | Apache / Nginx | HTTP Handling |
| **Build Tools** | Composer, NPM, Tailwind CLI | Dependency & Asset Management |

---

## Layered Architecture

### MVC Architecture Pattern

```
┌─────────────────────────────────────────────────────────────┐
│                      Presentation Layer                     │
│  Views (resources/views/) - HTML Templates with PHP         │
│  - Render data from controllers                             │
│  - No business logic                                        │
│  - Pure presentation logic                                  │
└────────────────────┬────────────────────────────────────────┘
                     │
                     │ Data Binding
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                      Controller Layer                       │
│  Controllers (app/Controllers/) - Request Handlers          │
│  - Route HTTP requests                                      │
│  - Call services for business logic                         │
│  - Prepare data for views                                   │
│  - Handle HTTP responses                                    │
└────────────────────┬────────────────────────────────────────┘
                     │
                     │ Method Calls
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                      Service Layer                          │
│  Services (app/Services/) - Business Logic                  │
│  - Domain-specific operations                               │
│  - Data validation & transformation                         │
│  - Orchestrate multiple repositories                        │
│  - Transaction management                                   │
└────────────────────┬────────────────────────────────────────┘
                     │
                     │ Data Access
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                    Repository Layer                         │
│  Repositories (app/Repositories/) - Data Access             │
│  - CRUD operations                                          │
│  - Query building                                           │
│  - Data mapping (DB ↔ Objects)                              │
│  - Cache integration                                        │
└────────────────────┬────────────────────────────────────────┘
                     │
                     │ PDO Queries
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                       Data Layer                            │
│  Database (MySQL) - Persistent Storage                      │
│  - Relational data storage                                  │
│  - ACID transactions                                        │
│  - Referential integrity                                    │
└─────────────────────────────────────────────────────────────┘
```

### Core Components

1. **Routes** (`app/routes.php`): URL to controller mapping
2. **Controllers**: HTTP request orchestration
3. **Services**: Business logic encapsulation
4. **Repositories**: Data access abstraction
5. **Models**: Data representations (implicit PHP objects/arrays)
6. **Views**: HTML templates with embedded PHP

---

## Request/Response Flow

### Standard HTTP Request Flow

```
1. Client Request
   ↓
2. Web Server (Apache/Nginx)
   ↓
3. public/index.php (Entry Point)
   ↓
4. app/routes.php (Routing)
   ↓
   ┌─────────────────────────────────┐
   │ Route Matching Logic            │
   │ - Parse URI                     │
   │ - Match patterns                │
   │ - Extract parameters            │
   └─────────────┬───────────────────┘
                 │
                 ▼
5. Middleware (Authentication & Security)
   ├─ require_login() - Session/JWT validation
   ├─ enforce_csrf_on_post() - CSRF protection
   └─ Permission checks (RBAC)
   ↓
6. Controller Instantiation
   ↓
7. Controller Method Execution
   ├─ Request validation
   ├─ Call Service Layer
   └─ Prepare response data
   ↓
8. Service Layer Processing
   ├─ Business logic execution
   ├─ Data validation
   ├─ Repository calls
   └─ Transaction management
   ↓
9. Repository Data Access
   ├─ Build SQL queries
   ├─ Execute via PDO
   ├─ Fetch results
   └─ Return to service
   ↓
10. Controller Response
    ├─ Load view template
    ├─ Pass data to view
    └─ Render HTML
    ↓
11. HTTP Response
    ↓
12. Client (Browser renders)
```

### Example: Login Request Flow

```php
// 1. Browser POST to /login
POST /login HTTP/1.1
Content-Type: application/x-www-form-urlencoded

email=admin@example.com&password=secret

// 2. routes.php matches route
if ($uri === '/login' && $method === 'POST') {
    $auth->handleLogin();
}

// 3. AuthController->handleLogin()
- Validate credentials
- Check user exists (UserRepository)
- Verify password (HashService)
- Generate JWT (JwtService)
- Create session
- Redirect to dashboard

// 4. Response
HTTP/1.1 302 Found
Location: /dashboard
Set-Cookie: session_id=...
```

---

## Authentication Architecture

### JWT-Based Authentication System

```
┌─────────────────────────────────────────────────────────────┐
│                    Authentication Flow                      │
└─────────────────────────────────────────────────────────────┘

1. Login Request
   │
   ├─ Email + Password
   │
   ▼
2. AuthController->handleLogin()
   │
   ├─ UserRepository->findByEmail()
   ├─ password_verify() against Argon2id hash
   │
   ▼
3. Token Generation (JwtService)
   │
   ├─ Access Token (15 min TTL)
   ├─ Refresh Token (30 days TTL)
   ├─ CSRF Token (embedded in JWT claims)
   │
   ▼
4. Store Refresh Token in Database
   │
   ├─ refresh_tokens table
   ├─ With expiry, revocation support
   │
   ▼
5. Return Tokens to Client
   │
   ├─ JSON response with tokens
   └─ HTTP-only cookie (optional)

6. Subsequent Requests
   │
   ├─ Authorization: Bearer <access_token>
   │
   ▼
7. Middleware Validation (require_login)
   │
   ├─ Extract from session or header
   ├─ JwtService->validateToken()
   ├─ Check expiry, signature
   │
   ▼
8. Token Refresh Flow
   │
   ├─ Access token expired?
   ├─ POST /api/refresh with refresh_token
   ├─ RefreshTokenService->rotate()
   ├─ Issue new access + refresh tokens
   ├─ Revoke old refresh token
   │
   ▼
9. Logout
   │
   ├─ POST /api/logout
   ├─ RefreshTokenService->revoke()
   └─ Destroy session
```

### Password Security

**Hashing Algorithm**: Argon2id

```php
// HashService configuration
[
    'memory_cost' => 65536,  // 64 MB
    'time_cost' => 4,         // 4 iterations
    'threads' => 2            // 2 parallel threads
]

// Password hash example
$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
// Output: $argon2id$v=19$m=65536,t=4,p=2$...
```

**Key Features**:
- Salt automatically generated
- Memory-hard algorithm (GPU-resistant)
- Configurable parameters
- Built-in rehashing detection

### Session Management

```
Session Storage: PHP Native Sessions + Database (optional)

Session Data:
- user_id
- email
- name
- roles
- permissions
- csrf_token
- last_activity

Lifecycle:
- Created on login
- Updated on each request (last_activity)
- Destroyed on logout
- Auto-expired after 24h inactivity
```

---

## Authorization Architecture

### Role-Based Access Control (RBAC)

```
┌─────────────────────────────────────────────────────────────┐
│                       RBAC Structure                        │
└─────────────────────────────────────────────────────────────┘

Users (users table)
  │
  │ Many-to-Many
  ▼
Roles (roles table)
  │ - admin
  │ - hr_manager
  │ - inventory_manager
  │ - sales_manager
  │ - accountant
  │ - user
  │
  │ Many-to-Many
  ▼
Permissions (permissions table)
  │ - users.view
  │ - users.create
  │ - users.edit
  │ - users.delete
  │ - hr.view_attendance
  │ - inventory.manage_stock
  │ - sales.create_order
  │ - accounts.view_reports
  │ ... (30+ permissions)
```

### Permission Check Flow

```php
// Example: Check if user can create sales order

// 1. Get user's roles
$roles = UserRepository->getRoles($userId);

// 2. Get roles' permissions
$permissions = [];
foreach ($roles as $role) {
    $permissions = array_merge(
        $permissions,
        RoleRepository->getPermissions($role->id)
    );
}

// 3. Check permission exists
if (in_array('sales.create_order', $permissions)) {
    // Allow action
} else {
    // Deny with 403
}
```

### Middleware Implementation

```php
// app/Core/Auth.php

function require_permission(string $permission): void
{
    $user = require_login();
    $permissions = get_user_permissions($user->id);
    
    if (!in_array($permission, $permissions)) {
        http_response_code(403);
        die('Access Denied: Insufficient permissions');
    }
}

// Usage in routes
if ($uri === '/hr/payroll' && $method === 'GET') {
    $user = require_login();
    require_permission('hr.view_payroll');
    // ... controller logic
}
```

---

## Database Schema Design

### Entity-Relationship Diagram

```
┌──────────────┐        ┌──────────────┐        ┌──────────────┐
│    users     │────────│  role_user   │────────│    roles     │
│              │  M:N   │              │  M:N   │              │
│ - id         │        │ - user_id    │        │ - id         │
│ - name       │        │ - role_id    │        │ - name       │
│ - email      │        └──────────────┘        │ - label      │
│ - password   │                                 └──────┬───────┘
│ - created_at │                                        │
└──────────────┘                                        │ M:N
                                                        │
                                                        ▼
                                               ┌──────────────────┐
                                               │permission_role   │
                                               │ - role_id        │
                                               │ - permission_id  │
                                               └────────┬─────────┘
                                                        │
                                                        ▼
                                               ┌──────────────────┐
                                               │   permissions    │
                                               │ - id             │
                                               │ - name           │
                                               │ - label          │
                                               └──────────────────┘

┌──────────────┐        ┌──────────────┐
│  employees   │────────│  attendance  │
│              │   1:N  │              │
│ - id         │        │ - employee_id│
│ - employee_id│        │ - date       │
│ - first_name │        │ - check_in   │
│ - last_name  │        │ - check_out  │
│ - email      │        │ - status     │
│ - department │        └──────────────┘
│ - position   │
│ - salary     │        ┌──────────────┐
│ - status     │────────│   payroll    │
└──────────────┘   1:N  │ - employee_id│
                        │ - period     │
                        │ - base_salary│
                        │ - deductions │
                        │ - bonuses    │
                        │ - net_pay    │
                        └──────────────┘

┌──────────────┐        ┌──────────────────┐
│   products   │────────│ stock_movements  │
│              │   1:N  │                  │
│ - id         │        │ - product_id     │
│ - sku        │        │ - type (in/out)  │
│ - name       │        │ - quantity       │
│ - price      │        │ - reason         │
│ - stock      │        │ - created_at     │
│ - category   │        └──────────────────┘
└──────┬───────┘
       │
       │ M:1
       ▼
┌──────────────┐
│  suppliers   │
│              │
│ - id         │
│ - name       │
│ - contact    │
│ - email      │
└──────────────┘

┌──────────────┐        ┌──────────────┐        ┌──────────────┐
│  customers   │────────│ sales_orders │────────│ sales_items  │
│              │   1:N  │              │   1:N  │              │
│ - id         │        │ - customer_id│        │ - order_id   │
│ - name       │        │ - order_date │        │ - product_id │
│ - email      │        │ - total      │        │ - quantity   │
│ - phone      │        │ - status     │        │ - price      │
└──────────────┘        └──────┬───────┘        │ - discount   │
                               │                │ - tax        │
                               │ 1:1            └──────────────┘
                               ▼
                        ┌──────────────┐
                        │   invoices   │
                        │              │
                        │ - id         │
                        │ - order_id   │
                        │ - amount     │
                        │ - due_date   │
                        │ - status     │
                        └──────────────┘

┌──────────────┐        ┌──────────────────┐
│   accounts   │────────│ ledger_entries   │
│              │   1:N  │                  │
│ - id         │        │ - account_id     │
│ - code       │        │ - date           │
│ - name       │        │ - description    │
│ - type       │        │ - debit          │
│              │        │ - credit         │
└──────────────┘        │ - balance        │
                        └──────────────────┘

                        ┌──────────────┐
                        │   expenses   │
                        │              │
                        │ - date       │
                        │ - category   │
                        │ - amount     │
                        │ - status     │
                        │ - receipt    │
                        └──────────────┘
```

### Indexing Strategy

```sql
-- Primary Keys (Clustered Indexes)
- All tables have AUTO_INCREMENT PRIMARY KEY

-- Foreign Key Indexes
CREATE INDEX idx_role_user_user ON role_user(user_id);
CREATE INDEX idx_role_user_role ON role_user(role_id);
CREATE INDEX idx_attendance_employee ON attendance(employee_id);
CREATE INDEX idx_payroll_employee ON payroll(employee_id);
CREATE INDEX idx_stock_movements_product ON stock_movements(product_id);
CREATE INDEX idx_sales_orders_customer ON sales_orders(customer_id);
CREATE INDEX idx_sales_items_order ON sales_items(order_id);
CREATE INDEX idx_invoices_order ON invoices(order_id);
CREATE INDEX idx_ledger_account ON ledger_entries(account_id);

-- Query Optimization Indexes
CREATE INDEX idx_users_email ON users(email);  -- Login lookups
CREATE INDEX idx_products_sku ON products(sku);  -- SKU searches
CREATE INDEX idx_audit_logs_user_date ON audit_logs(user_id, created_at);  -- Audit queries
CREATE INDEX idx_refresh_tokens_token ON refresh_tokens(token);  -- Token lookups
```

### Normalization Level

**Third Normal Form (3NF)**: 
- No transitive dependencies
- All non-key attributes depend only on primary key
- Reduces data redundancy

**Denormalization Cases**:
- `sales_orders.total` - Cached calculation for performance
- `products.stock` - Real-time inventory level (updated via triggers/transactions)

---

## File Organization

### Directory Structure Philosophy

```
Framework-less MVC with Domain-Driven Organization

erp-system-web/
├── app/                    # Application core
│   ├── Controllers/        # HTTP request handlers
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   └── Admin/          # Admin namespace
│   │
│   ├── Core/               # Framework components
│   │   ├── Auth.php        # Authentication helpers
│   │   ├── JwtService.php  # JWT operations
│   │   ├── Security.php    # CSRF, XSS protection
│   │   └── ApiAuth.php     # API authentication
│   │
│   ├── Models/             # Domain entities
│   │   ├── User.php
│   │   └── ...
│   │
│   ├── Repositories/       # Data access layer
│   │   ├── UserRepository.php
│   │   ├── ScheduledExportRepository.php
│   │   └── SettingsRepository.php
│   │
│   ├── Services/           # Business logic
│   │   ├── Database.php    # PDO connection
│   │   ├── HashService.php # Password hashing
│   │   ├── AuditService.php
│   │   ├── ExportService.php
│   │   └── NotificationService.php
│   │
│   └── routes.php          # Route definitions
│
├── cli/                    # Command-line scripts
│   ├── migrate.php         # Database migrations
│   ├── seed.php            # Data seeding
│   ├── test_*.php          # Testing scripts
│   └── generate_*.php      # Code generators
│
├── config/                 # Configuration files
│   ├── env.php             # Environment loader
│   └── constants.php       # App constants
│
├── public/                 # Web root (document root)
│   ├── index.php           # Entry point
│   ├── css/
│   │   ├── app.css         # Compiled Tailwind
│   │   └── tailwind.css    # Source CSS
│   ├── images/
│   └── js/
│       └── app.js          # Client-side utilities
│
├── resources/              # Application resources
│   └── views/              # HTML templates
│       ├── layout/         # Layout templates
│       ├── auth/           # Authentication views
│       ├── dashboard/      # Dashboard views
│       ├── hr/             # HR module views
│       ├── inventory/      # Inventory views
│       ├── sales/          # Sales views
│       └── accounts/       # Accounting views
│
├── storage/                # Application storage
│   ├── exports/            # Generated exports
│   └── logs/               # Application logs
│
└── vendor/                 # Composer dependencies
```

### Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| **Files** | PascalCase | `UserController.php` |
| **Classes** | PascalCase | `class UserRepository` |
| **Methods** | camelCase | `function findByEmail()` |
| **Variables** | camelCase / snake_case | `$userId` or `$user_id` |
| **Constants** | UPPER_SNAKE_CASE | `DB_HOST` |
| **Database Tables** | snake_case, plural | `sales_orders` |
| **Database Columns** | snake_case | `created_at` |

---

## Security Architecture

### Defense in Depth Strategy

```
┌─────────────────────────────────────────────────────────────┐
│ Layer 1: Network Security                                   │
│ - HTTPS/TLS encryption                                      │
│ - Firewall rules                                            │
│ - IP whitelisting (optional)                                │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 2: Application Entry Points                           │
│ - CSRF protection on all POST requests                      │
│ - HTTP method validation                                    │
│ - Input size limits                                         │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 3: Authentication & Authorization                     │
│ - JWT token validation                                      │
│ - Session verification                                      │
│ - RBAC permission checks                                    │
│ - Token rotation & revocation                               │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 4: Input Validation                                   │
│ - Type checking                                             │
│ - Length validation                                         │
│ - Format validation (email, phone, etc.)                    │
│ - Business rule validation                                  │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 5: Output Encoding                                    │
│ - htmlspecialchars() for HTML context                       │
│ - JSON encoding for API responses                           │
│ - SQL escaping via prepared statements                      │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 6: Database Security                                  │
│ - Prepared statements (PDO)                                 │
│ - Parameterized queries                                     │
│ - Least privilege principle                                 │
│ - Connection encryption                                     │
└─────────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────────┐
│ Layer 7: Audit & Monitoring                                 │
│ - Comprehensive audit logging                               │
│ - Failed login tracking                                     │
│ - Anomaly detection                                         │
│ - Security event alerts                                     │
└─────────────────────────────────────────────────────────────┘
```

### CSRF Protection Implementation

```php
// Global CSRF enforcement (app/routes.php)
if (strtoupper($method) === 'POST' && !str_starts_with($uri, '/api')) {
    enforce_csrf_on_post(true, '/login');
}

// CSRF token generation
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Token validation (app/Core/Security.php)
function enforce_csrf_on_post(bool $enforce = true, string $excludePath = ''): void
{
    if (!$enforce) return;
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri === $excludePath) return;
    
    $token = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';
    
    if (!hash_equals($sessionToken, $token)) {
        http_response_code(403);
        die('CSRF token validation failed');
    }
}
```

### SQL Injection Prevention

```php
// ✅ CORRECT: Prepared statements
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
$stmt->execute([$email]);

// ❌ INCORRECT: Direct concatenation
$query = "SELECT * FROM users WHERE email = '$email'";  // NEVER DO THIS
```

### XSS Prevention

```php
// ✅ CORRECT: Output encoding
echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8');

// ❌ INCORRECT: Raw output
echo $user->name;  // XSS vulnerability
```

---

## Caching Strategy

### Redis Caching Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    Cache Hierarchy                          │
└─────────────────────────────────────────────────────────────┘

Application Request
  │
  ▼
┌───────────────────┐
│ Check Redis Cache │ ← Fast (< 1ms)
└────────┬──────────┘
         │
         ├─ Cache Hit? → Return data
         │
         └─ Cache Miss
            │
            ▼
┌─────────────────────┐
│   Query Database    │ ← Slower (10-100ms)
└──────────┬──────────┘
           │
           ▼
┌───────────────────────┐
│ Store in Redis Cache │ ← Write-through
│ with TTL             │
└───────────────────────┘
```

### Cache Key Structure

```
Pattern: {domain}:{entity}:{identifier}:{attribute}

Examples:
- user:profile:123              → User ID 123 profile data
- product:stock:SKU001          → SKU001 inventory level
- dashboard:metrics:daily       → Daily metrics cache
- sales:order:456               → Order ID 456 details
- session:abc123def             → Session data

TTL Strategy:
- Session data: 24 hours
- User profiles: 1 hour
- Product catalog: 15 minutes
- Dashboard metrics: 5 minutes
- Real-time data: No cache
```

### Cache Invalidation

```php
// Write-through caching
function updateProduct(int $id, array $data): bool
{
    // 1. Update database
    $stmt = $pdo->prepare("UPDATE products SET ... WHERE id = ?");
    $success = $stmt->execute([..., $id]);
    
    // 2. Invalidate cache
    if ($success) {
        $redis->del("product:details:$id");
        $redis->del("product:stock:$sku");
    }
    
    return $success;
}

// Cache-aside pattern
function getProduct(int $id): ?array
{
    // 1. Try cache
    $cached = $redis->get("product:details:$id");
    if ($cached) {
        return json_decode($cached, true);
    }
    
    // 2. Query database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 3. Store in cache
    if ($product) {
        $redis->setex("product:details:$id", 900, json_encode($product));
    }
    
    return $product;
}
```

---

## Performance Optimization

### Database Query Optimization

1. **Use Indexes Strategically**
   - Primary keys (auto-indexed)
   - Foreign keys
   - Frequently searched columns (email, SKU)
   - Composite indexes for common JOIN conditions

2. **Query Optimization Techniques**
   ```sql
   -- ✅ Efficient: Limited result set
   SELECT id, name, email FROM users WHERE status = 'active' LIMIT 100;
   
   -- ❌ Inefficient: SELECT *
   SELECT * FROM users;
   
   -- ✅ Efficient: Specific columns
   SELECT u.name, COUNT(o.id) as order_count 
   FROM users u
   LEFT JOIN sales_orders o ON u.id = o.customer_id
   WHERE u.created_at > '2026-01-01'
   GROUP BY u.id;
   ```

3. **N+1 Query Prevention**
   ```php
   // ❌ N+1 Problem: 101 queries for 100 orders
   $orders = $pdo->query("SELECT * FROM sales_orders")->fetchAll();
   foreach ($orders as $order) {
       $customer = $pdo->query("SELECT * FROM customers WHERE id = {$order['customer_id']}")->fetch();
   }
   
   // ✅ Solution: JOIN or eager loading
   $stmt = $pdo->query("
       SELECT o.*, c.name as customer_name 
       FROM sales_orders o
       JOIN customers c ON o.customer_id = c.id
   ");
   ```

### Frontend Optimization

1. **CSS Minification**: Tailwind CSS compiled and minified
2. **Asset Compression**: Gzip/Brotli on web server
3. **Lazy Loading**: Defer non-critical JavaScript
4. **HTTP/2**: Multiplexing and server push
5. **CDN**: Static assets via CDN (production)

### Application-Level Optimization

```php
// ✅ Batch operations
$stmt = $pdo->prepare("INSERT INTO audit_logs (...) VALUES (?, ?, ?)");
foreach ($logs as $log) {
    $stmt->execute([$log['user_id'], $log['action'], $log['data']]);
}

// ✅ Transaction batching
$pdo->beginTransaction();
try {
    // Multiple operations
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
}
```

---

## Scalability & High Availability

### Horizontal Scaling Architecture

```
                    Load Balancer (Nginx/HAProxy)
                              │
          ┌──────────────────┴──────────────────┐
          │                                      │
     App Server 1                          App Server 2
     (PHP-FPM)                              (PHP-FPM)
          │                                      │
          └──────────────────┬──────────────────┘
                             │
                    ┌────────┴────────┐
                    │                 │
               Redis Cluster    MySQL Primary
             (Session Storage)       │
                              ┌──────┴──────┐
                              │             │
                         Read Replica  Read Replica
```

### Database Replication

```sql
-- Primary-Replica Setup
Primary (Write): All INSERT, UPDATE, DELETE
Replicas (Read): SELECT queries

Connection Routing:
- Write queries → Primary
- Read queries → Least-loaded replica
- Failover: Promote replica to primary
```

### Session Management at Scale

```php
// Redis-based session handling
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

// Session stickiness not required
// Any app server can handle any request
```

---

## Monitoring & Logging

### Audit Logging System

```php
// Comprehensive audit trail
audit_logs table:
- user_id: Who performed the action
- event: What action was performed
- entity_type: Resource affected (user, product, order)
- entity_id: Specific resource ID
- before_data: JSON snapshot before change
- after_data: JSON snapshot after change
- ip_address: Request origin
- user_agent: Client information
- created_at: Timestamp

// Usage
AuditService::log($userId, 'user.update', 'users', $userId, $before, $after);
```

### Application Logging

```php
// Error logging
error_log("Database connection failed: " . $e->getMessage());

// Custom logging
file_put_contents(
    __DIR__ . '/../storage/logs/app.log',
    date('Y-m-d H:i:s') . " - " . $message . PHP_EOL,
    FILE_APPEND
);
```

### Metrics to Monitor

- **Performance**: Response times, query execution times
- **Availability**: Uptime, error rates
- **Security**: Failed login attempts, CSRF violations
- **Business**: Daily sales, order count, inventory levels

---

## Testing Architecture

### Testing Pyramid

```
                △
              /   \
            /  E2E  \        ← Few, slow, expensive
          /           \
        /  Integration \    ← Medium count
      /                 \
    /    Unit Tests      \  ← Many, fast, cheap
  /_______________________\

Unit Tests: 70%
Integration Tests: 20%
End-to-End Tests: 10%
```

### Test Structure (Planned)

```
tests/
├── Unit/
│   ├── Services/
│   │   ├── HashServiceTest.php
│   │   ├── JwtServiceTest.php
│   │   └── AuditServiceTest.php
│   └── Repositories/
│       └── UserRepositoryTest.php
│
├── Integration/
│   ├── AuthenticationFlowTest.php
│   ├── OrderCreationTest.php
│   └── PayrollProcessingTest.php
│
└── E2E/
    └── UserJourneyTest.php
```

---

## Deployment Architecture

### Production Environment

```
                        Internet
                           │
                           ▼
                    [Cloudflare CDN]
                           │
                           ▼
                   [AWS/Azure LB]
                        /    \
                       /      \
            [Web Server 1]  [Web Server 2]
             Nginx+PHP-FPM   Nginx+PHP-FPM
                       \      /
                        \    /
                   [RDS MySQL Primary]
                           │
                    [Read Replicas]
                    
            [ElastiCache Redis Cluster]
            
            [S3/Blob Storage]
              (Exports, Backups)
```

### Deployment Checklist

- [ ] Environment variables configured
- [ ] Database migrated
- [ ] Assets compiled (CSS)
- [ ] File permissions set
- [ ] SSL certificate installed
- [ ] Firewall rules configured
- [ ] Backup strategy implemented
- [ ] Monitoring configured
- [ ] Log rotation set up

---

## Conclusion

This architecture provides:
- **Scalability**: Horizontal scaling ready
- **Security**: Defense in depth
- **Performance**: Multi-layer caching
- **Maintainability**: Clean separation of concerns
- **Reliability**: ACID transactions, audit trails
- **Extensibility**: Modular design for new features

For implementation details, see [README.md](README.md) and [INSTALLATION.md](INSTALLATION.md).
