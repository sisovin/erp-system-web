# Cache Implementation Quick Reference

## Quick Start

### 1. Cache a Single Entity (Cache-Aside Pattern)

```php
$user = CacheManager::remember(
    CacheManager::PREFIX_USER,
    $userId,
    function() use ($userId) {
        // Database query only on cache miss
        return $this->queryDatabase($userId);
    },
    CacheManager::TTL_MEDIUM
);
```

### 2. Invalidate After Update

```php
public function update($id, $data) {
    $result = $this->dbUpdate($id, $data);
    
    if ($result) {
        // Invalidate the specific entity
        CacheManager::invalidateEntity(CacheManager::PREFIX_USER, $id);
        
        // Invalidate lists
        CacheManager::invalidateLists(CacheManager::PREFIX_USER);
    }
    
    return $result;
}
```

### 3. Cache a List/Collection

```php
$users = CacheManager::remember(
    CacheManager::PREFIX_LIST,
    "users:all",
    function() {
        return $this->getAllUsers();
    },
    CacheManager::TTL_SHORT
);
```

## Common Patterns

### Pattern: Find By ID

```php
public function findById(int $id): ?array
{
    return CacheManager::remember(
        CacheManager::PREFIX_USER,
        $id,
        fn() => $this->queryById($id),
        CacheManager::TTL_MEDIUM
    );
}
```

### Pattern: Find By Email (Dual-Key)

```php
public function findByEmail(string $email): ?array
{
    $cached = CacheManager::getEntity(
        CacheManager::PREFIX_USER,
        "email:{$email}"
    );
    
    if ($cached) return $cached;
    
    $user = $this->queryByEmail($email);
    
    if ($user) {
        // Cache by both email AND ID
        CacheManager::cacheEntity(
            CacheManager::PREFIX_USER,
            "email:{$email}",
            $user,
            CacheManager::TTL_MEDIUM
        );
        CacheManager::cacheEntity(
            CacheManager::PREFIX_USER,
            $user['id'],
            $user,
            CacheManager::TTL_MEDIUM
        );
    }
    
    return $user;
}
```

### Pattern: Create (Invalidate Lists)

```php
public function create(array $data): ?int
{
    $id = $this->insertIntoDatabase($data);
    
    if ($id) {
        // Invalidate list caches
        CacheManager::invalidateLists(CacheManager::PREFIX_USER);
        
        // Invalidate counters
        CacheManager::invalidateRelated([CacheManager::PREFIX_COUNT]);
    }
    
    return $id;
}
```

### Pattern: Update (Write-Through)

```php
public function update(int $id, array $data): bool
{
    $result = $this->updateDatabase($id, $data);
    
    if ($result) {
        $updated = $this->findById($id);
        CacheManager::writeThrough(
            CacheManager::PREFIX_USER,
            $id,
            $updated,
            CacheManager::TTL_MEDIUM
        );
    }
    
    return $result;
}
```

### Pattern: Delete (Delete-Through with Cascade)

```php
public function delete(int $id): bool
{
    $result = $this->deleteFromDatabase($id);
    
    if ($result) {
        CacheManager::deleteThrough(
            CacheManager::PREFIX_USER,
            $id,
            [CacheManager::PREFIX_ROLE, CacheManager::PREFIX_PERMISSION]
        );
    }
    
    return $result;
}
```

## Cache Prefixes

```php
CacheManager::PREFIX_USER       # user
CacheManager::PREFIX_ROLE       # role
CacheManager::PREFIX_PERMISSION # permission
CacheManager::PREFIX_PRODUCT    # product
CacheManager::PREFIX_CUSTOMER   # customer
CacheManager::PREFIX_EMPLOYEE   # employee
CacheManager::PREFIX_SETTING    # setting
CacheManager::PREFIX_AUDIT      # audit
CacheManager::PREFIX_LIST       # list
CacheManager::PREFIX_COUNT      # count
CacheManager::PREFIX_STATS      # stats
```

## TTL Constants

```php
CacheManager::TTL_SHORT   # 300 seconds (5 minutes)
CacheManager::TTL_MEDIUM  # 1800 seconds (30 minutes)
CacheManager::TTL_LONG    # 3600 seconds (1 hour)
CacheManager::TTL_DAY     # 86400 seconds (24 hours)
CacheManager::TTL_WEEK    # 604800 seconds (7 days)
```

## Invalidation Methods

```php
// Single entity
CacheManager::invalidateEntity($prefix, $id);

// All entities of type
CacheManager::invalidateAll($prefix);

// All lists for type
CacheManager::invalidateLists($prefix);

// Multiple related types
CacheManager::invalidateRelated([$prefix1, $prefix2]);

// Write-through (update + invalidate lists)
CacheManager::writeThrough($prefix, $id, $data, $ttl);

// Write-through with cascade
CacheManager::writeThroughCascade($prefix, $id, $data, [$related], $ttl);

// Delete-through (delete + invalidate lists + cascade)
CacheManager::deleteThrough($prefix, $id, [$related]);
```

## CLI Commands

