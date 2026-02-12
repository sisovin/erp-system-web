<?php
/**
 * Cache Manager Service
 * 
 * Provides structured caching with key naming conventions,
 * write-through patterns, and automatic invalidation.
 */

require_once __DIR__ . '/RedisService.php';

class CacheManager
{
    // Cache key prefixes for different entities
    const PREFIX_USER = 'user';
    const PREFIX_ROLE = 'role';
    const PREFIX_PERMISSION = 'permission';
    const PREFIX_PRODUCT = 'product';
    const PREFIX_CUSTOMER = 'customer';
    const PREFIX_EMPLOYEE = 'employee';
    const PREFIX_SETTING = 'setting';
    const PREFIX_AUDIT = 'audit';
    const PREFIX_LIST = 'list';
    const PREFIX_COUNT = 'count';
    const PREFIX_STATS = 'stats';

    // Default TTL values (in seconds)
    const TTL_SHORT = 300;      // 5 minutes
    const TTL_MEDIUM = 1800;    // 30 minutes
    const TTL_LONG = 3600;      // 1 hour
    const TTL_DAY = 86400;      // 24 hours
    const TTL_WEEK = 604800;    // 7 days

    /**
     * Build a structured cache key
     * 
     * @param string $prefix Entity prefix
     * @param string|int $identifier Unique identifier
     * @param string|null $suffix Optional suffix
     * @return string Formatted cache key
     */
    public static function buildKey(string $prefix, $identifier, ?string $suffix = null): string
    {
        $key = "{$prefix}:{$identifier}";
        if ($suffix) {
            $key .= ":{$suffix}";
        }
        return $key;
    }

    /**
     * Build a list cache key
     * 
     * @param string $prefix Entity prefix
     * @param array $params Query parameters for uniqueness
     * @return string Formatted cache key
     */
    public static function buildListKey(string $prefix, array $params = []): string
    {
        $key = self::PREFIX_LIST . ":{$prefix}";
        if (!empty($params)) {
            ksort($params);
            $paramString = http_build_query($params);
            $hash = md5($paramString);
            $key .= ":{$hash}";
        }
        return $key;
    }

