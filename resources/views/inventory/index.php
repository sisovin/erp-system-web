<?php
/**
 * Inventory Module - Products List
 */

$pageTitle = 'Inventory';
$activeMenu = 'inventory';

ob_start();
?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Inventory Management</h1>
        <p class="mt-2 text-gray-600">Manage products, stock levels, and suppliers</p>
    </div>
    <a href="/inventory/create" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Add Product
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Total Products</p>
        <p class="mt-2 text-3xl font-bold text-gray-900"><?php echo count($products ?? []); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Low Stock Items</p>
        <p class="mt-2 text-3xl font-bold text-red-600">
            <?php echo count(array_filter($products ?? [], fn($p) => $p->stock < 10)); ?>
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <p class="text-sm font-medium text-gray-600">Total Value</p>
        <p class="mt-2 text-3xl font-bold text-green-600">
            $<?php echo number_format(array_sum(array_map(fn($p) => ($p->price ?? 0) * ($p->stock ?? 0), $products ?? [])), 2); ?>
        </p>
    </div>
</div>

<!-- Products Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
    <div class="p-6 border-b border-gray-200">
        <input id="table-search" type="text" placeholder="Search products..." class="input w-full max-w-lg">
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($products ?? [] as $product): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <?php echo htmlspecialchars($product->sku ?? 'N/A'); ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product->name ?? ''); ?></div>
                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($product->description ?? '', 0, 50)); ?>...</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        $<?php echo number_format($product->price ?? 0, 2); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo $product->stock ?? 0; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge <?php echo ($product->stock ?? 0) < 10 ? 'badge-danger' : 'badge-success'; ?>">
                            <?php echo ($product->stock ?? 0) < 10 ? 'Low Stock' : 'In Stock'; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="/inventory/<?php echo $product->id; ?>" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="/inventory/<?php echo $product->id; ?>/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
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
