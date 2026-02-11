<?php
// Simple .env loader and helper for PHP projects
// Places values into getenv() and $_ENV and provides env() helper

if (!function_exists('load_env_file')) {
    function load_env_file(string $path)
    {
        if (!file_exists($path) || !is_readable($path)) {
            return false;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            // split key and value on first '='
            if (!str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Remove surrounding quotes
            if (preg_match('/^(["\']).*\1$/', $value)) {
                $value = substr($value, 1, -1);
            }

            // don't override existing env vars
            if (getenv($key) === false) {
                putenv("$key=$value");
            }
            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
            }
        }

        return true;
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return $value;
    }
}

// Auto-load .env from project root if present
$rootEnv = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env';
if (file_exists($rootEnv)) {
    load_env_file($rootEnv);
}
