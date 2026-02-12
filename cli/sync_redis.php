<?php
/**
 * Redis Cache Synchronization CLI
 * 
 * This tool helps manage and synchronize Redis cache.
 * 
 * Usage:
 *   php cli/sync_redis.php [command]
 * 
 * Commands:
 *   flush        - Clear all cached data
 *   info         - Display Redis connection and cache statistics
 *   test         - Test Redis connection
 *   warmup       - Pre-populate cache with frequently accessed data
 *   validate     - Validate cache integrity
 *   keys         - List all cached keys (optional pattern)
 * 
 * Examples:
 *   php cli/sync_redis.php flush
 *   php cli/sync_redis.php info
 *   php cli/sync_redis.php keys "user:*"
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../app/Services/RedisService.php';
require_once __DIR__ . '/../app/Services/Database.php';

class RedisSyncCLI
{
    private $redis;
    private $colors = [
        'reset'   => "\033[0m",
        'red'     => "\033[31m",
        'green'   => "\033[32m",
        'yellow'  => "\033[33m",
        'blue'    => "\033[34m",
        'magenta' => "\033[35m",
        'cyan'    => "\033[36m",
        'white'   => "\033[37m",
        'bold'    => "\033[1m",
    ];

    public function __construct()
    {
        RedisService::init();
        $this->redis = RedisService::class;
    }

    public function run(array $args): void
    {
        $command = $args[1] ?? 'info';

        $this->printBanner();

        switch ($command) {
            case 'flush':
                $this->flush();
                break;
            case 'info':
                $this->info();
                break;
            case 'test':
                $this->test();
                break;
            case 'warmup':
                $this->warmup();
                break;
            case 'validate':
                $this->validate();
                break;
            case 'keys':
                $pattern = $args[2] ?? '*';
                $this->listKeys($pattern);
                break;
            case 'help':
            case '--help':
            case '-h':
                $this->help();
                break;
            default:
                $this->error("Unknown command: {$command}");
                $this->help();
                exit(1);
        }
    }

    private function flush(): void
    {
        $this->info("🗑️  Flushing Redis cache...\n");

        if (!$this->redis::isAvailable()) {
            $this->error("Redis is not available.");
            exit(1);
        }

        if ($this->confirm("Are you sure you want to clear all cached data?")) {
            $this->redis::flush();
            $this->success("✅ Cache flushed successfully!");
        } else {
            $this->warning("⚠️  Operation cancelled.");
        }
    }

    private function info(): void
    {
        $this->info("📊 Redis Cache Information\n");

        if (!$this->redis::isAvailable()) {
            $this->error("❌ Redis is not available.");
            $this->warning("\nPlease check:");
            echo "  - Redis server is running\n";
            echo "  - Redis extension is installed (pecl install redis)\n";
            echo "  - Connection settings in .env file\n";
            exit(1);
        }

        $info = $this->redis::info();
        
        $this->success("✅ Redis Connection: Active\n");
        echo $this->colorize("Host: ", 'cyan') . $info['host'] . "\n";
        echo $this->colorize("Port: ", 'cyan') . $info['port'] . "\n";
        echo $this->colorize("Database: ", 'cyan') . $info['database'] . "\n";
        echo $this->colorize("Status: ", 'cyan') . ($info['connected'] ? 'Connected' : 'Disconnected') . "\n";

        // Get additional statistics
        echo "\n" . $this->colorize("Cache Statistics:", 'bold') . "\n";
        $this->displayCacheStats();
    }

    private function test(): void
    {
        $this->info("🧪 Testing Redis Connection...\n");

        if (!$this->redis::isAvailable()) {
            $this->error("❌ Connection failed!");
            exit(1);
        }

        // Test write
        $testKey = 'test:' . time();
        $testValue = 'Hello, Redis!';
        
        echo "Writing test data... ";
        $this->redis::set($testKey, $testValue, 10);
        $this->success("✓");

        // Test read
        echo "Reading test data... ";
        $retrieved = $this->redis::get($testKey);
        if ($retrieved === $testValue) {
            $this->success("✓");
        } else {
            $this->error("✗ (Value mismatch)");
            exit(1);
        }

        // Test delete
        echo "Deleting test data... ";
        $this->redis::delete($testKey);
        $this->success("✓");

        // Verify deletion
        echo "Verifying deletion... ";
        if (!$this->redis::exists($testKey)) {
            $this->success("✓");
        } else {
            $this->error("✗ (Key still exists)");
            exit(1);
        }

        $this->success("\n✅ All tests passed!");
    }

    private function warmup(): void
    {
        $this->info("🔥 Warming up cache...\n");

        if (!$this->redis::isAvailable()) {
            $this->warning("Redis not available. Skipping warmup.");
            return;
        }

        $cached = 0;

        // Cache frequently accessed data
        try {
            $pdo = Database::getPdo();

            // Cache user roles
            echo "Caching user roles... ";
            $stmt = $pdo->query('SELECT * FROM roles');
            $roles = $stmt->fetchAll();
            $this->redis::set('cache:roles:all', $roles, 3600);
            $cached++;
            $this->success("✓");

            // Cache permissions
            echo "Caching permissions... ";
            $stmt = $pdo->query('SELECT * FROM permissions');
            $permissions = $stmt->fetchAll();
            $this->redis::set('cache:permissions:all', $permissions, 3600);
            $cached++;
            $this->success("✓");

            // Cache products
            echo "Caching products... ";
            $stmt = $pdo->query('SELECT * FROM products LIMIT 100');
            $products = $stmt->fetchAll();
            $this->redis::set('cache:products:list', $products, 1800);
            $cached++;
            $this->success("✓");

            // Cache customers
            echo "Caching customers... ";
            $stmt = $pdo->query('SELECT * FROM customers LIMIT 100');
            $customers = $stmt->fetchAll();
            $this->redis::set('cache:customers:list', $customers, 1800);
            $cached++;
            $this->success("✓");

            $this->success("\n✅ Warmed up {$cached} cache entries!");

        } catch (Exception $e) {
            $this->error("\n❌ Error during warmup: " . $e->getMessage());
            exit(1);
        }
    }

    private function validate(): void
    {
        $this->info("🔍 Validating cache integrity...\n");

        if (!$this->redis::isAvailable()) {
            $this->warning("Redis not available. Cannot validate.");
            return;
        }

        $issues = 0;

        // Check for expired keys
        echo "Checking for expired data... ";
        // Note: Redis automatically removes expired keys, so this checks TTLs
        $keys = $this->getAllKeys('cache:*');
        $expiredCount = 0;
        foreach ($keys as $key) {
            $ttl = $this->redis::ttl($key);
            if ($ttl === -2) {
                $expiredCount++;
                $issues++;
            }
        }
        if ($expiredCount > 0) {
            $this->warning("⚠️  Found {$expiredCount} expired keys");
        } else {
            $this->success("✓");
        }

        // Check for corrupted data
        echo "Checking for corrupted data... ";
        $corrupted = 0;
        foreach ($keys as $key) {
            $value = $this->redis::get($key);
            if ($value === false && $this->redis::exists($key)) {
                $corrupted++;
                $issues++;
            }
        }
        if ($corrupted > 0) {
            $this->error("✗ Found {$corrupted} corrupted entries");
        } else {
            $this->success("✓");
        }

        if ($issues === 0) {
            $this->success("\n✅ Cache is healthy!");
        } else {
            $this->warning("\n⚠️  Found {$issues} issues. Consider running 'flush' to clear problematic entries.");
        }
    }

    private function listKeys(string $pattern): void
    {
        $this->info("🔑 Listing cached keys (pattern: {$pattern})\n");

        if (!$this->redis::isAvailable()) {
            $this->error("Redis not available.");
            exit(1);
        }

        $keys = $this->getAllKeys($pattern);
        
        if (empty($keys)) {
            $this->warning("No keys found matching pattern: {$pattern}");
            return;
        }

        echo $this->colorize("Found " . count($keys) . " key(s):\n\n", 'bold');

        foreach ($keys as $key) {
            $ttl = $this->redis::ttl($key);
            $ttlStr = $ttl === -1 ? 'No expiry' : ($ttl === -2 ? 'Expired' : "{$ttl}s");
            
            echo $this->colorize("  • ", 'cyan') . $key;
            echo $this->colorize(" (TTL: {$ttlStr})", 'yellow') . "\n";
        }
    }

    private function displayCacheStats(): void
    {
        $keys = $this->getAllKeys('*');
        $totalKeys = count($keys);

        echo "Total Keys: {$totalKeys}\n";

        if ($totalKeys > 0) {
            // Group by prefix
            $prefixes = [];
            foreach ($keys as $key) {
                $parts = explode(':', $key);
                $prefix = $parts[0] ?? 'other';
                $prefixes[$prefix] = ($prefixes[$prefix] ?? 0) + 1;
            }

            echo "\nKeys by prefix:\n";
            foreach ($prefixes as $prefix => $count) {
                echo "  {$prefix}: {$count}\n";
            }

            // Memory estimation
            $estimatedSize = 0;
            foreach ($keys as $key) {
                $value = $this->redis::get($key);
                $estimatedSize += strlen(serialize($value));
            }
            $sizeKB = round($estimatedSize / 1024, 2);
            echo "\nEstimated Size: {$sizeKB} KB\n";
        }
    }

    private function getAllKeys(string $pattern): array
    {
        // Note: Using reflection to access Redis instance
        // In production, you might want to add a getKeys() method to RedisService
        try {
            $reflection = new ReflectionClass($this->redis);
            $property = $reflection->getProperty('redis');
            $property->setAccessible(true);
            $redisInstance = $property->getValue();
            
            if ($redisInstance && method_exists($redisInstance, 'keys')) {
                return $redisInstance->keys($pattern) ?: [];
            }
        } catch (Exception $e) {
            // Fallback: return empty array
        }
        
        return [];
    }

    private function confirm(string $question): bool
    {
        echo $this->colorize($question . ' [y/N]: ', 'yellow');
        $handle = fopen('php://stdin', 'r');
        $line = fgets($handle);
        fclose($handle);
        return strtolower(trim($line)) === 'y';
    }

    private function printBanner(): void
    {
        echo "\n";
        echo $this->colorize("╔════════════════════════════════════════╗\n", 'cyan');
        echo $this->colorize("║   ", 'cyan');
        echo $this->colorize("Redis Cache Synchronization", 'bold');
        echo $this->colorize("      ║\n", 'cyan');
        echo $this->colorize("╚════════════════════════════════════════╝\n", 'cyan');
        echo "\n";
    }

    private function help(): void
    {
        echo $this->colorize("Usage:\n", 'bold');
        echo "  php cli/sync_redis.php [command] [options]\n\n";
        
        echo $this->colorize("Commands:\n", 'bold');
        echo $this->colorize("  flush       ", 'green') . " - Clear all cached data\n";
        echo $this->colorize("  info        ", 'green') . " - Display Redis connection and statistics\n";
        echo $this->colorize("  test        ", 'green') . " - Test Redis connection\n";
        echo $this->colorize("  warmup      ", 'green') . " - Pre-populate cache with frequently accessed data\n";
        echo $this->colorize("  validate    ", 'green') . " - Validate cache integrity\n";
        echo $this->colorize("  keys        ", 'green') . " - List all cached keys (optional pattern)\n";
        echo $this->colorize("  help        ", 'green') . " - Display this help message\n\n";
        
        echo $this->colorize("Examples:\n", 'bold');
        echo "  php cli/sync_redis.php info\n";
        echo "  php cli/sync_redis.php keys \"cache:*\"\n";
        echo "  php cli/sync_redis.php warmup\n";
        echo "  php cli/sync_redis.php flush\n\n";
    }

    private function colorize(string $text, string $color): string
    {
        if (!isset($this->colors[$color])) {
            return $text;
        }
        return $this->colors[$color] . $text . $this->colors['reset'];
    }

    private function success(string $message): void
    {
        echo $this->colorize($message, 'green') . "\n";
    }

    private function error(string $message): void
    {
        echo $this->colorize($message, 'red') . "\n";
    }

    private function warning(string $message): void
    {
        echo $this->colorize($message, 'yellow') . "\n";
    }

    private function info(string $message): void
    {
        echo $this->colorize($message, 'blue');
    }
}

// Run CLI
if (php_sapi_name() === 'cli') {
    $cli = new RedisSyncCLI();
    $cli->run($argv);
} else {
    die('This script must be run from the command line.');
}
