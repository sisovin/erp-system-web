<?php
/**
 * Sales Module - Orders List
 */

$pageTitle = 'Sales';
$activeMenu = 'sales';

ob_start();
?>

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Sales Management</h1>
        <p class="mt-2 text-gray-600">Manage sales orders, customers, and invoices</p>
    </div>
    <a href="/sales/create" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        New Order
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-600">Total Orders</p>
        <p class "mt-2 text-2xl font-bold"><?php echo count($orders ?? []); ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-600">Pending</p>
        <p class="mt-2 text-2xl font-bold text-yellow-600">
            <?php echo count(array_filter($orders ?? [], fn($o) => $o->status === 'pending')); ?>
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-600">Completed</p>
        <p class="mt-2 text-2xl font-bold text-green-600">
            <?php echo count(array_filter($orders ?? [], fn($o) => $o->status === 'completed')); ?>
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-600">Total Revenue</p>
        <p class="mt-2 text-2xl font-bold text-blue-600">
            $<?php echo number_format(array_sum(array_column($orders ?? [], 'total')), 2); ?>
        </p>
    </div>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <div class="p-6 border-b">
        <input id="table-search" type="text" placeholder="Search orders..." class="input w-full max-w-lg">
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($orders ?? [] as $order): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">#<?php echo $order->id; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo htmlspecialchars($order->customer_name ?? 'N/A'); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">$<?php echo number_format($order->total ?? 0, 2); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge <?php echo $order->status === 'completed' ? 'badge-success' : ($order->status === 'pending' ? 'badge-warning' : 'badge-info'); ?>">
                            <?php echo ucfirst($order->status ?? 'unknown'); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo date('M d, Y', strtotime($order->created_at ?? 'now')); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="/sales/<?php echo $order->id; ?>" class="text-blue-600 hover:text-blue-900">View</a>
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
