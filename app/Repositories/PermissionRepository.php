<?php
/**
 * Permission Repository - Manages permissions with Redis caching
 */
require_once __DIR__ . '/../Services/Database.php';
require_once __DIR__ . '/../Services/CacheManager.php';

class PermissionRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Get all permissions
     */
    public function getAllPermissions(): array
    {
        // Cache all permissions list
        return CacheManager::remember(
            CacheManager::PREFIX_PERMISSION,
            'all',
            function() {
                $stmt = $this->pdo->query('SELECT * FROM permissions ORDER BY name ASC');
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG // Permissions rarely change
        );
    }

    /**
     * Get permission by ID
     */
    public function findById(int $id): ?array
    {
        // Cache individual permission
        $row = CacheManager::remember(
            CacheManager::PREFIX_PERMISSION,
            $id,
            function() use ($id) {
                $stmt = $this->pdo->prepare('SELECT * FROM permissions WHERE id = ? LIMIT 1');
                $stmt->execute([$id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG
        );
        
        return $row ?: null;
    }

    /**
     * Get permission by name
     */
    public function findByName(string $name): ?array
    {
        // Cache by name
        $row = CacheManager::remember(
            CacheManager::PREFIX_PERMISSION,
            "name:{$name}",
            function() use ($name) {
                $stmt = $this->pdo->prepare('SELECT * FROM permissions WHERE name = ? LIMIT 1');
                $stmt->execute([$name]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            },
            CacheManager::TTL_LONG
        );
        
        return $row ?: null;
    }

    /**
     * Get all roles that have a specific permission
     */
    public function getRolesWithPermission(int $permissionId): array
    {
        $stmt = $this->pdo->prepare('
            SELECT r.* 
            FROM roles r
            INNER JOIN permission_role pr ON r.id = pr.role_id
            WHERE pr.permission_id = ?
            ORDER BY r.name ASC
        ');
        $stmt->execute([$permissionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new permission
     */
    public function create(string $name, string $label): ?int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO permissions (name, label) 
            VALUES (?, ?)
        ');
        if ($stmt->execute([$name, $label])) {
            $id = (int) $this->pdo->lastInsertId();
            
            // Invalidate permission caches
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, "all");
            CacheManager::invalidateLists(CacheManager::PREFIX_PERMISSION);
            
            return $id;
        }
        return null;
    }

    /**
     * Update a permission
     */
    public function update(int $id, string $name, string $label): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE permissions 
            SET name = ?, label = ? 
            WHERE id = ?
        ');
        $result = $stmt->execute([$name, $label, $id]);
        
        // Invalidate permission caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, $id);
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, "all");
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, "name:{$name}");
            CacheManager::invalidateLists(CacheManager::PREFIX_PERMISSION);
        }
        
        return $result;
    }

    /**
     * Delete a permission (and its relationships)
     */
    public function delete(int $id): bool
    {
        // First remove all role assignments
        $stmt = $this->pdo->prepare('DELETE FROM permission_role WHERE permission_id = ?');
        $stmt->execute([$id]);
        
        // Delete the permission
        $stmt = $this->pdo->prepare('DELETE FROM permissions WHERE id = ?');
        $result = $stmt->execute([$id]);
        
        // Invalidate permission caches
        if ($result) {
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, $id);
            CacheManager::invalidateEntity(CacheManager::PREFIX_PERMISSION, "all");
            CacheManager::invalidateLists(CacheManager::PREFIX_PERMISSION);
            // Also invalidate role caches since permissions were removed
            CacheManager::invalidateAll(CacheManager::PREFIX_ROLE);
        }
        
        return $result;
    }

    /**
     * Get permissions grouped by module (prefix before the dot)
     */
    public function getPermissionsGroupedByModule(): array
    {
        $permissions = $this->getAllPermissions();
        $grouped = [];
        
        foreach ($permissions as $perm) {
            $parts = explode('.', $perm['name']);
            $module = $parts[0] ?? 'general';
            
            if (!isset($grouped[$module])) {
                $grouped[$module] = [];
            }
            
            $grouped[$module][] = $perm;
        }
        
        return $grouped;
    }
}
