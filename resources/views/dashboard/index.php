<?php
/**
 * Dashboard - Main metrics and overview page
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $metrics: Array of dashboard metrics (employees, products, customers, sales, etc.)
 */

$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';

// Sample metrics structure (will be populated by controller)
$metrics = $metrics ?? [
    'employees' => ['total' => 0, 'active' => 0],
    'products' => ['total' => 0, 'low_stock' => 0],
    'customers' => ['total' => 0],
    'sales' => ['monthly' => 0, 'pending' => 0],
    'revenue' => ['monthly' => 0],
    'expenses' => ['monthly' => 0],
    'profit' => ['monthly' => 0]
];

ob_start();
?>

<!-- Dashboard Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="mt-2 text-gray-600">Welcome back, <?php echo htmlspecialchars($user->name ?? 'User'); ?>! Here's what's happening with your business today.</p>
</div>

<!-- Key Metrics Grid -->
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
    <!-- Employees Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 transition-shadow hover:shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Employees</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?php echo number_format($metrics['employees']['total']); ?></p>
                <p class="mt-1 text-xs text-green-600">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <?php echo $metrics['employees']['active']; ?> Active
                    </span>
                </p>
            </div>
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Products Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 transition-shadow hover:shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Products</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?php echo number_format($metrics['products']['total']); ?></p>
                <?php if ($metrics['products']['low_stock'] > 0): ?>
                <p class="mt-1 text-xs text-red-600">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <?php echo $metrics['products']['low_stock']; ?> Low Stock
                    </span>
                </p>
                <?php else: ?>
                <p class="mt-1 text-xs text-green-600">✓ All items in stock</p>
                <?php endif; ?>
            </div>
            <div class="p-3 bg-purple-100 rounded-lg">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Customers Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 transition-shadow hover:shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Customers</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?php echo number_format($metrics['customers']['total']); ?></p>
                <p class="mt-1 text-xs text-gray-500">Active accounts</p>
            </div>
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Sales Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 transition-shadow hover:shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Monthly Sales</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?php echo number_format($metrics['sales']['monthly']); ?></p>
                <?php if ($metrics['sales']['pending'] > 0): ?>
                <p class="mt-1 text-xs text-yellow-600">
                    <?php echo $metrics['sales']['pending']; ?> Pending orders
                </p>
                <?php else: ?>
                <p class="mt-1 text-xs text-gray-500">All orders processed</p>
                <?php endif; ?>
            </div>
            <div class="p-3 bg-yellow-100 rounded-lg">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Financial Overview -->
<div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
    <!-- Revenue Card -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Monthly Revenue</h3>
            <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-4xl font-bold mb-2">$<?php echo number_format($metrics['revenue']['monthly'], 2); ?></p>
        <p class="text-sm opacity-90">↑ 12% from last month</p>
    </div>

    <!-- Expenses Card -->
    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Monthly Expenses</h3>
            <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-4xl font-bold mb-2">$<?php echo number_format($metrics['expenses']['monthly'], 2); ?></p>
        <p class="text-sm opacity-90">↓ 3% from last month</p>
    </div>

    <!-- Net Profit Card -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Net Profit</h3>
            <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-4xl font-bold mb-2">$<?php echo number_format($metrics['profit']['monthly'], 2); ?></p>
        <p class="text-sm opacity-90">↑ 18% from last month</p>
    </div>
</div>

<!-- Charts and Activities Section -->
<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">Recent Activities</h2>
            <a href="/admin/audits" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All →</a>
        </div>
        
        <div class="space-y-4">
            <?php
            // Sample activities (will be populated by controller)
            $activities = [
                ['icon' => 'user', 'text' => 'New employee registered', 'time' => '2 hours ago', 'color' => 'blue'],
                ['icon' => 'package', 'text' => 'Product stock updated', 'time' => '4 hours ago', 'color' => 'purple'],
                ['icon' => 'shopping', 'text' => 'New sales order created', 'time' => '6 hours ago', 'color' => 'green'],
                ['icon' => 'dollar', 'text' => 'Invoice payment received', 'time' => '8 hours ago', 'color' => 'yellow'],
                ['icon' => 'chart', 'text' => 'Monthly report generated', 'time' => '1 day ago', 'color' => 'red']
            ];
            
            foreach ($activities as $activity):
            ?>
            <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="p-2 bg-<?php echo $activity['color']; ?>-100 rounded-lg flex-shrink-0">
                    <svg class="w-5 h-5 text-<?php echo $activity['color']; ?>-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900"><?php echo $activity['text']; ?></p>
                    <p class="text-xs text-gray-500 mt-0.5"><?php echo $activity['time']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <a href="/employees/create" class="flex flex-col items-center justify-center p-6 bg-blue-50 border-2 border-blue-200 rounded-xl hover:bg-blue-100 hover:border-blue-300 transition">
                <svg class="w-10 h-10 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-900">Add Employee</span>
            </a>

            <a href="/products/create" class="flex flex-col items-center justify-center p-6 bg-purple-50 border-2 border-purple-200 rounded-xl hover:bg-purple-100 hover:border-purple-300 transition">
                <svg class="w-10 h-10 text-purple-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span class="text-sm font-semibold text-gray-900">Add Product</span>
            </a>

            <a href="/sales/create" class="flex flex-col items-center justify-center p-6 bg-green-50 border-2 border-green-200 rounded-xl hover:bg-green-100 hover:border-green-300 transition">
                <svg class="w-10 h-10 text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-900">New Sale</span>
            </a>

            <a href="/invoices/create" class="flex flex-col items-center justify-center p-6 bg-yellow-50 border-2 border-yellow-200 rounded-xl hover:bg-yellow-100 hover:border-yellow-300 transition">
                <svg class="w-10 h-10 text-yellow-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-900">Create Invoice</span>
            </a>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="/reports" class="block w-full text-center py-3 px-4 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-lg transition">
                View Reports
            </a>
        </div>
    </div>
</div>

<!-- Low Stock Alert (if any) -->
<?php if ($metrics['products']['low_stock'] > 0): ?>
<div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
    <div class="flex items-start">
        <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">Low Stock Alert</h3>
            <p class="mt-1 text-sm text-red-700">
                You have <?php echo $metrics['products']['low_stock']; ?> product(s) running low on stock. 
                <a href="/inventory?filter=low_stock" class="font-semibold underline">Review inventory →</a>
            </p>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
