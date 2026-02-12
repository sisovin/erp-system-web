<?php
$title = 'Edit Product';
$currentPage = 'inventory';
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Edit Product</h1>
            <p class="text-gray-600">Update product information</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-2">
            <a href="/inventory/<?= $product['id'] ?? '' ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View
            </a>
            <a href="/inventory" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-md">
        <form id="productForm" method="POST" action="/inventory/<?= $product['id'] ?? '' ?>/update" class="p-6">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            <input type="hidden" name="_method" value="PUT">
            
            <!-- Basic Information Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                            SKU <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="sku" name="sku" required
                            value="<?= htmlspecialchars($product['sku'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            value="<?= htmlspecialchars($product['name'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select Category</option>
                            <option value="Electronics" <?= ($product['category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                            <option value="Furniture" <?= ($product['category'] ?? '') === 'Furniture' ? 'selected' : '' ?>>Furniture</option>
                            <option value="Office Supplies" <?= ($product['category'] ?? '') === 'Office Supplies' ? 'selected' : '' ?>>Office Supplies</option>
                            <option value="Raw Materials" <?= ($product['category'] ?? '') === 'Raw Materials' ? 'selected' : '' ?>>Raw Materials</option>
                            <option value="Finished Goods" <?= ($product['category'] ?? '') === 'Finished Goods' ? 'selected' : '' ?>>Finished Goods</option>
                            <option value="Services" <?= ($product['category'] ?? '') === 'Services' ? 'selected' : '' ?>>Services</option>
                        </select>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">
                            Brand
                        </label>
                        <input type="text" id="brand" name="brand"
                            value="<?= htmlspecialchars($product['brand'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Pricing & Stock</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Unit Price -->
                    <div>
                        <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Unit Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">$</span>
                            <input type="number" id="unit_price" name="unit_price" required step="0.01" min="0"
                                value="<?= htmlspecialchars($product['unit_price'] ?? '') ?>"
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Cost Price -->
                    <div>
                        <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Cost Price
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">$</span>
                            <input type="number" id="cost_price" name="cost_price" step="0.01" min="0"
                                value="<?= htmlspecialchars($product['cost_price'] ?? '') ?>"
                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">
                            Stock Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock_quantity" name="stock_quantity" required min="0"
                            value="<?= htmlspecialchars($product['stock_quantity'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Reorder Level -->
                    <div>
                        <label for="reorder_level" class="block text-sm font-medium text-gray-700 mb-2">
                            Reorder Level
                        </label>
                        <input type="number" id="reorder_level" name="reorder_level" min="0"
                            value="<?= htmlspecialchars($product['reorder_level'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Alert when stock falls below this level</p>
                    </div>

                    <!-- Unit of Measure -->
                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Unit of Measure
                        </label>
                        <select id="unit" name="unit"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="pcs" <?= ($product['unit'] ?? '') === 'pcs' ? 'selected' : '' ?>>Pieces</option>
                            <option value="box" <?= ($product['unit'] ?? '') === 'box' ? 'selected' : '' ?>>Box</option>
                            <option value="kg" <?= ($product['unit'] ?? '') === 'kg' ? 'selected' : '' ?>>Kilograms</option>
                            <option value="lbs" <?= ($product['unit'] ?? '') === 'lbs' ? 'selected' : '' ?>>Pounds</option>
                            <option value="ltr" <?= ($product['unit'] ?? '') === 'ltr' ? 'selected' : '' ?>>Liters</option>
                            <option value="gal" <?= ($product['unit'] ?? '') === 'gal' ? 'selected' : '' ?>>Gallons</option>
                            <option value="set" <?= ($product['unit'] ?? '') === 'set' ? 'selected' : '' ?>>Set</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="active" <?= ($product['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= ($product['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            <option value="discontinued" <?= ($product['status'] ?? '') === 'discontinued' ? 'selected' : '' ?>>Discontinued</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Supplier Information Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Supplier Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Supplier -->
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Supplier
                        </label>
                        <select id="supplier_id" name="supplier_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select Supplier</option>
                            <?php foreach ($suppliers ?? [] as $supplier): ?>
                                <option value="<?= $supplier['id'] ?>" <?= ($product['supplier_id'] ?? '') == $supplier['id'] ? 'selected' : '' ?>><?= htmlspecialchars($supplier['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Barcode -->
                    <div>
                        <label for="barcode" class="block text-sm font-medium text-gray-700 mb-2">
                            Barcode
                        </label>
                        <input type="text" id="barcode" name="barcode"
                            value="<?= htmlspecialchars($product['barcode'] ?? '') ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Form Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t">
                <button type="submit"
                    class="flex-1 sm:flex-none px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:ring-4 focus:ring-indigo-300">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Product
                </button>
                <a href="/inventory/<?= $product['id'] ?? '' ?>"
                    class="flex-1 sm:flex-none text-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('productForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    try {
        const response = await App.API.put('/inventory/<?= $product['id'] ?? '' ?>/update', data);
        
        if (response.success) {
            App.Toast.success('Product updated successfully!');
            setTimeout(() => {
                window.location.href = '/inventory/<?= $product['id'] ?? '' ?>';
            }, 1500);
        } else {
            App.Toast.error(response.message || 'Failed to update product');
        }
    } catch (error) {
        App.Toast.error('An error occurred. Please try again.');
        console.error('Error:', error);
    }
});
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
