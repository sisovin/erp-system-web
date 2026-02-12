<?php
/**
 * Account Details - Display detailed account information and recent ledger entries
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $account: Account object with details
 * - $recentEntries: Array of recent ledger entries
 * - $summary: Account summary with balances
 */

$pageTitle = 'Account Details';
$activeMenu = 'accounts';

$account = $account ?? [
    'id' => 0,
    'code' => '1000',
    'name' => 'Cash',
    'type' => 'asset',
    'parent_name' => null,
    'description' => '',
    'is_active' => 1
];

$recentEntries = $recentEntries ?? [];

$summary = $summary ?? [
    'current_balance' => 0,
    'balance_type' => 'debit',
    'total_debits' => 0,
    'total_credits' => 0,
    'opening_balance' => 0
];

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-3">
                <a href="/accounts" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        <?php echo htmlspecialchars($account['code']); ?> - <?php echo htmlspecialchars($account['name']); ?>
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <?php echo htmlspecialchars(ucfirst($account['type'])); ?>
                        </span>
                        <?php if ($account['is_active']): ?>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        <?php else: ?>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="/accounts/edit/<?php echo htmlspecialchars($account['id']); ?>" 
               class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <button onclick="deleteAccount(<?php echo htmlspecialchars($account['id']); ?>)"
               class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
        </div>
    </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Account Information Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Account Information</h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Account Code</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-semibold"><?php echo htmlspecialchars($account['code']); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Account Name</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($account['name']); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Account Type</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars(ucfirst($account['type'])); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Parent Account</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo $account['parent_name'] ? htmlspecialchars($account['parent_name']) : 'None'; ?></dd>
                </div>
                <?php if (!empty($account['description'])): ?>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($account['description']); ?></dd>
                </div>
                <?php endif; ?>
            </dl>
        </div>

        <!-- Recent Ledger Entries -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Recent Ledger Entries</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entry #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debit</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Credit</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($recentEntries)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                No ledger entries found for this account
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php 
                            $runningBalance = $summary['opening_balance'];
                            foreach ($recentEntries as $entry): 
                                $runningBalance += ($entry['debit'] ?? 0) - ($entry['credit'] ?? 0);
                            ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars(date('M d, Y', strtotime($entry['date']))); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-600">
                                    #<?php echo htmlspecialchars($entry['entry_number']); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <?php echo htmlspecialchars($entry['description']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">
                                    <?php echo ($entry['debit'] ?? 0) > 0 ? '$' . number_format($entry['debit'], 2) : '-'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-green-600">
                                    <?php echo ($entry['credit'] ?? 0) > 0 ? '$' . number_format($entry['credit'], 2) : '-'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-gray-900">
                                    $<?php echo number_format(abs($runningBalance), 2); ?>
                                    <span class="text-xs text-gray-500"><?php echo $runningBalance >= 0 ? 'DR' : 'CR'; ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($recentEntries)): ?>
            <div class="p-4 border-t border-gray-200 text-center">
                <a href="/accounts/ledger?account_id=<?php echo htmlspecialchars($account['id']); ?>" 
                   class="text-sm font-medium text-primary-600 hover:text-primary-700">
                    View All Entries →
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Account Summary Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Account Summary</h3>
            <div class="space-y-4">
                <div class="p-4 bg-gradient-to-br from-primary-50 to-blue-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-600">Current Balance</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        $<?php echo number_format(abs($summary['current_balance']), 2); ?>
                    </p>
                    <p class="text-xs text-gray-600 mt-1">
                        <?php echo $summary['current_balance'] >= 0 ? 'Debit Balance' : 'Credit Balance'; ?>
                    </p>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Debits</span>
                        <span class="text-sm font-semibold text-red-600">$<?php echo number_format($summary['total_debits'], 2); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Credits</span>
                        <span class="text-sm font-semibold text-green-600">$<?php echo number_format($summary['total_credits'], 2); ?></span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                        <span class="text-sm text-gray-600">Opening Balance</span>
                        <span class="text-sm font-semibold text-gray-900">$<?php echo number_format(abs($summary['opening_balance']), 2); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button onclick="postEntry()" class="w-full px-4 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Post Entry
                </button>
                <a href="/accounts/ledger?account_id=<?php echo htmlspecialchars($account['id']); ?>" 
                   class="w-full px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    View Ledger
                </a>
                <button onclick="exportAccount()" class="w-full px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Export
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function deleteAccount(accountId) {
    App.Confirm.show(
        'Delete Account',
        'Are you sure you want to delete this account? This action cannot be undone.',
        async () => {
            try {
                const response = await App.API.delete(`/accounts/delete/${accountId}`);
                if (response.success) {
                    App.Toast.show('Account deleted successfully', 'success');
                    setTimeout(() => {
                        window.location.href = '/accounts';
                    }, 1500);
                } else {
                    App.Toast.show(response.message || 'Failed to delete account', 'error');
                }
            } catch (error) {
                console.error('Error deleting account:', error);
                App.Toast.show('An error occurred while deleting the account', 'error');
            }
        }
    );
}

function postEntry() {
    window.location.href = '/accounts/ledger?account_id=<?php echo htmlspecialchars($account['id']); ?>&action=post';
}

function exportAccount() {
    window.location.href = '/accounts/export/<?php echo htmlspecialchars($account['id']); ?>';
}
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
