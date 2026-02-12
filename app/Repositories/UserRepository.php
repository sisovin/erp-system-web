<?php
/**
 * Basic User repository using PDO with Redis caching
 */
require_once __DIR__ . '/../Services/Database.php';
require_once __DIR__ . '/../Services/CacheManager.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    public function findByEmail(string $email): ?User
    {
        // Try cache first with email-specific key
        $cacheKey = CacheManager::buildKey(CacheManager::PREFIX_USER, 'email', $email);
        $cached = CacheManager::getEntity(CacheManager::PREFIX_USER, "email:{$email}");
        
        if ($cached !== null) {
            return is_array($cached) ? User::fromArray($cached) : null;
        }

        // Fallback to database
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        
        // Cache for future requests
        if ($row) {
            CacheManager::cacheEntity(CacheManager::PREFIX_USER, "email:{$email}", $row, CacheManager::TTL_MEDIUM);
            // Also cache by ID for consistency
            CacheManager::cacheEntity(CacheManager::PREFIX_USER, $row['id'], $row, CacheManager::TTL_MEDIUM);
        }
        
        return $row ? User::fromArray($row) : null;
    }

    public function findById(int $id): ?User
    {
        // Use cache-aside pattern with remember()
        $row = CacheManager::remember(
            CacheManager::PREFIX_USER,
            $id,
            function() use ($id) {
                $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
                $stmt->execute([$id]);
                return $stmt->fetch();
            },
            CacheManager::TTL_MEDIUM
        );
        
        return $row ? User::fromArray($row) : null;
    }

    public function create(array $data): ?User
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->pdo->prepare('INSERT INTO users (name,email,password,created_at,updated_at) VALUES (?,?,?,?,?)');
        $stmt->execute([
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null,
            $now,
            $now,
        ]);
        $id = (int) $this->pdo->lastInsertId();
        
        // Invalidate user lists cache after creation
        CacheManager::invalidateLists(CacheManager::PREFIX_USER);
        CacheManager::invalidateRelated([CacheManager::PREFIX_COUNT]);
        
        return $this->findById($id);
    }

    /**
     * List all users with pagination
     */
    public function listAll(int $limit = 50, int $offset = 0): array
    {
        // Cache list with params for uniqueness
        $params = ['limit' => $limit, 'offset' => $offset];
        $cached = CacheManager::getList(CacheManager::PREFIX_USER, $params);
        
        if ($cached !== null) {
            $ret = [];
            foreach ($cached as $row) {
                $ret[] = User::fromArray($row);
            }
            return $ret;
        }

        // Fetch from database
        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY id ASC LIMIT ? OFFSET ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        // Cache the result
        CacheManager::cacheList(CacheManager::PREFIX_USER, $params, $rows, CacheManager::TTL_SHORT);
        
        $ret = [];
        foreach ($rows as $row) {
            $ret[] = User::fromArray($row);
        }
        return $ret;
    }

    /**
     * Get all roles for a user
     */
    public function getRoles(int $userId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT r.* 
            FROM roles r
            INNER JOIN role_user ru ON r.id = ru.role_id
            WHERE ru.user_id = ?
            ORDER BY r.name ASC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get role names for a user (as flat array)
     */
    public function getRoleNames(int $userId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT r.name 
            FROM roles r
            INNER JOIN role_user ru ON r.id = ru.role_id
            WHERE ru.user_id = ?
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Get all permissions for a user (through their roles)
     */
    public function getPermissions(int $userId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT DISTINCT p.* 
            FROM permissions p
            INNER JOIN permission_role pr ON p.id = pr.permission_id
            INNER JOIN role_user ru ON pr.role_id = ru.role_id
            WHERE ru.user_id = ?
            ORDER BY p.name ASC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get permission names for a user (as flat array)
     */
    public function getPermissionNames(int $userId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT DISTINCT p.name 
            FROM permissions p
            INNER JOIN permission_role pr ON p.id = pr.permission_id
            INNER JOIN role_user ru ON pr.role_id = ru.role_id
            WHERE ru.user_id = ?
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(int $userId, string $roleName): bool
    {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) 
            FROM role_user ru
            INNER JOIN roles r ON ru.role_id = r.id
            WHERE ru.user_id = ? AND r.name = ?
        ');
        $stmt->execute([$userId, $roleName]);
        return (int) $stmt->fetchColumn() > 0;
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission(int $userId, string $permissionName): bool
    {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) 
            FROM permissions p
            INNER JOIN permission_role pr ON p.id = pr.permission_id
            INNER JOIN role_user ru ON pr.role_id = ru.role_id
            WHERE ru.user_id = ? AND p.name = ?
        ');
        $stmt->execute([$userId, $permissionName]);
        return (int) $stmt->fetchColumn() > 0;
    }

    /**
     * Assign a role to a user
     */
    public function assignRole(int $userId, int $roleId): bool
    {
        $stmt = $this->pdo->prepare('
            INSERT IGNORE INTO role_user (user_id, role_id) 
            VALUES (?, ?)
        ');
        $result = $stmt->execute([$userId, $roleId]);
        
        // Invalidate user's permission/role caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, $userId);
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, "roles:{$userId}");
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, "permissions:{$userId}");
        }
        
        return $result;
    }

    /**
     * Remove a role from a user
     */
    public function removeRole(int $userId, int $roleId): bool
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM role_user 
            WHERE user_id = ? AND role_id = ?
        ');
        $result = $stmt->execute([$userId, $roleId]);
        
        // Invalidate user's permission/role caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, $userId);
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, "roles:{$userId}");
            CacheManager::invalidateEntity(CacheManager::PREFIX_USER, "permissions:{$userId}");
        }
        
        return $result;
    }

    /**
     * Check if user is an admin (has 'admin' role)
     */
    public function isAdmin(int $userId): bool
    {
        return $this->hasRole($userId, 'admin');
    }
}