```bash
# Cache info and stats
php cli/sync_redis.php info

# Test Redis connection
php cli/sync_redis.php test

# Warmup cache
php cli/sync_redis.php warmup

# Validate cache integrity
php cli/sync_redis.php validate

# List all keys
php cli/sync_redis.php keys

# List keys by pattern
php cli/sync_redis.php keys "user:*"

# Flush all cache
php cli/sync_redis.php flush
```

## Key Building

```php
// Build entity key
$key = CacheManager::buildKey($prefix, $id); 
// Result: "user:123"

// Build key with suffix
$key = CacheManager::buildKey($prefix, $id, 'roles');
// Result: "user:123:roles"

// Build list key
$key = CacheManager::buildListKey($prefix, ['limit' => 10]);
// Result: "list:user:a8f5f167f44f4964e6c998dee827110c"
```

## Common Use Cases

### Check if user has permission

```php
public function hasPermission(int $userId, string $perm): bool
{
    $permissions = CacheManager::remember(
        CacheManager::PREFIX_USER,
        "permissions:{$userId}",
        fn() => $this->queryUserPermissions($userId),
        CacheManager::TTL_MEDIUM
    );
    
    return in_array($perm, $permissions);
}
```

### Assign role (invalidate user caches)

```php
public function assignRole(int $userId, int $roleId): bool
{
    $result = $this->dbAssign($userId, $roleId);
    
    if ($result) {
        // Invalidate user entity
        CacheManager::invalidateEntity(
            CacheManager::PREFIX_USER,
            $userId
        );
        
        // Invalidate user's roles and permissions
        CacheManager::invalidateEntity(
            CacheManager::PREFIX_USER,
            "roles:{$userId}"
        );
        CacheManager::invalidateEntity(
            CacheManager::PREFIX_USER,
            "permissions:{$userId}"
        );
    }
    
    return $result;
}
```

### Cache statistics

```php
// Set counter
CacheManager::cacheCounter(
    CacheManager::PREFIX_USER,
    'total_active',
    $count,
    CacheManager::TTL_SHORT
);

// Get counter
$total = CacheManager::getCounter(
    CacheManager::PREFIX_USER,
    'total_active'
);
```

## Checklist for New Repository

- [ ] Add `require_once` for CacheManager
- [ ] Implement cache-aside pattern for `findById()`
- [ ] Implement cache-aside pattern for `findByName()` if applicable
- [ ] Cache list operations with params
- [ ] Invalidate on `create()`
- [ ] Invalidate on `update()` (write-through)
- [ ] Invalidate on `delete()` (delete-through)
- [ ] Invalidate related entities when applicable
- [ ] Choose appropriate TTL values
- [ ] Test cache hits/misses

## Debug Cache

```php
// Check if Redis available
if (CacheManager::isAvailable()) {
    // Redis is connected
}

// Get stats
$stats = CacheManager::getStats();
var_dump($stats);

// Manual cache operations
$data = CacheManager::getEntity($prefix, $id);
CacheManager::cacheEntity($prefix, $id, $data, $ttl);
CacheManager::invalidateEntity($prefix, $id);
```

## Performance Tips

1. **Use LONG TTL for rarely changing data** (roles, permissions)
2. **Use SHORT TTL for frequently changing data** (lists, counts)
3. **Always invalidate lists on create/update/delete**
4. **Cascade invalidation for related entities**
5. **Warm up cache after deployment** (`php cli/sync_redis.php warmup`)
6. **Monitor cache hit rates** (`php cli/sync_redis.php info`)

## Example: Complete Product Repository

```php
<?php
require_once __DIR__ . '/../Services/Database.php';
require_once __DIR__ . '/../Services/CacheManager.php';

class ProductRepository
{
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = Database::getPdo();
    }
    
    public function findById(int $id): ?array {
        return CacheManager::remember(
            CacheManager::PREFIX_PRODUCT,
            $id,
            function() use ($id) {
                $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = ?');
                $stmt->execute([$id]);
                return $stmt->fetch();
            },
            CacheManager::TTL_MEDIUM
        );
    }
    
    public function create(array $data): ?int {
        // Insert into database
        $stmt = $this->pdo->prepare('INSERT INTO products (...) VALUES (...)');
        $stmt->execute([...]);
        $id = $this->pdo->lastInsertId();
        
        // Invalidate lists
        CacheManager::invalidateLists(CacheManager::PREFIX_PRODUCT);
        
        return $id;
    }
    
    public function update(int $id, array $data): bool {
        // Update database
        $stmt = $this->pdo->prepare('UPDATE products SET ... WHERE id = ?');
        $result = $stmt->execute([..., $id]);
        
        // Write-through cache
        if ($result) {
            $updated = $this->findById($id);
            CacheManager::writeThrough(
                CacheManager::PREFIX_PRODUCT,
                $id,
                $updated,
                CacheManager::TTL_MEDIUM
            );
        }
        
        return $result;
    }
    
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = ?');
        $result = $stmt->execute([$id]);
        
        if ($result) {
            CacheManager::deleteThrough(
                CacheManager::PREFIX_PRODUCT,
                $id
            );
        }
        
        return $result;
    }
}
```
