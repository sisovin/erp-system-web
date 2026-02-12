<?php
$title = 'Stock Movements';
$currentPage = 'inventory';
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Stock Movements</h1>
            <p class="text-gray-600">Track inventory changes and adjustments</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <a href="/inventory" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Inventory
            </a>
            <button onclick="App.Modal.open('recordMovementModal')" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Record Movement
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="filter-start-date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                <input type="date" id="filter-start-date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div>
                <label for="filter-end-date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                <input type="date" id="filter-end-date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div>
                <label for="filter-product" class="block text-sm font-medium text-gray-700 mb-2">Product</label>
                <select id="filter-product" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Products</option>
                    <?php foreach ($products ?? [] as $product): ?>
                        <option value="<?php echo htmlspecialchars($product->id ?? ''); ?>">
                            <?php echo htmlspecialchars($product->name ?? ''); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="filter-type" class="block text-sm font-medium text-gray-700 mb-2">Movement Type</label>
                <select id="filter-type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="in">Stock In</option>
                    <option value="out">Stock Out</option>
                    <option value="adjustment">Adjustment</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex gap-3">
            <button onclick="applyFilters()" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                Apply Filters
            </button>
            <button onclick="clearFilters()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors">
                Clear Filters
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total In</p>
                    <p class="mt-2 text-3xl font-bold text-green-600"><?php echo number_format($stats['total_in'] ?? 0); ?></p>
                </div>
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Out</p>
                    <p class="mt-2 text-3xl font-bold text-red-600"><?php echo number_format($stats['total_out'] ?? 0); ?></p>
                </div>
                <div class="p-3 bg-red-100 rounded-lg">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Net Change</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600"><?php echo number_format($stats['net_change'] ?? 0); ?></p>
                </div>
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Value Change</p>
                    <p class="mt-2 text-3xl font-bold text-purple-600">$<?php echo number_format($stats['value_change'] ?? 0, 2); ?></p>
                </div>
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Movements Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="p-6 border-b border-gray-200">
            <input id="table-search" type="text" placeholder="Search movements..." 
                class="w-full max-w-lg px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($movements ?? [] as $movement): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($movement->created_at ?? 'now'))); ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                <?php echo htmlspecialchars($movement->product_name ?? 'N/A'); ?>
                            </div>
                            <div class="text-sm text-gray-500">
                                SKU: <?php echo htmlspecialchars($movement->product_sku ?? 'N/A'); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $typeColors = [
                                'in' => 'bg-green-100 text-green-800',
                                'out' => 'bg-red-100 text-red-800',
                                'adjustment' => 'bg-blue-100 text-blue-800'
                            ];
                            $typeLabels = [
                                'in' => 'Stock In',
                                'out' => 'Stock Out',
                                'adjustment' => 'Adjustment'
                            ];
                            $type = $movement->type ?? 'adjustment';
                            $colorClass = $typeColors[$type] ?? 'bg-gray-100 text-gray-800';
                            $label = $typeLabels[$type] ?? ucfirst($type);
                            ?>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $colorClass; ?>">
                                <?php echo htmlspecialchars($label); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?php
                            $quantity = $movement->quantity ?? 0;
                            $sign = ($movement->type ?? '') === 'out' ? '-' : '+';
                            echo htmlspecialchars($sign . number_format(abs($quantity)));
                            ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo htmlspecialchars(substr($movement->reason ?? '', 0, 50)); ?>
                            <?php if (strlen($movement->reason ?? '') > 50): ?>...<?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo htmlspecialchars($movement->user_name ?? 'System'); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="viewMovement(<?php echo $movement->id ?? 0; ?>)" 
                                class="text-blue-600 hover:text-blue-900 mr-3">
                                View
                            </button>
                            <button onclick="deleteMovement(<?php echo $movement->id ?? 0; ?>)" 
                                class="text-red-600 hover:text-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($movements)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No stock movements found
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Record Movement Modal -->
<div id="recordMovementModal" data-modal class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900">Record Stock Movement</h3>
                <button data-modal-close="recordMovementModal" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <form id="recordMovementForm" class="p-6">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            
            <div class="space-y-6">
                <!-- Product Selection -->
                <div>
                    <label for="movement-product" class="block text-sm font-medium text-gray-700 mb-2">
                        Product <span class="text-red-500">*</span>
                    </label>
                    <select id="movement-product" name="product_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select Product</option>
                        <?php foreach ($products ?? [] as $product): ?>
                            <option value="<?php echo htmlspecialchars($product->id ?? ''); ?>">
                                <?php echo htmlspecialchars($product->name ?? ''); ?> - <?php echo htmlspecialchars($product->sku ?? ''); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message text-red-500 text-sm hidden"></span>
                </div>

                <!-- Movement Type -->
                <div>
                    <label for="movement-type" class="block text-sm font-medium text-gray-700 mb-2">
                        Movement Type <span class="text-red-500">*</span>
                    </label>
                    <select id="movement-type" name="type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="in">Stock In</option>
                        <option value="out">Stock Out</option>
                        <option value="adjustment">Adjustment</option>
                    </select>
                    <span class="error-message text-red-500 text-sm hidden"></span>
                </div>

                <!-- Quantity -->
                <div>
                    <label for="movement-quantity" class="block text-sm font-medium text-gray-700 mb-2">
                        Quantity <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="movement-quantity" name="quantity" required min="1"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <span class="error-message text-red-500 text-sm hidden"></span>
                </div>

                <!-- Date -->
                <div>
                    <label for="movement-date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" id="movement-date" name="movement_date" required
                        value="<?php echo date('Y-m-d\TH:i'); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <span class="error-message text-red-500 text-sm hidden"></span>
                </div>

                <!-- Reason -->
                <div>
                    <label for="movement-reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Reason <span class="text-red-500">*</span>
                    </label>
                    <textarea id="movement-reason" name="reason" required rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Enter reason for stock movement..."></textarea>
                    <span class="error-message text-red-500 text-sm hidden"></span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-6 border-t">
                <button type="submit"
                    class="flex-1 sm:flex-none px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Record Movement
                </button>
                <button type="button" data-modal-close="recordMovementModal"
                    class="flex-1 sm:flex-none px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Initialize App namespace if not exists
