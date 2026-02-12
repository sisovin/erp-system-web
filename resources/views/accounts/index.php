<?php
/**
 * Accounts Module - Chart of Accounts
 */

$pageTitle = 'Accounts';
$activeMenu = 'accounts';

ob_start();
?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Accounting</h1>
        <p class="mt-2 text-gray-600">Manage chart of accounts, ledger entries, and expenses</p>
    </div>
    <a href="/accounts/create" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Add Account
    </a>
</div>

<!-- Quick Links -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <a href="/accounts" class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-semibold">Chart of Accounts</h3>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
        </div>
        <p class="text-blue-100 text-sm">View all accounts</p>
    </a>

    <a href="/accounts/ledger" class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-semibold">General Ledger</h3>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <p class="text-green-100 text-sm">View ledger entries</p>
    </a>

    <a href="/accounts/expenses" class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-semibold">Expenses</h3>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <p class="text-red-100 text-sm">Track expenses</p>
    </a>

    <a href="/accounts/reports" class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-semibold">Reports</h3>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <p class="text-purple-100 text-sm">Financial reports</p>
    </a>
</div>

<!-- Accounts Table -->
<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <div class="p-6 border-b">
        <h2 class="text-xl font-bold text-gray-900">Chart of Accounts</h2>
        <p class="text-sm text-gray-600 mt-1">All accounting accounts organized by type</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Account Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($accounts ?? [] as $account): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <?php echo htmlspecialchars($account->code ?? ''); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo htmlspecialchars($account->name ?? ''); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge badge-info">
                            <?php echo ucfirst($account->type ?? 'N/A'); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="/accounts/<?php echo $account->id; ?>" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="/accounts/<?php echo $account->id; ?>/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
