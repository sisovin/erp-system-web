<?php
$title = 'Sales Order Details';
$currentPage = 'sales';
ob_start();

// Sample order data (will be populated by controller)
$order = $order ?? [
    'id' => 1,
    'order_number' => 'SO-2026-001',
    'customer_name' => 'Acme Corporation',
    'customer_email' => 'contact@acme.com',
    'customer_phone' => '+1 (555) 123-4567',
    'customer_address' => '123 Business St, New York, NY 10001',
    'order_date' => '2026-02-01',
    'due_date' => '2026-03-01',
    'payment_terms' => 'Net 30',
    'status' => 'confirmed',
    'notes' => 'Please ensure delivery by end of month',
    'items' => [
        ['product_name' => 'Laptop - Dell XPS 15', 'sku' => 'LAP-001', 'quantity' => 5, 'unit_price' => 1299.99, 'discount' => 5, 'tax' => 8],
        ['product_name' => 'Monitor - LG 27" 4K', 'sku' => 'MON-001', 'quantity' => 10, 'unit_price' => 449.99, 'discount' => 0, 'tax' => 8],
    ],
    'subtotal' => 11000.00,
    'total_discount' => 325.00,
    'total_tax' => 854.00,
    'grand_total' => 11529.00
];

$statusColors = [
    'pending' => 'bg-yellow-100 text-yellow-800',
    'confirmed' => 'bg-blue-100 text-blue-800',
    'processing' => 'bg-indigo-100 text-indigo-800',
    'shipped' => 'bg-purple-100 text-purple-800',
    'completed' => 'bg-green-100 text-green-800',
    'cancelled' => 'bg-red-100 text-red-800'
];
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6">
        <div class="mb-4 md:mb-0">
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800"><?= htmlspecialchars($order['order_number']) ?></h1>
                <span class="px-3 py-1 rounded-full text-sm font-medium <?= $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                    <?= ucfirst(htmlspecialchars($order['status'])) ?>
                </span>
            </div>
            <p class="text-gray-600"><?= htmlspecialchars($order['customer_name']) ?></p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="/sales" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
            <a href="/sales/edit/<?= $order['id'] ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <button onclick="generateInvoice()" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Generate Invoice
            </button>
            <button onclick="deleteOrder()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Customer Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Name</p>
                        <p class="font-medium text-gray-900"><?= htmlspecialchars($order['customer_name']) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-medium text-gray-900"><?= htmlspecialchars($order['customer_email']) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Phone</p>
                        <p class="font-medium text-gray-900"><?= htmlspecialchars($order['customer_phone']) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Address</p>
                        <p class="font-medium text-gray-900"><?= htmlspecialchars($order['customer_address']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Order Items</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Discount</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Tax</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($order['items'] as $item): 
                                $itemSubtotal = $item['quantity'] * $item['unit_price'];
                                $itemDiscount = $itemSubtotal * ($item['discount'] / 100);
                                $afterDiscount = $itemSubtotal - $itemDiscount;
                                $itemTax = $afterDiscount * ($item['tax'] / 100);
                                $itemTotal = $afterDiscount + $itemTax;
                            ?>
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900"><?= htmlspecialchars($item['product_name']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-500"><?= htmlspecialchars($item['sku']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-right"><?= number_format($item['quantity']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-right">$<?= number_format($item['unit_price'], 2) ?></td>
                                <td class="px-4 py-3 text-sm text-red-600 text-right"><?= $item['discount'] ?>%</td>
                                <td class="px-4 py-3 text-sm text-gray-900 text-right"><?= $item['tax'] ?>%</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900 text-right">$<?= number_format($itemTotal, 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Order Totals -->
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-end">
                        <div class="w-full md:w-1/2 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium text-gray-900">$<?= number_format($order['subtotal'], 2) ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Discount:</span>
                                <span class="font-medium text-red-600">-$<?= number_format($order['total_discount'], 2) ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Tax:</span>
                                <span class="font-medium text-gray-900">$<?= number_format($order['total_tax'], 2) ?></span>
                            </div>
                            <div class="flex justify-between pt-2 border-t">
                                <span class="text-lg font-semibold text-gray-900">Grand Total:</span>
                                <span class="text-lg font-bold text-indigo-600">$<?= number_format($order['grand_total'], 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <?php if (!empty($order['notes'])): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Notes</h2>
                <p class="text-gray-700"><?= nl2br(htmlspecialchars($order['notes'])) ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Order Summary</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Order Date</p>
                        <p class="font-medium text-gray-900"><?= date('M d, Y', strtotime($order['order_date'])) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Due Date</p>
                        <p class="font-medium text-gray-900"><?= date('M d, Y', strtotime($order['due_date'])) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Payment Terms</p>
                        <p class="font-medium text-gray-900"><?= htmlspecialchars($order['payment_terms']) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Status</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium <?= $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                            <?= ucfirst(htmlspecialchars($order['status'])) ?>
                        </span>
                    </div>
                    <div class="pt-3">
                        <button onclick="showUpdateStatusModal()" 
                            class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors text-sm">
                            Update Status
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Order Timeline</h2>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-2 h-2 mt-2 bg-green-500 rounded-full"></div>
                        <div>
                            <p class="font-medium text-gray-900">Order Confirmed</p>
                            <p class="text-sm text-gray-500">Feb 1, 2026 10:30 AM</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full"></div>
                        <div>
                            <p class="font-medium text-gray-900">Order Created</p>
                            <p class="text-sm text-gray-500">Feb 1, 2026 10:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div id="updateStatusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Update Order Status</h3>
            <button type="button" onclick="closeUpdateStatusModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="updateStatusForm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                <select id="newStatus" name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeUpdateStatusModal()" 
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" 
                    class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showUpdateStatusModal() {
    document.getElementById('updateStatusModal').classList.remove('hidden');
}

function closeUpdateStatusModal() {
    document.getElementById('updateStatusModal').classList.add('hidden');
}

document.getElementById('updateStatusForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const status = document.getElementById('newStatus').value;
    
    try {
        const response = await App.API.post('/sales/update-status/<?= $order['id'] ?>', { status });
        if (response.success) {
            App.Toast.success('Order status updated successfully');
            setTimeout(() => location.reload(), 1000);
        } else {
            App.Toast.error(response.message || 'Failed to update status');
        }
    } catch (error) {
        App.Toast.error('An error occurred. Please try again.');
        console.error('Error:', error);
    }
});

function generateInvoice() {
    App.Toast.info('Generating invoice...');
    setTimeout(() => {
        window.open('/sales/invoice/<?= $order['id'] ?>', '_blank');
    }, 500);
}

function deleteOrder() {
    App.Confirm.show({
        title: 'Delete Order',
        message: 'Are you sure you want to delete this order? This action cannot be undone.',
        confirmText: 'Delete',
        cancelText: 'Cancel',
        onConfirm: async () => {
            try {
                const response = await App.API.delete('/sales/delete/<?= $order['id'] ?>');
                if (response.success) {
                    App.Toast.success('Order deleted successfully');
                    setTimeout(() => {
                        window.location.href = '/sales';
                    }, 1000);
                } else {
                    App.Toast.error(response.message || 'Failed to delete order');
                }
            } catch (error) {
                App.Toast.error('An error occurred. Please try again.');
                console.error('Error:', error);
            }
        }
    });
}
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
