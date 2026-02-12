<?php
$title = 'Employee Details';
$currentPage = 'hr';
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                <?= htmlspecialchars(($employee['first_name'] ?? '') . ' ' . ($employee['last_name'] ?? '')) ?>
            </h1>
            <p class="text-gray-600"><?= htmlspecialchars($employee['position'] ?? 'N/A') ?> - <?= htmlspecialchars($employee['department'] ?? 'N/A') ?></p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
            <a href="/hr/<?= $employee['id'] ?? '' ?>/edit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <button onclick="deleteEmployee(<?= $employee['id'] ?? 0 ?>)" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
            <a href="/hr" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
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
            <!-- Personal Information Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Personal Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Full Name</label>
                        <p class="text-gray-800"><?= htmlspecialchars(($employee['first_name'] ?? '') . ' ' . ($employee['last_name'] ?? '')) ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Employee ID</label>
                        <p class="text-gray-800 font-mono"><?= htmlspecialchars($employee['employee_id'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['email'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Phone</label>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['phone'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Date of Birth</label>
                        <p class="text-gray-800"><?= isset($employee['date_of_birth']) ? date('F d, Y', strtotime($employee['date_of_birth'])) : 'N/A' ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Gender</label>
                        <p class="text-gray-800 capitalize"><?= htmlspecialchars($employee['gender'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>

            <!-- Employment Information Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Employment Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Department</label>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['department'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Position</label>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['position'] ?? 'N/A') ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Hire Date</label>
                        <p class="text-gray-800"><?= isset($employee['hire_date']) ? date('F d, Y', strtotime($employee['hire_date'])) : 'N/A' ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Salary</label>
                        <p class="text-gray-800 font-semibold">$<?= isset($employee['salary']) ? number_format($employee['salary'], 2) : '0.00' ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p>
                            <?php
                            $status = $employee['status'] ?? 'active';
                            $statusColors = [
                                'active' => 'bg-green-100 text-green-800',
                                'on_leave' => 'bg-yellow-100 text-yellow-800',
                                'terminated' => 'bg-red-100 text-red-800'
                            ];
                            $colorClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                            ?>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?= $colorClass ?>">
                                <?= ucwords(str_replace('_', ' ', $status)) ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Address Information Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Address
                </h2>
                <div class="space-y-2">
                    <?php if (!empty($employee['address'])): ?>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['address']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($employee['city']) || !empty($employee['state']) || !empty($employee['postal_code'])): ?>
                        <p class="text-gray-800">
                            <?= htmlspecialchars($employee['city'] ?? '') ?>
                            <?= !empty($employee['state']) ? ', ' . htmlspecialchars($employee['state']) : '' ?>
                            <?= !empty($employee['postal_code']) ? ' ' . htmlspecialchars($employee['postal_code']) : '' ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($employee['country'])): ?>
                        <p class="text-gray-800"><?= htmlspecialchars($employee['country']) ?></p>
                    <?php endif; ?>
                    <?php if (empty($employee['address']) && empty($employee['city']) && empty($employee['country'])): ?>
                        <p class="text-gray-500 italic">No address information available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Picture -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-4xl font-bold mb-4">
                        <?= strtoupper(substr($employee['first_name'] ?? 'U', 0, 1) . substr($employee['last_name'] ?? 'N', 0, 1)) ?>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars(($employee['first_name'] ?? '') . ' ' . ($employee['last_name'] ?? '')) ?></h3>
                    <p class="text-gray-600 text-sm"><?= htmlspecialchars($employee['employee_id'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="/hr/attendance?employee_id=<?= $employee['id'] ?? '' ?>" 
                        class="flex items-center w-full px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        View Attendance
                    </a>
                    <a href="/hr/payroll?employee_id=<?= $employee['id'] ?? '' ?>" 
                        class="flex items-center w-full px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        View Payroll
                    </a>
                </div>
            </div>

            <!-- Employment Stats -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Employment Stats</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-500">Time with Company</label>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php
                            if (isset($employee['hire_date'])) {
                                $hireDate = new DateTime($employee['hire_date']);
                                $now = new DateTime();
                                $diff = $hireDate->diff($now);
                                echo $diff->y . ' years, ' . $diff->m . ' months';
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Created At</label>
                        <p class="text-gray-800"><?= isset($employee['created_at']) ? date('M d, Y', strtotime($employee['created_at'])) : 'N/A' ?></p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Last Updated</label>
                        <p class="text-gray-800"><?= isset($employee['updated_at']) ? date('M d, Y', strtotime($employee['updated_at'])) : 'N/A' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function deleteEmployee(id) {
    const confirmed = await App.Confirm.show(
        'Are you sure you want to delete this employee?',
        'This action cannot be undone.'
    );
    
    if (confirmed) {
        try {
            const response = await App.API.delete('/hr/' + id);
            
            if (response.success) {
                App.Toast.success('Employee deleted successfully!');
                setTimeout(() => {
                    window.location.href = '/hr';
                }, 1500);
            } else {
                App.Toast.error(response.message || 'Failed to delete employee');
            }
        } catch (error) {
            App.Toast.error('An error occurred. Please try again.');
            console.error('Error:', error);
        }
    }
}
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
