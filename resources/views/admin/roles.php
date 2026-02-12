<?php
/**
 * Admin - Roles & Permissions Management
 */
$pageTitle = 'Roles & Permissions';
$activeMenu = 'roles';

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
  <div class="flex items-center justify-between flex-wrap gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Roles & Permissions</h1>
      <p class="text-gray-600">Manage user roles and access control</p>
    </div>
    <div class="flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Create Role
      </button>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Roles -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="shield" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Active</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">5</h3>
    <p class="text-sm text-gray-600">Total Roles</p>
  </div>

  <!-- Total Permissions -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="key" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">System</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">24</h3>
    <p class="text-sm text-gray-600">Permissions</p>
  </div>

  <!-- Users with Roles -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="users" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Assigned</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">142</h3>
    <p class="text-sm text-gray-600">Users with Roles</p>
  </div>

  <!-- Admin Users -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <i data-feather="award" class="w-6 h-6 text-red-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">Critical</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">12</h3>
    <p class="text-sm text-gray-600">Admin Users</p>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
      <button class="tab-button border-b-2 border-blue-600 py-4 px-1 text-sm font-medium text-blue-600" data-tab="roles">
        <i data-feather="shield" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Roles
      </button>
      <button class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="permissions">
        <i data-feather="key" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Permissions
      </button>
      <button class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="assignments">
        <i data-feather="link" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Role Assignments
      </button>
    </nav>
  </div>
</div>

<!-- Tab Content -->
<div id="roles-tab" class="tab-content">
  <!-- Roles List -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900">System Roles</h2>
        <div class="flex items-center space-x-3">
          <div class="relative">
            <i data-feather="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 stroke-current"></i>
            <input type="text" placeholder="Search roles..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <!-- Admin Role -->
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                  <i data-feather="shield" class="w-5 h-5 text-red-600 stroke-current"></i>
                </div>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Admin</div>
                  <div class="text-xs text-gray-500">System Administrator</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Full system access and control</div>
              <div class="text-xs text-gray-500 mt-1">Can manage all users, roles, and settings</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                All Permissions
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-semibold text-gray-900">12 users</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="View Details">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>

          <!-- Manager Role -->
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                  <i data-feather="briefcase" class="w-5 h-5 text-blue-600 stroke-current"></i>
                </div>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Manager</div>
                  <div class="text-xs text-gray-500">Department Manager</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Manage department operations</div>
              <div class="text-xs text-gray-500 mt-1">Can approve requests and view reports</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                18 Permissions
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-semibold text-gray-900">35 users</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="View Details">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>

          <!-- Employee Role -->
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                  <i data-feather="user" class="w-5 h-5 text-green-600 stroke-current"></i>
                </div>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Employee</div>
                  <div class="text-xs text-gray-500">Regular Employee</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Basic employee access</div>
              <div class="text-xs text-gray-500 mt-1">Can view own data and submit requests</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                8 Permissions
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-semibold text-gray-900">87 users</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="View Details">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>

          <!-- Accountant Role -->
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                  <i data-feather="dollar-sign" class="w-5 h-5 text-yellow-600 stroke-current"></i>
                </div>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Accountant</div>
                  <div class="text-xs text-gray-500">Finance Department</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Financial data management</div>
              <div class="text-xs text-gray-500 mt-1">Can manage invoices, expenses, and reports</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                12 Permissions
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-semibold text-gray-900">8 users</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="View Details">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
      <div class="flex items-center justify-between">
        <div class="text-sm text-gray-700">
          Showing <span class="font-semibold">1</span> to <span class="font-semibold">4</span> of <span class="font-semibold">5</span> roles
        </div>
        <div class="flex space-x-2">
          <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
            Previous
          </button>
          <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Permissions Tab (Hidden by default) -->
<div id="permissions-tab" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">System Permissions</h2>
    <p class="text-gray-600">Permission management interface coming soon.</p>
  </div>
</div>

<!-- Assignments Tab (Hidden by default) -->
<div id="assignments-tab" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Role Assignments</h2>
    <p class="text-gray-600">User role assignment interface coming soon.</p>
  </div>
</div>

<script>
// Tab switching
document.querySelectorAll('.tab-button').forEach(button => {
  button.addEventListener('click', function() {
    const tabName = this.getAttribute('data-tab');
    
    // Update button styles
    document.querySelectorAll('.tab-button').forEach(btn => {
      btn.classList.remove('border-blue-600', 'text-blue-600');
      btn.classList.add('border-transparent', 'text-gray-500');
    });
    this.classList.remove('border-transparent', 'text-gray-500');
    this.classList.add('border-blue-600', 'text-blue-600');
    
    // Show/hide tab content
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.add('hidden');
    });
    document.getElementById(tabName + '-tab').classList.remove('hidden');
  });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
?>
