# Data Layer Overview

This document explains the data layer conventions for the Nexus ERP project and how to connect/use the database safely.

1) PDO (MySQL) - recommended
- Use PHP PDO for all database interactions (prepared statements by default).
- Connection helper (example):

```php
// Example: app/Services/Database.php (not added here)
$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_DATABASE);
$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
```

2) Repositories
- Use a repository layer (`app/Repositories/`) to encapsulate queries and mapping to models.
- Keep SQL in the repository and business logic in `app/Services/`.

3) Migrations & Seeds
- `cli/migrate.php` contains SQL create statements for all tables (19 tables).
- `cli/seed.php` inserts the default admin user, roles, sample products, customers, and chart of accounts.

4) Caching
- Redis is used for caching. Use `REDIS_HOST` and `REDIS_PORT` from `config/constants.php`.
- Invalidate cache keys on writes (e.g., product stock changes).

5) Security
- Always use prepared statements and parameter binding to avoid SQL injection.
- Hash passwords with Argon2id via `password_hash()`.

6) Transactions
- Use PDO transactions for multi-step operations that must be atomic (orders + stock adjustments + ledger entries).

7) Environment
- Load `.env` with `config/env.php` which provides `env()` helper.
- Access runtime config with `config/constants.php` constants.

8) Quick checklist to connect locally
- Copy `.env.example` → `.env` (already added)
- Edit DB_* values
- Run `php cli/migrate.php` then `php cli/seed.php`
