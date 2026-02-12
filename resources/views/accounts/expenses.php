<?php
/**
 * Expenses Management - Track and manage business expenses
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $expenses: Array of expense records
 * - $stats: Summary statistics
 * - $employees: Array of employees for dropdown
 */

$pageTitle = 'Expenses';
$activeMenu = 'accounts';

$expenses = $expenses ?? [];
$stats = $stats ?? [
    'total_this_month' => 0,
    'pending_approvals' => 0,
    'approved_this_month' => 0,
    'average_expense' => 0
];
$employees = $employees ?? [];

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Expenses</h1>
            <p class="mt-2 text-gray-600">Track and manage business expenses</p>
        </div>
        <button onclick="openAddExpenseModal()" class="mt-4 sm:mt-0 px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add Expense
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">$<?php echo number_format($stats['total_this_month'], 2); ?></p>
                <p class="text-xs text-gray-500 mt-1">This Month</p>
            </div>
            <div class="p-3 bg-red-100 rounded-lg">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Pending Approvals</p>
                <p class="text-2xl font-bold text-yellow-600 mt-2"><?php echo number_format($stats['pending_approvals']); ?></p>
                <p class="text-xs text-gray-500 mt-1">Awaiting Review</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-lg">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Approved</p>
                <p class="text-2xl font-bold text-green-600 mt-2">$<?php echo number_format($stats['approved_this_month'], 2); ?></p>
                <p class="text-xs text-gray-500 mt-1">This Month</p>
            </div>
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Average Expense</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">$<?php echo number_format($stats['average_expense'], 2); ?></p>
                <p class="text-xs text-gray-500 mt-1">Per Transaction</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
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
            <label for="filter_category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select id="filter_category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">All Categories</option>
                <option value="travel">Travel</option>
                <option value="office_supplies">Office Supplies</option>
                <option value="utilities">Utilities</option>
                <option value="meals">Meals & Entertainment</option>
                <option value="software">Software & Subscriptions</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div>
            <label for="filter_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select id="filter_status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="md:col-span-2 lg:col-span-4 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">Apply Filters</button>
            <button type="button" onclick="resetFilters()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Reset</button>
        </div>
    </form>
</div>

<!-- Expenses Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Expense Records</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expense #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Receipt</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($expenses)): ?>
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                        No expenses found. Click "Add Expense" to record a new expense.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($expenses as $expense): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars(date('M d, Y', strtotime($expense['date']))); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-600">
                            #<?php echo htmlspecialchars($expense['expense_number']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $expense['category']))); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars($expense['employee_name']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-gray-900">
                            $<?php echo number_format($expense['amount'], 2); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            <?php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800'
                            ];
                            $statusColor = $statusColors[$expense['status']] ?? 'bg-gray-100 text-gray-800';
                            ?>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo $statusColor; ?>">
                                <?php echo htmlspecialchars(ucfirst($expense['status'])); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            <?php if (!empty($expense['receipt_url'])): ?>
                                <a href="<?php echo htmlspecialchars($expense['receipt_url']); ?>" target="_blank" class="text-blue-600 hover:text-blue-900" title="View Receipt">
                                    <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <?php if ($expense['status'] === 'pending'): ?>
                                    <button onclick="approveExpense(<?php echo htmlspecialchars($expense['id']); ?>)" class="text-green-600 hover:text-green-900" title="Approve">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                    <button onclick="rejectExpense(<?php echo htmlspecialchars($expense['id']); ?>)" class="text-red-600 hover:text-red-900" title="Reject">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                                <button onclick="viewExpense(<?php echo htmlspecialchars($expense['id']); ?>)" class="text-blue-600 hover:text-blue-900" title="View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button onclick="editExpense(<?php echo htmlspecialchars($expense['id']); ?>)" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteExpense(<?php echo htmlspecialchars($expense['id']); ?>)" class="text-red-600 hover:text-red-900" title="Delete">
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

