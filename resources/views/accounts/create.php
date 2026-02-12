<?php
/**
 * Create Account - Form to create a new chart of accounts entry
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $parentAccounts: Array of parent accounts for hierarchy (optional)
 */

$pageTitle = 'Create Account';
$activeMenu = 'accounts';

$parentAccounts = $parentAccounts ?? [];

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center space-x-3">
                <a href="/accounts" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Create Account</h1>
            </div>
            <p class="mt-2 text-gray-600">Add a new account to your chart of accounts</p>
        </div>
    </div>
</div>

<!-- Create Account Form -->
<form id="createAccountForm" class="space-y-6">
    <!-- Basic Information Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Basic Information
        </h2>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Account Code -->
            <div>
                <label for="account_code" class="block text-sm font-medium text-gray-700 mb-2">
                    Account Code <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="account_code" 
                    name="account_code" 
                    required
                    placeholder="e.g., 1000, 1100, 2000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
                <p class="mt-1 text-xs text-gray-500">Unique numeric code for the account</p>
            </div>

            <!-- Account Name -->
            <div>
                <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Account Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="account_name" 
                    name="account_name" 
                    required
                    placeholder="e.g., Cash, Accounts Receivable"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
            </div>

            <!-- Account Type -->
            <div>
                <label for="account_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Account Type <span class="text-red-500">*</span>
                </label>
                <select 
                    id="account_type" 
                    name="account_type" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
                    <option value="">Select Account Type</option>
                    <option value="asset">Asset</option>
                    <option value="liability">Liability</option>
                    <option value="equity">Equity</option>
                    <option value="revenue">Revenue</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <!-- Parent Account -->
            <div>
                <label for="parent_account_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Parent Account
                </label>
                <select 
                    id="parent_account_id" 
                    name="parent_account_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
                    <option value="">None (Top Level)</option>
                    <?php foreach ($parentAccounts as $account): ?>
                        <option value="<?php echo htmlspecialchars($account['id']); ?>">
                            <?php echo htmlspecialchars($account['code'] . ' - ' . $account['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="mt-1 text-xs text-gray-500">Optional: Select parent for hierarchy</p>
            </div>
        </div>
    </div>

    <!-- Account Details Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Account Details
        </h2>
        
        <div class="space-y-6">
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3"
                    placeholder="Brief description of this account's purpose"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                ></textarea>
            </div>

            <!-- Opening Balance -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="opening_balance" class="block text-sm font-medium text-gray-700 mb-2">
                        Opening Balance
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-gray-500">$</span>
                        <input 
                            type="number" 
                            id="opening_balance" 
                            name="opening_balance" 
                            step="0.01"
                            value="0.00"
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Balance Type
                    </label>
                    <div class="flex items-center space-x-6 mt-2">
                        <label class="flex items-center">
                            <input 
                                type="radio" 
                                name="balance_type" 
                                value="debit" 
                                checked
                                class="w-4 h-4 text-primary-600 focus:ring-primary-500"
                            >
                            <span class="ml-2 text-sm text-gray-700">Debit</span>
                        </label>
                        <label class="flex items-center">
                            <input 
                                type="radio" 
                                name="balance_type" 
                                value="credit"
                                class="w-4 h-4 text-primary-600 focus:ring-primary-500"
                            >
                            <span class="ml-2 text-sm text-gray-700">Credit</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="is_active" 
                    name="is_active" 
                    checked
                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                >
                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                    Active Account
                </label>
                <p class="ml-2 text-xs text-gray-500">(Inactive accounts won't appear in transactions)</p>
            </div>
        </div>
    </div>

    <!-- Tax Settings Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Tax Settings
        </h2>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Tax Category -->
            <div>
                <label for="tax_category" class="block text-sm font-medium text-gray-700 mb-2">
                    Tax Category
                </label>
                <select 
                    id="tax_category" 
                    name="tax_category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
                    <option value="">None</option>
                    <option value="standard">Standard Rate</option>
                    <option value="reduced">Reduced Rate</option>
                    <option value="zero">Zero Rated</option>
                    <option value="exempt">Exempt</option>
                </select>
            </div>

            <!-- Default Tax Rate -->
            <div>
                <label for="default_tax_rate" class="block text-sm font-medium text-gray-700 mb-2">
                    Default Tax Rate (%)
                </label>
                <input 
                    type="number" 
                    id="default_tax_rate" 
                    name="default_tax_rate" 
                    step="0.01"
                    min="0"
                    max="100"
                    value="0.00"
                    placeholder="0.00"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex flex-col sm:flex-row gap-4 justify-end">
        <a 
            href="/accounts" 
            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-center font-medium"
        >
            Cancel
        </a>
        <button 
            type="submit" 
            class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium flex items-center justify-center"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Create Account
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createAccountForm');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const data = {
            account_code: formData.get('account_code'),
            account_name: formData.get('account_name'),
            account_type: formData.get('account_type'),
            parent_account_id: formData.get('parent_account_id') || null,
            description: formData.get('description') || '',
            opening_balance: parseFloat(formData.get('opening_balance')) || 0,
            balance_type: formData.get('balance_type'),
            is_active: formData.get('is_active') ? 1 : 0,
            tax_category: formData.get('tax_category') || null,
            default_tax_rate: parseFloat(formData.get('default_tax_rate')) || 0
        };
        
        try {
            const response = await App.API.post('/accounts/store', data);
            
            if (response.success) {
                App.Toast.show('Account created successfully!', 'success');
                setTimeout(() => {
                    window.location.href = '/accounts';
                }, 1500);
            } else {
                App.Toast.show(response.message || 'Failed to create account', 'error');
            }
        } catch (error) {
            console.error('Error creating account:', error);
            App.Toast.show('An error occurred while creating the account', 'error');
        }
    });
});
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
