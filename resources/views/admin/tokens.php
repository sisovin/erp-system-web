<?php
require_once __DIR__ . '/../../app/Core/Auth.php';
require_once __DIR__ . '/../../app/Services/RefreshTokenService.php';

require_login();
require_permission('system.manage_tokens');

$pageTitle = 'Token Management';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $tokenId = isset($_POST['token_id']) ? (int)$_POST['token_id'] : null;
    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    $family = $_POST['family'] ?? null;

    $currentUser = current_user();
    
    switch ($action) {
        case 'revoke':
            if ($tokenId) {
                RefreshTokenService::revokeById($tokenId, $currentUser['id']);
                $_SESSION['flash_message'] = 'Token revoked successfully';
                $_SESSION['flash_type'] = 'success';
            }
            break;

        case 'revoke_all_user':
            if ($userId) {
                $count = RefreshTokenService::revokeAllForUser($userId);
                $_SESSION['flash_message'] = "Revoked {$count} token(s) for user";
                $_SESSION['flash_type'] = 'success';
            }
            break;

        case 'revoke_family':
            if ($family) {
                $count = RefreshTokenService::revokeFamily($family, $currentUser['id']);
                $_SESSION['flash_message'] = "Revoked {$count} token(s) in family";
                $_SESSION['flash_type'] = 'success';
            }
            break;
    }

    header('Location: /admin/tokens');
    exit;
}

// Get filters
$filters = [];
if (isset($_GET['user_id']) && $_GET['user_id'] !== '') {
    $filters['user_id'] = (int)$_GET['user_id'];
}
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'active') {
        $filters['revoked'] = false;
        $filters['expired'] = false;
    } elseif ($_GET['status'] === 'revoked') {
        $filters['revoked'] = true;
    } elseif ($_GET['status'] === 'expired') {
        $filters['expired'] = true;
    }
}

// Pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Get tokens
$tokens = RefreshTokenService::getAll($filters, $limit, $offset);
$stats = RefreshTokenService::getStatistics();

include __DIR__ . '/../layout/main.php';
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Token Management</h1>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="mb-6 p-4 rounded-lg <?php echo $_SESSION['flash_type'] === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'; ?>">
            <?php 
            echo htmlspecialchars($_SESSION['flash_message']); 
            unset($_SESSION['flash_message'], $_SESSION['flash_type']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-600 mb-1">Total Tokens</div>
            <div class="text-3xl font-bold text-gray-900"><?php echo $stats['total']; ?></div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-600 mb-1">Active</div>
            <div class="text-3xl font-bold text-green-600"><?php echo $stats['active']; ?></div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-600 mb-1">Revoked</div>
            <div class="text-3xl font-bold text-yellow-600"><?php echo $stats['revoked']; ?></div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-600 mb-1">Expired</div>
            <div class="text-3xl font-bold text-red-600"><?php echo $stats['expired']; ?></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">User ID</label>
                <input type="number" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id'] ?? ''); ?>" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="active" <?php echo ($_GET['status'] ?? '') === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="revoked" <?php echo ($_GET['status'] ?? '') === 'revoked' ? 'selected' : ''; ?>>Revoked</option>
                    <option value="expired" <?php echo ($_GET['status'] ?? '') === 'expired' ? 'selected' : ''; ?>>Expired</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>
                <a href="/admin/tokens" class="ml-2 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Tokens Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Family</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expires</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Used</th  >
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($tokens)): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No tokens found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tokens as $token): ?>
                            <?php
                            $isExpired = strtotime($token['expires_at']) < time();
                            $isRevoked = (bool)$token['revoked'];
                            $isActive = !$isExpired && !$isRevoked;
                            ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo $token['id']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($token['username']); ?></div>
                                    <div class="text-sm text-gray-500"><?php echo htmlspecialchars($token['email']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="font-mono text-xs"><?php echo substr($token['family'], 0, 16); ?>...</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('Y-m-d H:i', strtotime($token['created_at'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('Y-m-d H:i', strtotime($token['expires_at'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $token['last_used_at'] ? date('Y-m-d H:i', strtotime($token['last_used_at'])) : '-'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($isActive): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    <?php elseif ($isRevoked): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Revoked</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Expired</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <?php if ($isActive): ?>
                                        <form method="POST" class="inline" onsubmit="return confirm('Revoke this token?');">
                                            <input type="hidden" name="action" value="revoke">
                                            <input type="hidden" name="token_id" value="<?php echo $token['id']; ?>">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Revoke</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if (!empty($tokens)): ?>
        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-700">
                Showing page <?php echo $page; ?>
            </div>
            <div class="flex gap-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['user_id']) ? '&user_id=' . $_GET['user_id'] : ''; ?>" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Previous
                    </a>
                <?php endif; ?>
                <?php if (count($tokens) === $limit): ?>
                    <a href="?page=<?php echo $page + 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['user_id']) ? '&user_id=' . $_GET['user_id'] : ''; ?>" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Next
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Top Users by Active Tokens -->
    <?php if (!empty($stats['by_user'])): ?>
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Active Tokens by User</h2>
            <div class="space-y-2">
                <?php foreach ($stats['by_user'] as $username => $count): ?>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-700"><?php echo htmlspecialchars($username); ?></span>
                        <span class="text-gray-900 font-semibold"><?php echo $count; ?> token(s)</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