    /**
     * Cache a single entity (write-through)
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @param mixed $data Data to cache
     * @param int $ttl Time to live
     * @return bool Success status
     */
    public static function cacheEntity(string $prefix, $id, $data, int $ttl = self::TTL_MEDIUM): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $key = self::buildKey($prefix, $id);
        return RedisService::set($key, $data, $ttl);
    }

    /**
     * Get cached entity
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @return mixed|null Cached data or null
     */
    public static function getEntity(string $prefix, $id)
    {
        if (!RedisService::isAvailable()) {
            return null;
        }

        $key = self::buildKey($prefix, $id);
        return RedisService::get($key);
    }

    /**
     * Get entity with fallback to database (cache-aside pattern)
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @param callable $callback Database fetch callback
     * @param int $ttl Time to live
     * @return mixed Entity data
     */
    public static function remember(string $prefix, $id, callable $callback, int $ttl = self::TTL_MEDIUM)
    {
        if (!RedisService::isAvailable()) {
            return $callback();
        }

        $key = self::buildKey($prefix, $id);
        return RedisService::remember($key, $callback, $ttl);
    }

    /**
     * Cache a list/collection (write-through)
     * 
     * @param string $prefix Entity prefix
     * @param array $params Query parameters
     * @param array $data List data to cache
     * @param int $ttl Time to live
     * @return bool Success status
     */
    public static function cacheList(string $prefix, array $params, array $data, int $ttl = self::TTL_SHORT): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $key = self::buildListKey($prefix, $params);
        return RedisService::set($key, $data, $ttl);
    }

    /**
     * Get cached list
     * 
     * @param string $prefix Entity prefix
     * @param array $params Query parameters
     * @return array|null Cached list or null
     */
    public static function getList(string $prefix, array $params = []): ?array
    {
        if (!RedisService::isAvailable()) {
            return null;
        }

        $key = self::buildListKey($prefix, $params);
        $data = RedisService::get($key);
        return is_array($data) ? $data : null;
    }

    /**
     * Cache counter/statistics
     * 
     * @param string $prefix Entity prefix
     * @param string $metric Metric name
     * @param int|float $value Value to cache
     * @param int $ttl Time to live
     * @return bool Success status
     */
    public static function cacheCounter(string $prefix, string $metric, $value, int $ttl = self::TTL_SHORT): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $key = self::buildKey(self::PREFIX_COUNT, $prefix, $metric);
        return RedisService::set($key, $value, $ttl);
    }

    /**
     * Get cached counter
     * 
     * @param string $prefix Entity prefix
     * @param string $metric Metric name
     * @return int|float|null Counter value or null
     */
    public static function getCounter(string $prefix, string $metric)
    {
        if (!RedisService::isAvailable()) {
            return null;
        }

        $key = self::buildKey(self::PREFIX_COUNT, $prefix, $metric);
        return RedisService::get($key);
    }

    /**
     * Invalidate a single entity cache
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @return bool Success status
     */
    public static function invalidateEntity(string $prefix, $id): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $key = self::buildKey($prefix, $id);
        return RedisService::delete($key);
    }

    /**
     * Invalidate all caches for an entity type
     * 
     * @param string $prefix Entity prefix
     * @return bool Success status
     */
    public static function invalidateAll(string $prefix): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        // Invalidate all keys matching prefix
        $pattern = "{$prefix}:*";
        return RedisService::deletePattern($pattern);
    }

    /**
     * Invalidate all list caches for an entity type
     * 
     * @param string $prefix Entity prefix
     * @return bool Success status
     */
    public static function invalidateLists(string $prefix): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $pattern = self::PREFIX_LIST . ":{$prefix}:*";
        return RedisService::deletePattern($pattern);
    }

    /**
     * Invalidate related caches (cascade invalidation)
     * 
     * @param array $prefixes Array of entity prefixes to invalidate
     * @return bool Success status
     */
    public static function invalidateRelated(array $prefixes): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        $success = true;
        foreach ($prefixes as $prefix) {
            $success = self::invalidateAll($prefix) && $success;
            $success = self::invalidateLists($prefix) && $success;
        }

        return $success;
    }

    /**
     * Write-through: Update entity in cache after DB write
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @param mixed $data Updated data
     * @param int $ttl Time to live
     * @return bool Success status
     */
    public static function writeThrough(string $prefix, $id, $data, int $ttl = self::TTL_MEDIUM): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        // Update the entity cache
        self::cacheEntity($prefix, $id, $data, $ttl);

        // Invalidate related list caches
        self::invalidateLists($prefix);

        // Invalidate counters
        $counterPattern = self::PREFIX_COUNT . ":{$prefix}:*";
        RedisService::deletePattern($counterPattern);

        return true;
    }

    /**
     * Write-through with cascade: Update and invalidate related entities
     * 
     * @param string $prefix Primary entity prefix
     * @param int|string $id Entity ID
     * @param mixed $data Updated data
     * @param array $relatedPrefixes Related entity prefixes to invalidate
     * @param int $ttl Time to live
     * @return bool Success status
     */
    public static function writeThroughCascade(string $prefix, $id, $data, array $relatedPrefixes = [], int $ttl = self::TTL_MEDIUM): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        // Update primary entity
        self::writeThrough($prefix, $id, $data, $ttl);

        // Invalidate related entities
        if (!empty($relatedPrefixes)) {
            self::invalidateRelated($relatedPrefixes);
        }

        return true;
    }

    /**
     * Delete-through: Remove from cache after DB delete
     * 
     * @param string $prefix Entity prefix
     * @param int|string $id Entity ID
     * @param array $relatedPrefixes Related prefixes to invalidate
     * @return bool Success status
     */
    public static function deleteThrough(string $prefix, $id, array $relatedPrefixes = []): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        // Delete entity cache
        self::invalidateEntity($prefix, $id);

        // Invalidate lists
        self::invalidateLists($prefix);

        // Invalidate counters
        $counterPattern = self::PREFIX_COUNT . ":{$prefix}:*";
        RedisService::deletePattern($counterPattern);

        // Invalidate related entities
        if (!empty($relatedPrefixes)) {
            self::invalidateRelated($relatedPrefixes);
        }

        return true;
    }

    /**
     * Get cache statistics
     * 
     * @return array Statistics
     */
    public static function getStats(): array
    {
        if (!RedisService::isAvailable()) {
            return [
                'available' => false,
                'message' => 'Redis not available'
            ];
        }

        $info = RedisService::info();
        
        return [
            'available' => true,
            'connected' => $info['connected'],
            'host' => $info['host'],
            'port' => $info['port'],
            'database' => $info['database']
        ];
    }

    /**
     * Warm up cache with common data
     * 
     * @return array Results
     */
    public static function warmup(): array
    {
        if (!RedisService::isAvailable()) {
            return ['success' => false, 'message' => 'Redis not available'];
        }

        $results = [];

        try {
            require_once __DIR__ . '/Database.php';
            $pdo = Database::getPdo();

            // Cache all roles
            $stmt = $pdo->query('SELECT * FROM roles');
            $roles = $stmt->fetchAll();
            foreach ($roles as $role) {
                self::cacheEntity(self::PREFIX_ROLE, $role['id'], $role, self::TTL_LONG);
            }
            $results['roles'] = count($roles);

            // Cache all permissions
            $stmt = $pdo->query('SELECT * FROM permissions');
            $permissions = $stmt->fetchAll();
            foreach ($permissions as $permission) {
                self::cacheEntity(self::PREFIX_PERMISSION, $permission['id'], $permission, self::TTL_LONG);
            }
            $results['permissions'] = count($permissions);

            // Cache settings
            $stmt = $pdo->query('SELECT * FROM settings');
            $settings = $stmt->fetchAll();
            foreach ($settings as $setting) {
                self::cacheEntity(self::PREFIX_SETTING, $setting['key'], $setting, self::TTL_DAY);
            }
            $results['settings'] = count($settings);

            $results['success'] = true;

        } catch (Exception $e) {
            $results['success'] = false;
            $results['error'] = $e->getMessage();
        }

        return $results;
    }

    /**
     * Clear all application caches
     * 
     * @return bool Success status
     */
    public static function flush(): bool
    {
        if (!RedisService::isAvailable()) {
            return false;
        }

        return RedisService::flush();
    }
}
