<?php
/**
 * General Ledger - View and manage all ledger entries
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $entries: Array of ledger entries (optional)
 * - $accounts: Array of accounts for filter dropdown
 * - $stats: Summary statistics
 */

$pageTitle = 'General Ledger';
$activeMenu = 'accounts';

$entries = $entries ?? [];
$accounts = $accounts ?? [];
$stats = $stats ?? [
    'total_debits' => 0,
    'total_credits' => 0,
    'balance' => 0,
    'entries_count' => 0
];

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">General Ledger</h1>
            <p class="mt-2 text-gray-600">View and manage all accounting entries</p>
        </div>
        <button onclick="openPostEntryModal()" class="mt-4 sm:mt-0 px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Post Entry
        </button>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h2 class="text-lg font-bold text-gray-900 mb-4">Filters</h2>
    <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label for="filter_date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
            <input type="date" id="filter_date_from" name="date_from" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label for="filter_date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
            <input type="date" id="filter_date_to" name="date_to" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <div>
            <label for="filter_account" class="block text-sm font-medium text-gray-700 mb-2">Account</label>
            <select id="filter_account" name="account_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">All Accounts</option>
                <?php foreach ($accounts as $account): ?>
                    <option value="<?php echo htmlspecialchars($account['id']); ?>">
                        <?php echo htmlspecialchars($account['code'] . ' - ' . $account['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="filter_entry_type" class="block text-sm font-medium text-gray-700 mb-2">Entry Type</label>
            <select id="filter_entry_type" name="entry_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">All Types</option>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
            </select>
        </div>
        <div class="md:col-span-2 lg:col-span-4 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">
                Apply Filters
            </button>
            <button type="button" onclick="resetFilters()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                Reset
            </button>
        </div>
    </form>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Total Debits</p>
        <p class="text-2xl font-bold text-red-600 mt-2">$<?php echo number_format($stats['total_debits'], 2); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Total Credits</p>
        <p class="text-2xl font-bold text-green-600 mt-2">$<?php echo number_format($stats['total_credits'], 2); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Balance</p>
        <p class="text-2xl font-bold text-gray-900 mt-2">$<?php echo number_format(abs($stats['balance']), 2); ?></p>
        <p class="text-xs text-gray-500 mt-1"><?php echo $stats['balance'] >= 0 ? 'Debit' : 'Credit'; ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Total Entries</p>
        <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo number_format($stats['entries_count']); ?></p>
    </div>
</div>

<!-- Ledger Entries Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Ledger Entries</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full" id="ledgerTable">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entry #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debit</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Credit</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="ledgerTableBody">
                <?php if (empty($entries)): ?>
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                        No ledger entries found. Use the filters above or post a new entry.
                    </td>
                </tr>
                <?php else: ?>
                    <?php 
                    $runningBalance = 0;
                    foreach ($entries as $entry): 
                        $runningBalance += ($entry['debit'] ?? 0) - ($entry['credit'] ?? 0);
                    ?>
                    <tr class="hover:bg-gray-50" data-entry-id="<?php echo htmlspecialchars($entry['id']); ?>">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars(date('M d, Y', strtotime($entry['date']))); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-600">
                            #<?php echo htmlspecialchars($entry['entry_number']); ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?php echo htmlspecialchars($entry['account_code'] . ' - ' . $entry['account_name']); ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?php echo htmlspecialchars($entry['description']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600 font-semibold">
                            <?php echo ($entry['debit'] ?? 0) > 0 ? '$' . number_format($entry['debit'], 2) : '-'; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-green-600 font-semibold">
                            <?php echo ($entry['credit'] ?? 0) > 0 ? '$' . number_format($entry['credit'], 2) : '-'; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-gray-900">
                            $<?php echo number_format(abs($runningBalance), 2); ?>
                            <span class="text-xs text-gray-500"><?php echo $runningBalance >= 0 ? 'DR' : 'CR'; ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="viewEntry(<?php echo htmlspecialchars($entry['id']); ?>)" class="text-blue-600 hover:text-blue-900" title="View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button onclick="editEntry(<?php echo htmlspecialchars($entry['id']); ?>)" class="text-green-600 hover:text-green-900" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteEntry(<?php echo htmlspecialchars($entry['id']); ?>)" class="text-red-600 hover:text-red-900" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Post Entry Modal -->
<div id="postEntryModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Post Ledger Entry</h3>
                <button onclick="closePostEntryModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <form id="postEntryForm" class="p-6 space-y-4">
            <div>
                <label for="entry_date" class="block text-sm font-medium text-gray-700 mb-2">Entry Date <span class="text-red-500">*</span></label>
                <input type="date" id="entry_date" name="entry_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div>
                <label for="entry_account" class="block text-sm font-medium text-gray-700 mb-2">Account <span class="text-red-500">*</span></label>
                <select id="entry_account" name="account_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Select Account</option>
                    <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo htmlspecialchars($account['id']); ?>">
                            <?php echo htmlspecialchars($account['code'] . ' - ' . $account['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="entry_description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea id="entry_description" name="description" required rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
            </div>
            <div>
                <label for="entry_amount" class="block text-sm font-medium text-gray-700 mb-2">Amount <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-2.5 text-gray-500">$</span>
                    <input type="number" id="entry_amount" name="amount" step="0.01" required class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Entry Type <span class="text-red-500">*</span></label>
                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="entry_type" value="debit" checked class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2 text-sm text-gray-700">Debit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="entry_type" value="credit" class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2 text-sm text-gray-700">Credit</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="entry_reference" class="block text-sm font-medium text-gray-700 mb-2">Reference #</label>
                <input type="text" id="entry_reference" name="reference_number" placeholder="Optional reference number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closePostEntryModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">Post Entry</button>
            </div>
        </form>
    </div>
</div>

<script>
// Set today's date as default
document.getElementById('entry_date').valueAsDate = new Date();

function openPostEntryModal() {
    document.getElementById('postEntryModal').classList.remove('hidden');
}

function closePostEntryModal() {
    document.getElementById('postEntryModal').classList.add('hidden');
    document.getElementById('postEntryForm').reset();
    document.getElementById('entry_date').valueAsDate = new Date();
}

document.getElementById('postEntryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {
        entry_date: formData.get('entry_date'),
        account_id: formData.get('account_id'),
        description: formData.get('description'),
        amount: parseFloat(formData.get('amount')),
        entry_type: formData.get('entry_type'),
        reference_number: formData.get('reference_number') || null
    };
    
    try {
        const response = await App.API.post('/accounts/ledger/store', data);
        
        if (response.success) {
            App.Toast.show('Ledger entry posted successfully!', 'success');
            closePostEntryModal();
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            App.Toast.show(response.message || 'Failed to post entry', 'error');
        }
    } catch (error) {
        console.error('Error posting entry:', error);
        App.Toast.show('An error occurred while posting the entry', 'error');
    }
});

function resetFilters() {
    document.getElementById('filterForm').reset();
    window.location.href = '/accounts/ledger';
}

function viewEntry(entryId) {
    window.location.href = `/accounts/ledger/view/${entryId}`;
}

function editEntry(entryId) {
    window.location.href = `/accounts/ledger/edit/${entryId}`;
}

function deleteEntry(entryId) {
    App.Confirm.show(
        'Delete Entry',
        'Are you sure you want to delete this ledger entry? This action cannot be undone.',
        async () => {
            try {
                const response = await App.API.delete(`/accounts/ledger/delete/${entryId}`);
                if (response.success) {
                    App.Toast.show('Entry deleted successfully', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    App.Toast.show(response.message || 'Failed to delete entry', 'error');
                }
            } catch (error) {
                console.error('Error deleting entry:', error);
                App.Toast.show('An error occurred while deleting the entry', 'error');
            }
        }
    );
}

// Calculate running balance dynamically
function recalculateBalance() {
    const rows = document.querySelectorAll('#ledgerTableBody tr[data-entry-id]');
    let runningBalance = 0;
    
    rows.forEach(row => {
        const debitCell = row.cells[4].textContent.trim();
        const creditCell = row.cells[5].textContent.trim();
        
        const debit = debitCell !== '-' ? parseFloat(debitCell.replace('$', '').replace(',', '')) : 0;
        const credit = creditCell !== '-' ? parseFloat(creditCell.replace('$', '').replace(',', '')) : 0;
        
        runningBalance += debit - credit;
        
        const balanceCell = row.cells[6];
        balanceCell.innerHTML = `$${Math.abs(runningBalance).toFixed(2)} <span class="text-xs text-gray-500">${runningBalance >= 0 ? 'DR' : 'CR'}</span>`;
    });
}
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
