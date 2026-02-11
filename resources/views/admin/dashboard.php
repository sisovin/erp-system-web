<?php
$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8">
  <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
  <p class="mt-2 text-sm text-gray-600">Welcome back, <?php echo htmlentities($user->name); ?>. Here's what's happening today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
  <!-- Total Users -->
  <div class="card hover:shadow-md transition-shadow">
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
          <i data-feather="users" class="w-6 h-6 text-primary-600"></i>
        </div>
      </div>
      <div class="ml-4 flex-1">
        <p class="text-sm font-medium text-gray-500">Total Users</p>
        <p class="text-2xl font-bold text-gray-900"><?php echo count($users); ?></p>
      </div>
    </div>
  </div>

  <!-- Active Sessions -->
  <div class="card hover:shadow-md transition-shadow">
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <i data-feather="activity" class="w-6 h-6 text-green-600"></i>
        </div>
      </div>
      <div class="ml-4 flex-1">
        <p class="text-sm font-medium text-gray-500">Active Sessions</p>
        <p class="text-2xl font-bold text-gray-900">1</p>
      </div>
    </div>
  </div>

  <!-- Scheduled Exports -->
  <div class="card hover:shadow-md transition-shadow">
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
          <i data-feather="clock" class="w-6 h-6 text-blue-600"></i>
        </div>
      </div>
      <div class="ml-4 flex-1">
        <p class="text-sm font-medium text-gray-500">Scheduled Exports</p>
        <p class="text-2xl font-bold text-gray-900">3</p>
      </div>
    </div>
  </div>

  <!-- System Status -->
  <div class="card hover:shadow-md transition-shadow">
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
        </div>
      </div>
      <div class="ml-4 flex-1">
        <p class="text-sm font-medium text-gray-500">System Status</p>
        <p class="text-lg font-semibold text-green-600">Operational</p>
      </div>
    </div>
  </div>
</div>

<!-- Users Table -->
<div class="card">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-gray-900">Recent Users</h2>
    <button class="btn btn-primary text-sm">
      <i data-feather="plus" class="w-4 h-4 inline mr-1 stroke-current"></i>
      Add User
    </button>
  </div>
  
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($users as $u): ?>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $u->id; ?></td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white text-xs font-semibold mr-3">
                  <?php echo strtoupper(substr($u->name, 0, 1)); ?>
                </div>
                <div class="text-sm font-medium text-gray-900"><?php echo htmlentities($u->name); ?></div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlentities($u->email); ?></td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="badge badge-success">Active</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-primary-600 hover:text-primary-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 inline stroke-current"></i>
              </button>
              <button class="text-red-600 hover:text-red-900" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 inline stroke-current"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
