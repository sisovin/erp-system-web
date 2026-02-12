<?php
/**
 * Admin Users Management Page
 * Comprehensive user management with stats, search, and CRUD operations
 */

$pageTitle = 'Users Management';
$activeMenu = 'users';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
      <p class="mt-2 text-sm text-gray-600">Manage system users and their access permissions</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export Users
      </button>
      <button id="add-user-btn" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="user-plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Add User
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Users -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Users</p>
        <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo count($users); ?></p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="users" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-semibold flex items-center">
        <i data-feather="trending-up" class="w-4 h-4 mr-1 stroke-current"></i>
        +12%
      </span>
      <span class="text-gray-500 ml-2">from last month</span>
    </div>
  </div>

  <!-- Active Users -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Active Users</p>
        <p class="text-3xl font-bold text-green-600 mt-2"><?php echo count(array_filter($users, function($u) { return true; })); ?></p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="user-check" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-semibold flex items-center">
        <i data-feather="trending-up" class="w-4 h-4 mr-1 stroke-current"></i>
        +5%
      </span>
      <span class="text-gray-500 ml-2">this week</span>
    </div>
  </div>

  <!-- New This Month -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">New This Month</p>
        <p class="text-3xl font-bold text-purple-600 mt-2">8</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="user-plus" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-purple-600 font-semibold">+8 users</span>
      <span class="text-gray-500 ml-2">in February</span>
    </div>
  </div>

  <!-- Admin Users -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Admin Users</p>
        <p class="text-3xl font-bold text-orange-600 mt-2">2</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <i data-feather="shield" class="w-6 h-6 text-orange-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">
        Full Access
      </span>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
  <!-- Search and Filters -->
  <div class="p-6 border-b border-gray-200">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
      <div class="flex-1 max-w-lg">
        <div class="relative">
          <i data-feather="search" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 stroke-current"></i>
          <input type="text" id="user-search" placeholder="Search users by name or email..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
          <option>All Roles</option>
          <option>Super Admin</option>
          <option>Admin</option>
          <option>Manager</option>
          <option>Employee</option>
          <option>Account</option>
          <option>Staff</option>
        </select>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
          <option>All Status</option>
          <option>Active</option>
          <option>Inactive</option>
          <option>Pending</option>
        </select>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
          <option>Sort by: Newest</option>
          <option>Sort by: Oldest</option>
          <option>Sort by: Name A-Z</option>
          <option>Sort by: Name Z-A</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Users Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php 
        $roles = ['Super_Admin', 'Admin', 'Manager', 'Employee', 'Account', 'Staff'];
        $roleColors = [
          'Super_Admin' => 'bg-purple-100 text-purple-800',
          'Admin' => 'bg-red-100 text-red-800',
          'Manager' => 'bg-blue-100 text-blue-800',
          'Employee' => 'bg-green-100 text-green-800',
          'Account' => 'bg-yellow-100 text-yellow-800',
          'Staff' => 'bg-gray-100 text-gray-800'
        ];
        
        foreach ($users as $index => $u): 
          $userRole = $roles[$index % count($roles)];
          $roleColor = $roleColors[$userRole];
        ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 whitespace-nowrap">
              <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                  <?php echo strtoupper(substr($u->name, 0, 1)); ?>
                </div>
                <div class="ml-3">
                  <div class="text-sm font-medium text-gray-900"><?php echo htmlentities($u->name); ?></div>
                  <div class="text-xs text-gray-500">ID: <?php echo $u->id; ?></div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900"><?php echo htmlentities($u->email); ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $roleColor; ?>">
                <?php echo str_replace('_', ' ', $userRole); ?>
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900"><?php echo date('M d, Y', strtotime($u->created_at)); ?></div>
              <div class="text-xs text-gray-500"><?php echo date('h:i A', strtotime($u->created_at)); ?></div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                <i data-feather="check-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                Active
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex items-center justify-end space-x-2">
                <button onclick="viewUser(<?php echo $u->id; ?>)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="View">
                  <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
                </button>
                <button onclick="editUser(<?php echo $u->id; ?>)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Edit">
                  <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
                </button>
                <button onclick="deleteUser(<?php echo $u->id; ?>)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                  <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
    <div class="flex items-center">
      <p class="text-sm text-gray-600">Showing <span class="font-medium"><?php echo count($users); ?></span> of <span class="font-medium"><?php echo count($users); ?></span> users</p>
    </div>
    <div class="flex items-center space-x-2">
      <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
        <i data-feather="chevron-left" class="w-4 h-4 stroke-current"></i>
      </button>
      <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
      <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
      <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
      <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
        <i data-feather="chevron-right" class="w-4 h-4 stroke-current"></i>
      </button>
    </div>
  </div>
</div>

