<?php
/**
 * Redis Caching Service
 * 
 * Provides a simple interface for caching data using Redis.
 * Falls back gracefully if Redis is not available.
 */

class RedisService
{
    private static ?Redis $redis = null;
    private static bool $isAvailable = false;
    private static bool $initialized = false;

    /**
     * Initialize Redis connection
     */
    private static function init(): void
    {
        if (self::$initialized) {
            return;
        }

        self::$initialized = true;

        if (!class_exists('Redis')) {
            error_log('Redis extension not installed. Caching disabled.');
            return;
        }

        try {
            self::$redis = new Redis();
            
            $host = $_ENV['REDIS_HOST'] ?? '127.0.0.1';
            $port = (int) ($_ENV['REDIS_PORT'] ?? 6379);
            $timeout = (float) ($_ENV['REDIS_TIMEOUT'] ?? 2.0);
            $password = $_ENV['REDIS_PASSWORD'] ?? null;
            $database = (int) ($_ENV['REDIS_DATABASE'] ?? 0);

            $connected = self::$redis->connect($host, $port, $timeout);
            
            if (!$connected) {
                throw new Exception("Failed to connect to Redis at {$host}:{$port}");
            }

            if ($password) {
                self::$redis->auth($password);
            }

            if ($database > 0) {
                self::$redis->select($database);
            }

            self::$isAvailable = true;
            error_log("Redis connected successfully at {$host}:{$port}");
            
        } catch (Exception $e) {
            error_log("Redis connection failed: " . $e->getMessage());
            self::$redis = null;
            self::$isAvailable = false;
        }
    }

    /**
     * Check if Redis is available
     */
    public static function isAvailable(): bool
    {
        self::init();
        return self::$isAvailable;
    }

    /**
     * Get cached value
     * 
     * @param string $key Cache key
     * @return mixed|null Returns cached value or null if not found/error
     */
    public static function get(string $key)
    {
        self::init();
        
        if (!self::$isAvailable) {
            return null;
        }

        try {
            $value = self::$redis->get($key);
            
            if ($value === false) {
                return null;
            }

            // Try to unserialize if it's serialized data
            $unserialized = @unserialize($value);
            return $unserialized !== false ? $unserialized : $value;
            
        } catch (Exception $e) {
            error_log("Redis GET error for key '{$key}': " . $e->getMessage());
            return null;
        }
    }

    /**
     * Set cached value
     * 
     * @param string $key Cache key
     * @param mixed $value Value to cache
     * @param int $ttl Time to live in seconds (0 = no expiration)
     * @return bool Success status
     */
    public static function set(string $key, $value, int $ttl = 3600): bool
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            // Serialize complex data types
            if (is_array($value) || is_object($value)) {
                $value = serialize($value);
            }

            if ($ttl > 0) {
                return self::$redis->setex($key, $ttl, $value);
            } else {
                return self::$redis->set($key, $value);
            }
            
        } catch (Exception $e) {
            error_log("Redis SET error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete cached value
     * 
     * @param string $key Cache key
     * @return bool Success status
     */
    public static function delete(string $key): bool
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->del($key) > 0;
        } catch (Exception $e) {
            error_log("Redis DELETE error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete multiple keys matching pattern
     * 
     * @param string $pattern Key pattern (e.g., "user:*")
     * @return int Number of keys deleted
     */
    public static function deletePattern(string $pattern): int
    {
        self::init();
        
        if (!self::$isAvailable) {
            return 0;
        }

        try {
            $keys = self::$redis->keys($pattern);
            if (empty($keys)) {
                return 0;
            }
            return self::$redis->del($keys);
        } catch (Exception $e) {
            error_log("Redis DELETE PATTERN error for pattern '{$pattern}': " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Check if key exists
     * 
     * @param string $key Cache key
     * @return bool
     */
    public static function exists(string $key): bool
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->exists($key) > 0;
        } catch (Exception $e) {
            error_log("Redis EXISTS error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Increment numeric value
     * 
     * @param string $key Cache key
     * @param int $by Increment amount
     * @return int|false New value or false on error
     */
    public static function increment(string $key, int $by = 1)
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->incrBy($key, $by);
        } catch (Exception $e) {
            error_log("Redis INCREMENT error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Set expiration time for key
     * 
     * @param string $key Cache key
     * @param int $ttl Time to live in seconds
     * @return bool Success status
     */
    public static function expire(string $key, int $ttl): bool
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->expire($key, $ttl);
        } catch (Exception $e) {
            error_log("Redis EXPIRE error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get remaining TTL for key
     * 
     * @param string $key Cache key
     * @return int|false TTL in seconds or false on error (-1 = no expiry, -2 = key doesn't exist)
     */
    public static function ttl(string $key)
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->ttl($key);
        } catch (Exception $e) {
            error_log("Redis TTL error for key '{$key}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Flush all cached data (use with caution!)
     * 
     * @return bool Success status
     */
    public static function flush(): bool
    {
        self::init();
        
        if (!self::$isAvailable) {
            return false;
        }

        try {
            return self::$redis->flushDB();
        } catch (Exception $e) {
            error_log("Redis FLUSH error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cache callback result with automatic key generation
     * 
     * @param string $key Cache key
     * @param callable $callback Function to execute if cache miss
     * @param int $ttl Time to live in seconds
     * @return mixed Cached or freshly generated value
     */
    public static function remember(string $key, callable $callback, int $ttl = 3600)
    {
        $cached = self::get($key);
        
        if ($cached !== null) {
            return $cached;
        }

        $value = $callback();
        self::set($key, $value, $ttl);
        
        return $value;
    }

    /**
     * Get connection info for debugging
     * 
     * @return array Connection information
     */
    public static function info(): array
    {
        self::init();
        
        return [
            'available' => self::$isAvailable,
            'host' => $_ENV['REDIS_HOST'] ?? '127.0.0.1',
            'port' => $_ENV['REDIS_PORT'] ?? 6379,
            'database' => $_ENV['REDIS_DATABASE'] ?? 0,
        ];
    }
}