<!-- Add Expense Modal -->
<div id="addExpenseModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Add Expense</h3>
                <button onclick="closeAddExpenseModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <form id="addExpenseForm" class="p-6 space-y-4">
            <div>
                <label for="expense_date" class="block text-sm font-medium text-gray-700 mb-2">Date <span class="text-red-500">*</span></label>
                <input type="date" id="expense_date" name="expense_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">Employee <span class="text-red-500">*</span></label>
                <select id="employee_id" name="employee_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo htmlspecialchars($employee['id']); ?>">
                            <?php echo htmlspecialchars($employee['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                <select id="category" name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Select Category</option>
                    <option value="travel">Travel</option>
                    <option value="office_supplies">Office Supplies</option>
                    <option value="utilities">Utilities</option>
                    <option value="meals">Meals & Entertainment</option>
                    <option value="software">Software & Subscriptions</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-2.5 text-gray-500">$</span>
                    <input type="number" id="amount" name="amount" step="0.01" required class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" required rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
            </div>
            <div>
                <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Receipt</label>
                <input type="file" id="receipt" name="receipt" accept="image/*,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <p class="mt-1 text-xs text-gray-500">Upload receipt (optional)</p>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select id="status" name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeAddExpenseModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">Add Expense</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('expense_date').valueAsDate = new Date();

function openAddExpenseModal() {
    document.getElementById('addExpenseModal').classList.remove('hidden');
}

function closeAddExpenseModal() {
    document.getElementById('addExpenseModal').classList.add('hidden');
    document.getElementById('addExpenseForm').reset();
    document.getElementById('expense_date').valueAsDate = new Date();
}

document.getElementById('addExpenseForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await App.API.post('/accounts/expenses/store', formData);
        
        if (response.success) {
            App.Toast.show('Expense added successfully!', 'success');
            closeAddExpenseModal();
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            App.Toast.show(response.message || 'Failed to add expense', 'error');
        }
    } catch (error) {
        console.error('Error adding expense:', error);
        App.Toast.show('An error occurred while adding the expense', 'error');
    }
});

function resetFilters() {
    document.getElementById('filterForm').reset();
    window.location.href = '/accounts/expenses';
}

function approveExpense(expenseId) {
    App.Confirm.show(
        'Approve Expense',
        'Are you sure you want to approve this expense?',
        async () => {
            try {
                const response = await App.API.post(`/accounts/expenses/approve/${expenseId}`);
                if (response.success) {
                    App.Toast.show('Expense approved', 'success');
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    App.Toast.show(response.message || 'Failed to approve expense', 'error');
                }
            } catch (error) {
                App.Toast.show('An error occurred', 'error');
            }
        }
    );
}

function rejectExpense(expenseId) {
    App.Confirm.show(
        'Reject Expense',
        'Are you sure you want to reject this expense?',
        async () => {
            try {
                const response = await App.API.post(`/accounts/expenses/reject/${expenseId}`);
                if (response.success) {
                    App.Toast.show('Expense rejected', 'success');
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    App.Toast.show(response.message || 'Failed to reject expense', 'error');
                }
            } catch (error) {
                App.Toast.show('An error occurred', 'error');
            }
        }
    );
}

function viewExpense(expenseId) {
    window.location.href = `/accounts/expenses/view/${expenseId}`;
}

function editExpense(expenseId) {
    window.location.href = `/accounts/expenses/edit/${expenseId}`;
}

function deleteExpense(expenseId) {
    App.Confirm.show(
        'Delete Expense',
        'Are you sure you want to delete this expense? This action cannot be undone.',
        async () => {
            try {
                const response = await App.API.delete(`/accounts/expenses/delete/${expenseId}`);
                if (response.success) {
                    App.Toast.show('Expense deleted successfully', 'success');
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    App.Toast.show(response.message || 'Failed to delete expense', 'error');
                }
            } catch (error) {
                App.Toast.show('An error occurred', 'error');
            }
        }
    );
}
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
