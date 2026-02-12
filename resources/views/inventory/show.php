<?php
$title = 'Product Details';
$currentPage = 'inventory';
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($product['name'] ?? 'Product') ?></h1>
            <p class="text-gray-600">SKU: <?= htmlspecialchars($product['sku'] ?? 'N/A') ?></p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
            <a href="/inventory/<?= $product['id'] ?? '' ?>/edit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <button onclick="deleteProduct(<?= $product['id'] ?? 0 ?>)" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
            <a href="/inventory" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Product Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Product Name</label>
                        <p class="text-gray-800"><?= htmlspecialchars($product['name'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">SKU</label>
                        <p class="text-gray-800 font-mono"><?= htmlspecialchars($product['sku'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Category</label>
                        <p class="text-gray-800"><?= htmlspecialchars($product['category'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Brand</label>
                        <p class="text-gray-800"><?= htmlspecialchars($product['brand'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Barcode</label>
                        <p class="text-gray-800 font-mono"><?= htmlspecialchars($product['barcode'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Unit</label>
                        <p class="text-gray-800 uppercase"><?= htmlspecialchars($product['unit'] ?? 'PCS') ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-500">Description</label>
                        <p class="text-gray-800"><?= htmlspecialchars($product['description'] ?? 'No description available') ?></p>
                    </div>
                </div>
            </div>

            <!-- Pricing Information Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pricing & Profitability
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Unit Price</label>
                        <p class="text-2xl font-bold text-green-600">$<?= number_format($product['unit_price'] ?? 0, 2) ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Cost Price</label>
                        <p class="text-2xl font-bold text-orange-600">$<?= number_format($product['cost_price'] ?? 0, 2) ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Profit Margin</label>
                        <?php
                        $unitPrice = $product['unit_price'] ?? 0;
                        $costPrice = $product['cost_price'] ?? 0;
                        $margin = $unitPrice > 0 ? (($unitPrice - $costPrice) / $unitPrice) * 100 : 0;
                        ?>
                        <p class="text-2xl font-bold text-indigo-600"><?= number_format($margin, 1) ?>%</p>
                    </div>
                </div>
            </div>

            <!-- Stock Movements Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Recent Stock Movements
                    </h2>
                    <a href="/inventory/movements?product_id=<?= $product['id'] ?? '' ?>" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        View All →
                    </a>
                </div>
                <div class="space-y-3">
                    <?php foreach ($movements ?? [] as $movement): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <?php if ($movement['type'] === 'in'): ?>
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>
                                <?php else: ?>
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <p class="text-sm font-medium text-gray-900"><?= ucfirst($movement['type']) ?> - <?= htmlspecialchars($movement['reason'] ?? 'Stock adjustment') ?></p>
                                    <p class="text-xs text-gray-500"><?= date('M d, Y h:i A', strtotime($movement['created_at'])) ?></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold <?= $movement['type'] === 'in' ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= $movement['type'] === 'in' ? '+' : '-' ?><?= $movement['quantity'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($movements)): ?>
                        <p class="text-gray-500 text-center py-4">No stock movements recorded</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Stock Status Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Stock Status</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Current Stock</label>
                        <p class="text-3xl font-bold text-gray-800"><?= number_format($product['stock_quantity'] ?? 0) ?></p>
                        <p class="text-xs text-gray-500"><?= strtoupper($product['unit'] ?? 'PCS') ?></p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Reorder Level</label>
                        <p class="text-lg font-semibold text-gray-800"><?= number_format($product['reorder_level'] ?? 0) ?></p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Stock Value</label>
                        <p class="text-lg font-semibold text-green-600">
                            $<?= number_format(($product['stock_quantity'] ?? 0) * ($product['unit_price'] ?? 0), 2) ?>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Status</label>
                        <p>
                            <?php
                            $status = $product['status'] ?? 'active';
                            $stock = $product['stock_quantity'] ?? 0;
                            $reorder = $product['reorder_level'] ?? 0;
                            
                            if ($status === 'inactive') {
                                $badge = 'bg-gray-100 text-gray-800';
                                $text = 'Inactive';
                            } elseif ($status === 'discontinued') {
                                $badge = 'bg-red-100 text-red-800';
                                $text = 'Discontinued';
                            } elseif ($stock <= 0) {
                                $badge = 'bg-red-100 text-red-800';
                                $text = 'Out of Stock';
                            } elseif ($stock <= $reorder) {
                                $badge = 'bg-yellow-100 text-yellow-800';
                                $text = 'Low Stock';
                            } else {
                                $badge = 'bg-green-100 text-green-800';
                                $text = 'In Stock';
                            }
                            ?>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?= $badge ?>">
                                <?= $text ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <button onclick="adjustStock('in')" class="flex items-center w-full px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Stock
                    </button>
                    <button onclick="adjustStock('out')" class="flex items-center w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                        Remove Stock
                    </button>
                </div>
            </div>

            <!-- Product Meta Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Product Meta</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-500">Created At</label>
                        <p class="text-gray-800"><?= isset($product['created_at']) ? date('M d, Y', strtotime($product['created_at'])) : 'N/A' ?></p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Last Updated</label>
                        <p class="text-gray-800"><?= isset($product['updated_at']) ? date('M d, Y', strtotime($product['updated_at'])) : 'N/A' ?></p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Supplier</label>
                        <p class="text-gray-800"><?= htmlspecialchars($product['supplier_name'] ?? 'Not assigned') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function deleteProduct(id) {
    const confirmed = await App.Confirm.show(
        'Are you sure you want to delete this product?',
        'This action cannot be undone.'
    );
    
    if (confirmed) {
        try {
            const response = await App.API.delete('/inventory/' + id);
            
            if (response.success) {
                App.Toast.success('Product deleted successfully!');
                setTimeout(() => {
                    window.location.href = '/inventory';
                }, 1500);
            } else {
                App.Toast.error(response.message || 'Failed to delete product');
            }
        } catch (error) {
            App.Toast.error('An error occurred. Please try again.');
            console.error('Error:', error);
        }
    }
}

function adjustStock(type) {
    const productId = <?= $product['id'] ?? 0 ?>;
    window.location.href = `/inventory/movements?product_id=${productId}&type=${type}`;
}
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