<!-- Add/Edit User Modal -->
<div id="user-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeUserModal()"></div>

    <!-- Modal panel -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-6 pt-6 pb-4">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-900" id="user-modal-title">Add New User</h3>
          <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600">
            <i data-feather="x" class="w-6 h-6 stroke-current"></i>
          </button>
        </div>

        <form id="user-form" class="space-y-4">
          <!-- Hidden field for user ID (used when editing) -->
          <input type="hidden" id="user-id" value="">

          <!-- Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
            <input type="text" id="user-name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="John Doe">
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
            <input type="email" id="user-email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="john.doe@example.com">
          </div>

          <!-- Password -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password <span id="password-optional" class="text-gray-500 font-normal">(leave blank to keep current)</span></label>
            <input type="password" id="user-password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="••••••••">
          </div>

          <!-- Role -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
            <select id="user-role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="">Select role</option>
              <option value="Super_Admin">Super Admin</option>
              <option value="Admin">Admin</option>
              <option value="Manager">Manager</option>
              <option value="Employee">Employee</option>
              <option value="Account">Account</option>
              <option value="Staff">Staff</option>
            </select>
          </div>

          <!-- Status -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <div class="flex items-center space-x-4">
              <label class="flex items-center cursor-pointer">
                <input type="radio" name="status" value="active" checked class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Active</span>
              </label>
              <label class="flex items-center cursor-pointer">
                <input type="radio" name="status" value="inactive" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Inactive</span>
              </label>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
        <button onclick="closeUserModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          Cancel
        </button>
        <button onclick="saveUser()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
          Save User
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Initialize Feather icons
  feather.replace();

  // Search functionality
  document.getElementById('user-search')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
      const name = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
      const email = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
      
      if (name.includes(searchTerm) || email.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

  // Open add user modal
  document.getElementById('add-user-btn')?.addEventListener('click', () => {
    document.getElementById('user-modal-title').textContent = 'Add New User';
    document.getElementById('user-form').reset();
    document.getElementById('user-id').value = '';
    document.getElementById('user-password').required = true;
    document.getElementById('password-optional').style.display = 'none';
    document.getElementById('user-modal').classList.remove('hidden');
    feather.replace();
  });

  // Close user modal
  function closeUserModal() {
    document.getElementById('user-modal').classList.add('hidden');
  }

  // View user (placeholder)
  function viewUser(userId) {
    console.log('View user:', userId);
    alert(`View user details for ID: ${userId}`);
  }

  // Edit user - Populate form with user data
  function editUser(userId) {
    // Find user data from the table
    const userRows = document.querySelectorAll('tbody tr');
    let userData = null;
    
    userRows.forEach(row => {
      const rowId = row.querySelector('td:nth-child(2) .text-xs')?.textContent.replace('ID: ', '');
      if (rowId == userId) {
        const name = row.querySelector('td:nth-child(2) .text-sm.font-medium')?.textContent.trim();
        const email = row.querySelector('td:nth-child(3) .text-sm')?.textContent.trim();
        const role = row.querySelector('td:nth-child(4) span')?.textContent.trim();
        const status = row.querySelector('td:nth-child(6) span')?.textContent.trim();
        
        userData = { id: userId, name, email, role, status };
      }
    });

    if (userData) {
      // Set modal title
      document.getElementById('user-modal-title').textContent = 'Edit User';
      
      // Populate form fields
      document.getElementById('user-id').value = userData.id;
      document.getElementById('user-name').value = userData.name;
      document.getElementById('user-email').value = userData.email;
      document.getElementById('user-role').value = userData.role === 'User' ? 'Employee' : userData.role;
      
      // Set status radio button
      const statusLower = userData.status.toLowerCase();
      document.querySelector(`input[name="status"][value="${statusLower}"]`)?.click();
      
      // Password is optional when editing
      document.getElementById('user-password').required = false;
      document.getElementById('user-password').value = '';
      document.getElementById('password-optional').style.display = 'inline';
      
      // Show modal
      document.getElementById('user-modal').classList.remove('hidden');
      feather.replace();
    }
  }

  // Delete user (placeholder)
  function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
      console.log('Delete user:', userId);
      alert('User deleted successfully!');
      // In a real application, you would send a DELETE request to the server
    }
  }

  // Save user (placeholder)
  function saveUser() {
    const userId = document.getElementById('user-id').value;
    const name = document.getElementById('user-name').value;
    const email = document.getElementById('user-email').value;
    const password = document.getElementById('user-password').value;
    const role = document.getElementById('user-role').value;
    const status = document.querySelector('input[name="status"]:checked').value;

    // Validate required fields
    if (!name || !email || !role) {
      alert('Please fill in all required fields');
      return;
    }

    // Password is required only when creating new user
    if (!userId && !password) {
      alert('Password is required for new users');
      return;
    }

    // Here you would normally send this data to the server
    const action = userId ? 'updated' : 'created';
    console.log(`${action} user:`, { userId, name, email, password, role, status });
    
    alert(`User ${action} successfully!\n\nName: ${name}\nEmail: ${email}\nRole: ${role}\nStatus: ${status}`);
    closeUserModal();
    
    // In a real application, you would refresh the user list here
  }
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