if (typeof App === 'undefined') {
    window.App = {
        Modal: window.Modal,
        Toast: window.Toast,
        Confirm: window.Confirm,
        API: window.API
    };
}

// Record Movement Form Handler
document.getElementById('recordMovementForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    try {
        const response = await App.API.post('/inventory/movements/store', data);
        
        if (response.success) {
            App.Toast.success('Stock movement recorded successfully!');
            App.Modal.close('recordMovementModal');
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            App.Toast.error(response.message || 'Failed to record movement');
        }
    } catch (error) {
        App.Toast.error('An error occurred. Please try again.');
        console.error('Error:', error);
    }
});

// View Movement Details
function viewMovement(id) {
    window.location.href = `/inventory/movements/${id}`;
}

// Delete Movement
function deleteMovement(id) {
    App.Confirm.show(
        'Are you sure you want to delete this stock movement? This action cannot be undone.',
        async function() {
            try {
                const response = await App.API.delete(`/inventory/movements/${id}`);
                
                if (response.success) {
                    App.Toast.success('Movement deleted successfully!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    App.Toast.error(response.message || 'Failed to delete movement');
                }
            } catch (error) {
                App.Toast.error('An error occurred. Please try again.');
                console.error('Error:', error);
            }
        }
    );
}

// Apply Filters
function applyFilters() {
    const startDate = document.getElementById('filter-start-date').value;
    const endDate = document.getElementById('filter-end-date').value;
    const product = document.getElementById('filter-product').value;
    const type = document.getElementById('filter-type').value;
    
    const params = new URLSearchParams();
    if (startDate) params.append('start_date', startDate);
    if (endDate) params.append('end_date', endDate);
    if (product) params.append('product', product);
    if (type) params.append('type', type);
    
    window.location.href = `/inventory/movements${params.toString() ? '?' + params.toString() : ''}`;
}

// Clear Filters
function clearFilters() {
    document.getElementById('filter-start-date').value = '';
    document.getElementById('filter-end-date').value = '';
    document.getElementById('filter-product').value = '';
    document.getElementById('filter-type').value = '';
    window.location.href = '/inventory/movements';
}
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
