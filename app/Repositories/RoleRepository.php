<?php
/**
 * Role Repository - Manages roles and role-permission relationships with Redis caching
 */
require_once __DIR__ . '/../Services/Database.php';
require_once __DIR__ . '/../Services/CacheManager.php';

class RoleRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Get all roles
     */
    public function getAllRoles(): array
    {
        // Use cache-aside pattern for role list
        return CacheManager::remember(
            CacheManager::PREFIX_ROLE,
            'all',
            function() {
                $stmt = $this->pdo->query('SELECT * FROM roles ORDER BY name ASC');
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG // Roles rarely change
        );
    }

    /**
     * Get role by ID
     */
    public function findById(int $id): ?array
    {
        // Cache individual role by ID
        $row = CacheManager::remember(
            CacheManager::PREFIX_ROLE,
            $id,
            function() use ($id) {
                $stmt = $this->pdo->prepare('SELECT * FROM roles WHERE id = ? LIMIT 1');
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG
        );
        
        return $row ?: null;
    }

    /**
     * Get role by name
     */
    public function findByName(string $name): ?array
    {
        // Cache by name
        $row = CacheManager::remember(
            CacheManager::PREFIX_ROLE,
            "name:{$name}",
            function() use ($name) {
                $stmt = $this->pdo->prepare('SELECT * FROM roles WHERE name = ? LIMIT 1');
                $stmt->execute([$name]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG
        );
        
        return $row ?: null;
    }

    /**
     * Get all permissions for a specific role
     */
    public function getPermissions(int $roleId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT p.* 
            FROM permissions p
            INNER JOIN permission_role pr ON p.id = pr.permission_id
            WHERE pr.role_id = ?
            ORDER BY p.name ASC
        ');
        $stmt->execute([$roleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get permission names for a role (as flat array)
     */
    public function getPermissionNames(int $roleId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT p.name 
            FROM permissions p
            INNER JOIN permission_role pr ON p.id = pr.permission_id
            WHERE pr.role_id = ?
        ');
        $stmt->execute([$roleId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Assign a permission to a role
     */
    public function assignPermission(int $roleId, int $permissionId): bool
    {
        $stmt = $this->pdo->prepare('
            INSERT IGNORE INTO permission_role (role_id, permission_id) 
            VALUES (?, ?)
        ');
        $result = $stmt->execute([$roleId, $permissionId]);
        
        // Invalidate role and permission caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_ROLE, $roleId);
            CacheManager::invalidateEntity(CacheManager::PREFIX_ROLE, "all");
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, $permissionId);
            CacheManager::invalidateLists(CacheManager::PREFIX_ROLE);
        }
        
        return $result;
    }

    /**
     * Remove a permission from a role
     */
    public function removePermission(int $roleId, int $permissionId): bool
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM permission_role 
            WHERE role_id = ? AND permission_id = ?
        ');
        $result = $stmt->execute([$roleId, $permissionId]);
        
        // Invalidate role and permission caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_ROLE, $roleId);
            CacheManager::invalidateEntity(CacheManager::PREFIX_ROLE, "all");
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, $permissionId);
            CacheManager::invalidateLists(CacheManager::PREFIX_ROLE);
        }
        
        return $result;
    }

    /**
     * Get all users with a specific role
     */
    public function getUsersWithRole(int $roleId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT u.* 
            FROM users u
            INNER JOIN role_user ru ON u.id = ru.user_id
            WHERE ru.role_id = ?
        ');
        $stmt->execute([$roleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new role
     */
    public function create(string $name, string $label): ?int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO roles (name, label) 
            VALUES (?, ?)
        ');
        if ($stmt->execute([$name, $label])) {
            return (int) $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * Update a role
     */
    public function update(int $id, string $name, string $label): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE roles 
            SET name = ?, label = ? 
            WHERE id = ?
        ');
        return $stmt->execute([$name, $label, $id]);
    }

    /**
     * Delete a role (and its relationships)
     */
    public function delete(int $id): bool
    {
        // First remove all permission assignments
        $stmt = $this->pdo->prepare('DELETE FROM permission_role WHERE role_id = ?');
        $stmt->execute([$id]);
        
        // Remove all user assignments
        $stmt = $this->pdo->prepare('DELETE FROM role_user WHERE role_id = ?');
        $stmt->execute([$id]);
        
        // Finally delete the role
        $stmt = $this->pdo->prepare('DELETE FROM roles WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
