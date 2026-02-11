<?php
// Front controller / bootstrap for Nexus ERP (minimal)
// Loads configuration constants and attempts to bootstrap the app.

// Load application constants (this also loads .env)
require_once __DIR__ . '/../config/constants.php';

// Autoloader (if present)
$autoloader = __DIR__ . '/../app/Core/Autoloader.php';
if (file_exists($autoloader)) {
    require_once $autoloader;
}

// Start session when needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Developer friendly message when routes are not present
$routes = __DIR__ . '/../app/routes.php';
if (file_exists($routes)) {
    require_once $routes;
    exit;
}

// Fallback informational page
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Nexus ERP</title>
  <style>body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#111;padding:2rem}</style>
</head>
<body>
  <h1>Nexus ERP</h1>
  <p>Bootstrap loaded. <strong>APP_ENV</strong>: <?php echo APP_ENV; ?> — <strong>APP_URL</strong>: <?php echo APP_URL; ?></p>
  <p>Missing routes: <code>app/routes.php</code>. If you have the full application, place it under <code>app/</code>.</p>
  <p>Default admin: <?php echo DEFAULT_ADMIN_EMAIL; ?></p>
</body>
</html>
