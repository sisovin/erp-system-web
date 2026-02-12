# Token Revocation System - Quick Reference

## Overview

The token revocation system provides comprehensive management of JWT refresh tokens, allowing administrators to monitor, revoke, and manage user sessions securely.

## Features Implemented

### 1. Database Structure
- `refresh_tokens` table with `revoked` column (tinyint)
- Tracks token family, expiration, and usage
- Cascading deletes when users are removed

### 2. RefreshTokenService Enhancements

#### Core Methods
```php
// Revoke specific token by ID
RefreshTokenService::revokeById(int $tokenId, ?int $adminUserId = null): bool

// Revoke all tokens for a user
RefreshTokenService::revokeAllForUser(int $userId): int

// Revoke all tokens in a family (security measure)
RefreshTokenService::revokeFamily(string $family, ?int $adminUserId = null): int
```

#### Query Methods
```php
// Get all tokens for a user
RefreshTokenService::getAllForUser(int $userId, bool $includeRevoked = false): array

// Get active token count
RefreshTokenService::getActiveCountForUser(int $userId): int

// Admin: Get all active tokens
RefreshTokenService::getAllActive(int $limit = 50, int $offset = 0): array

// Admin: Get all tokens with filters
RefreshTokenService::getAll(array $filters = [], int $limit = 50, int $offset = 0): array

// Get statistics
RefreshTokenService::getStatistics(): array

// Cleanup old expired tokens (maintenance)
RefreshTokenService::cleanupExpired(int $daysOld = 30): int
```

### 3. Admin UI (`/admin/tokens`)

**Features:**
- Statistics dashboard (total, active, revoked, expired tokens)
- Token listing with filtering
- Individual token revocation
- User information display
- Status badges (Active/Revoked/Expired)
- Pagination support
- Top users by active tokens

**Filters:**
- User ID
- Status (Active, Revoked, Expired)

**Actions:**
- Revoke individual token
- View token details (family, created, expires, last used)

### 4. Permission System

**New Permission:**
- `system.manage_tokens` - Required to access token management

**Assigned to:**
- Admin role by default

### 5. Audit Logging

All revocation actions are logged:
- `refresh_token_revoked` - Individual token revoked
- `refresh_token_family_revoked` - Family of tokens revoked
- `revoked_all_refresh_tokens` - All user tokens revoked
- `refresh_token_replay_detected` - Replay attack detected (auto-revokes all user tokens)

## Usage Examples

### For Administrators

#### View Token Management Dashboard
1. Navigate to `/admin/tokens`
2. View statistics and active tokens
3. Use filters to find specific tokens

#### Revoke a Specific Token
1. Find the token in the list
2. Click "Revoke" button
3. Confirm action
4. Token is marked as revoked and becomes invalid

#### Filter Tokens
```
- Filter by User ID: Enter user ID number
- Filter by Status: Select Active/Revoked/Expired
- Click "Filter" button
```

### For Developers

#### Revoke User's Tokens Programmatically
```php
// Revoke all tokens for a user (e.g., on password change)
$count = RefreshTokenService::revokeAllForUser($userId);
echo "Revoked {$count} tokens";
```

#### Check Token Statistics
```php
$stats = RefreshTokenService::getStatistics();
echo "Active tokens: " . $stats['active'];
echo "Revoked tokens: " . $stats['revoked'];
```

#### Get User's Active Tokens
```php
$tokens = RefreshTokenService::getAllForUser($userId, false);
foreach ($tokens as $token) {
    echo "Token {$token['id']} created on {$token['created_at']}\n";
}
```

#### Cleanup Old Tokens
```php
// Delete tokens expired more than 30 days ago
$deleted = RefreshTokenService::cleanupExpired(30);
echo "Deleted {$deleted} old tokens";
```

## Security Features

### 1. Automatic Revocation
- Tokens are auto-revoked on rotation (prevents reuse)
- Replay attack detection triggers full user token revocation
- Password changes should trigger `revokeAllForUser()`

### 2. Audit Trail
- All revocation actions are logged with:
  - User ID performing the action
  - Token details
  - IP address
  - Timestamp
  - Severity level

### 3. Permission-Based Access
- Only users with `system.manage_tokens` permission can manage tokens
- Typically restricted to system administrators

## Migration

### For Fresh Installations
- Run `php cli/seed.php` to create permission

### For Existing Installations
```bash
# Add the new permission and assign to admin role
php cli/migrate_token_management_permission.php
```

## Access the Feature

### Navigation
1. Log in as admin
2. Navigate to Admin Dashboard
3. Click "Token Management" in System menu
   - *Note: Menu link may need to be manually added to `admin_layout.php`*
4. Or directly access: `/admin/tokens`

### Manual Menu Link Addition
Add this to `resources/views/layout/admin_layout.php` in the System section:

```php
<a href="/admin/tokens" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('tokens', $activeMenu); ?> rounded-lg transition ">
  <i data-feather="key" class="w-5 h-5 mr-3 stroke-current"></i>
  Token Management
</a>
```

## Best Practices

### When to Revoke Tokens

1. **User Password Change** - Always revoke all tokens
```php
RefreshTokenService::revokeAllForUser($userId);
```

2. **User Logout from All Devices** - User-initiated
```php
RefreshTokenService::revokeAllForUser($userId);
```

3. **Security Incident** - Admin-initiated
```php
RefreshTokenService::revokeById($tokenId, $adminId);
```

4. **Account Lockout** - Automated
```php
RefreshTokenService::revokeAllForUser($userId);
```

### Maintenance

**Regular Cleanup:**
```php
// Run weekly or monthly via cron
php cli/cleanup_tokens.php

// Or call directly
RefreshTokenService::cleanupExpired(30);
```

## API Integration

### Check if Token is Revoked
```php
$token = RefreshTokenService::findByRawToken($rawToken);
if (!$token) {
    // Token is revoked, expired, or invalid
    throw new Exception('Invalid token');
}
```

### Rotate Token (Built-in Revocation)
```php
$result = RefreshTokenService::rotate($oldToken);
if (!$result) {
    // Rotation failed (possibly replay attack)
    // All user tokens are automatically revoked
}
```

## Troubleshooting

### Permission Denied
- Ensure user has `system.manage_tokens` permission
- Check role assignments
- Run migration if permission doesn't exist

### Tokens Not Showing
- Check database connection
- Verify `refresh_tokens` table exists
- Check filters are not too restrictive

### Revocation Not Working
- Verify database write permissions
- Check audit logs for error messages
- Ensure token ID is correct

## Related Files

- **Service:** `app/Services/RefreshTokenService.php`
- **View:** `resources/views/admin/tokens.php`
- **Routes:** `app/routes.php` (line ~340)
- **Migration:** `cli/migrate_token_management_permission.php`
- **Schema:** `cli/schema.sql` (refresh_tokens table)
- **Seed:** `cli/seed.php` (permission seeding)

## Future Improvements

Potential enhancements:
1. Device tracking (user agent,IP)
2. Bulk revocation by IP address
3. Token usage analytics
4. Geographic-based revocation
5. Export token report to CSV
6. Real-time token monitoring
7. Automatic revocation rules (e.g., inactive for X days)

---

**Version:** 1.0  
**Last Updated:** February 2026  
**Requires:** PHP 8.5+, MySQL 8.0+
