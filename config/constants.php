<?php
// Application constants loaded from environment
require_once __DIR__ . '/env.php';

defined('APP_ENV') or define('APP_ENV', env('APP_ENV', 'production'));
defined('APP_DEBUG') or define('APP_DEBUG', filter_var(env('APP_DEBUG', 'false'), FILTER_VALIDATE_BOOLEAN));
defined('APP_URL') or define('APP_URL', env('APP_URL', 'http://localhost'));

// Database
defined('DB_CONNECTION') or define('DB_CONNECTION', env('DB_CONNECTION', 'mysql'));
defined('DB_HOST') or define('DB_HOST', env('DB_HOST', '127.0.0.1'));
defined('DB_PORT') or define('DB_PORT', env('DB_PORT', '3306'));
defined('DB_DATABASE') or define('DB_DATABASE', env('DB_DATABASE', 'erp_system'));
defined('DB_USERNAME') or define('DB_USERNAME', env('DB_USERNAME', 'root'));
defined('DB_PASSWORD') or define('DB_PASSWORD', env('DB_PASSWORD', ''));

// Redis
defined('REDIS_HOST') or define('REDIS_HOST', env('REDIS_HOST', '127.0.0.1'));
defined('REDIS_PORT') or define('REDIS_PORT', env('REDIS_PORT', 6379));
defined('REDIS_PASSWORD') or define('REDIS_PASSWORD', env('REDIS_PASSWORD', null));

// JWT
defined('JWT_SECRET') or define('JWT_SECRET', env('JWT_SECRET', 'please-change-this'));
defined('JWT_ALGO') or define('JWT_ALGO', env('JWT_ALGO', 'HS256'));
defined('JWT_ACCESS_EXPIRE') or define('JWT_ACCESS_EXPIRE', (int) env('JWT_ACCESS_EXPIRE', 900));
defined('JWT_REFRESH_EXPIRE') or define('JWT_REFRESH_EXPIRE', (int) env('JWT_REFRESH_EXPIRE', 604800));

// Mail
defined('MAIL_HOST') or define('MAIL_HOST', env('MAIL_HOST', ''));
defined('MAIL_PORT') or define('MAIL_PORT', env('MAIL_PORT', 25));
defined('MAIL_USERNAME') or define('MAIL_USERNAME', env('MAIL_USERNAME', null));
defined('MAIL_PASSWORD') or define('MAIL_PASSWORD', env('MAIL_PASSWORD', null));
defined('MAIL_FROM') or define('MAIL_FROM', env('MAIL_FROM', 'admin@example.com'));

// Defaults
defined('DEFAULT_ADMIN_EMAIL') or define('DEFAULT_ADMIN_EMAIL', env('DEFAULT_ADMIN_EMAIL', 'admin@example.com'));
defined('DEFAULT_ADMIN_PASSWORD') or define('DEFAULT_ADMIN_PASSWORD', env('DEFAULT_ADMIN_PASSWORD', 'password'));
