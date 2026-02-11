<?php
$pageTitle = 'Users';
$activeMenu = 'users';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8">
  <h2 class="text-3xl font-bold text-gray-900">Users Management</h2>
  <p class="mt-2 text-sm text-gray-600">Manage system users and their access permissions.</p>
</div>

<!-- Users Table -->
<div class="card">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
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
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
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
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $u->created_at; ?></td>
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

