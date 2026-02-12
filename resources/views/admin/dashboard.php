<?php
/**
 * Admin Dashboard
 * Comprehensive overview of system metrics, activity, and quick actions
 */

$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
      <p class="mt-2 text-sm text-gray-600">Welcome back, <?php echo htmlentities($user->name); ?>. Here's what's happening today.</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export Report
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="refresh-cw" class="w-4 h-4 mr-2 stroke-current"></i>
        Refresh
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview - Row 1 (Primary Metrics) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
  <!-- Total Users -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
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

  <!-- Active Sessions -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Active Sessions</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">147</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="activity" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-semibold flex items-center">
        <i data-feather="trending-up" class="w-4 h-4 mr-1 stroke-current"></i>
        +8%
      </span>
      <span class="text-gray-500 ml-2">from yesterday</span>
    </div>
  </div>

  <!-- Total Revenue -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">$52.4K</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="dollar-sign" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-semibold flex items-center">
        <i data-feather="trending-up" class="w-4 h-4 mr-1 stroke-current"></i>
        +23%
      </span>
      <span class="text-gray-500 ml-2">from last month</span>
    </div>
  </div>

  <!-- Support Tickets -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Support Tickets</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">23</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <i data-feather="alert-circle" class="w-6 h-6 text-orange-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-red-600 font-semibold flex items-center">
        <i data-feather="trending-down" class="w-4 h-4 mr-1 stroke-current"></i>
        -5%
      </span>
      <span class="text-gray-500 ml-2">from last week</span>
    </div>
  </div>
</div>

<!-- Stats Overview - Row 2 (System Metrics) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Database Size -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-3">
      <p class="text-sm font-medium text-gray-600">Database Size</p>
      <i data-feather="database" class="w-5 h-5 text-gray-400 stroke-current"></i>
    </div>
    <p class="text-2xl font-bold text-gray-900">42.5 GB</p>
    <div class="mt-4">
      <div class="flex justify-between text-xs text-gray-600 mb-1">
        <span>Storage Used</span>
        <span>85%</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: 85%"></div>
      </div>
    </div>
  </div>

  <!-- API Calls Today -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-3">
      <p class="text-sm font-medium text-gray-600">API Calls Today</p>
      <i data-feather="zap" class="w-5 h-5 text-gray-400 stroke-current"></i>
    </div>
    <p class="text-2xl font-bold text-gray-900">8,421</p>
    <div class="mt-4 flex items-center text-sm text-gray-500">
      <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
        99.8% Success
      </span>
    </div>
  </div>

  <!-- Avg Response Time -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-3">
      <p class="text-sm font-medium text-gray-600">Avg Response</p>
      <i data-feather="clock" class="w-5 h-5 text-gray-400 stroke-current"></i>
    </div>
    <p class="text-2xl font-bold text-gray-900">142ms</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-semibold">-12ms</span>
      <span class="text-gray-500 ml-2">improvement</span>
    </div>
  </div>

  <!-- System Status -->
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-3">
      <p class="text-sm font-medium text-gray-600">System Status</p>
      <i data-feather="check-circle" class="w-5 h-5 text-green-500 stroke-current"></i>
    </div>
    <p class="text-2xl font-bold text-green-600">Operational</p>
    <div class="mt-4 flex items-center text-sm text-gray-500">
      <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
        99.9% Uptime
      </span>
    </div>
  </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
  <!-- Recent Activity (2 columns) -->
  <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
      <a href="/admin/activity" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
    </div>
    <div class="p-6">
      <div class="space-y-4">
        <!-- Activity Item 1 -->
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-feather="user-plus" class="w-5 h-5 text-blue-600 stroke-current"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">New user registered</p>
            <p class="text-sm text-gray-600">Sarah Johnson created an account and is awaiting approval</p>
            <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
          </div>
        </div>

        <!-- Activity Item 2 -->
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <i data-feather="database" class="w-5 h-5 text-green-600 stroke-current"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">Database backup completed</p>
            <p class="text-sm text-gray-600">Scheduled backup finished successfully (2.4 GB)</p>
            <p class="text-xs text-gray-500 mt-1">15 minutes ago</p>
          </div>
        </div>

        <!-- Activity Item 3 -->
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
            <i data-feather="file-text" class="w-5 h-5 text-purple-600 stroke-current"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">Export completed</p>
            <p class="text-sm text-gray-600">Audit logs exported to CSV (1,247 records)</p>
            <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
          </div>
        </div>

        <!-- Activity Item 4 -->
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
            <i data-feather="alert-triangle" class="w-5 h-5 text-yellow-600 stroke-current"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">Storage warning</p>
            <p class="text-sm text-gray-600">Database storage is at 85% capacity</p>
            <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
          </div>
        </div>

        <!-- Activity Item 5 -->
        <div class="flex items-start space-x-4">
          <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-feather="check-circle" class="w-5 h-5 text-blue-600 stroke-current"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900">Workflow completed</p>
            <p class="text-sm text-gray-600">Employee onboarding for 3 new hires finished</p>
            <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions (1 column) -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
    </div>
    <div class="p-6">
      <div class="space-y-3">
        <a href="/admin/users" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition group">
          <div class="w-10 h-10 bg-blue-100 group-hover:bg-blue-200 rounded-lg flex items-center justify-center transition">
            <i data-feather="user-plus" class="w-5 h-5 text-blue-600 stroke-current"></i>
          </div>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">Add New User</p>
            <p class="text-xs text-gray-500">Create user account</p>
          </div>
          <i data-feather="chevron-right" class="w-5 h-5 text-gray-400 stroke-current"></i>
        </a>

        <a href="/admin/scheduled-exports" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition group">
          <div class="w-10 h-10 bg-green-100 group-hover:bg-green-200 rounded-lg flex items-center justify-center transition">
            <i data-feather="download" class="w-5 h-5 text-green-600 stroke-current"></i>
          </div>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">Export Data</p>
            <p class="text-xs text-gray-500">Schedule new export</p>
          </div>
          <i data-feather="chevron-right" class="w-5 h-5 text-gray-400 stroke-current"></i>
        </a>

        <a href="/admin/database" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition group">
          <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-lg flex items-center justify-center transition">
            <i data-feather="database" class="w-5 h-5 text-purple-600 stroke-current"></i>
          </div>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">Database Backup</p>
            <p class="text-xs text-gray-500">Manage backups</p>
          </div>
          <i data-feather="chevron-right" class="w-5 h-5 text-gray-400 stroke-current"></i>
        </a>

        <a href="/admin/audits" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition group">
          <div class="w-10 h-10 bg-orange-100 group-hover:bg-orange-200 rounded-lg flex items-center justify-center transition">
            <i data-feather="file-text" class="w-5 h-5 text-orange-600 stroke-current"></i>
          </div>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">View Audit Logs</p>
            <p class="text-xs text-gray-500">Security monitoring</p>
          </div>
          <i data-feather="chevron-right" class="w-5 h-5 text-gray-400 stroke-current"></i>
        </a>

        <a href="/admin/support" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition group">
          <div class="w-10 h-10 bg-red-100 group-hover:bg-red-200 rounded-lg flex items-center justify-center transition">
            <i data-feather="help-circle" class="w-5 h-5 text-red-600 stroke-current"></i>
          </div>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">Support Tickets</p>
            <p class="text-xs text-gray-500">Manage requests</p>
          </div>
          <i data-feather="chevron-right" class="w-5 h-5 text-gray-400 stroke-current"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Recent Users & System Health -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
  <!-- Recent Users -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
      <a href="/admin/users" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php 
          $recentUsers = array_slice($users, 0, 5);
          foreach ($recentUsers as $u): 
          ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                    <?php echo strtoupper(substr($u->name, 0, 1)); ?>
                  </div>
                  <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900"><?php echo htmlentities($u->name); ?></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-600"><?php echo htmlentities($u->email); ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- System Health -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-semibold text-gray-900">System Health</h3>
      <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">All Systems Go</span>
    </div>
    <div class="p-6">
      <div class="space-y-4">
        <!-- CPU Usage -->
        <div>
          <div class="flex justify-between text-sm mb-2">
            <span class="font-medium text-gray-700">CPU Usage</span>
            <span class="text-gray-600">23%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 23%"></div>
          </div>
        </div>

        <!-- Memory Usage -->
        <div>
          <div class="flex justify-between text-sm mb-2">
            <span class="font-medium text-gray-700">Memory Usage</span>
            <span class="text-gray-600">64%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 64%"></div>
          </div>
        </div>

        <!-- Disk Usage -->
        <div>
          <div class="flex justify-between text-sm mb-2">
            <span class="font-medium text-gray-700">Disk Usage</span>
            <span class="text-gray-600">85%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-600 h-2 rounded-full" style="width: 85%"></div>
          </div>
        </div>

        <!-- Network Traffic -->
        <div>
          <div class="flex justify-between text-sm mb-2">
            <span class="font-medium text-gray-700">Network Traffic</span>
            <span class="text-gray-600">42%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 42%"></div>
          </div>
        </div>

        <!-- Server Uptime -->
        <div class="mt-6 pt-4 border-t border-gray-200">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-700">Server Uptime</p>
              <p class="text-2xl font-bold text-gray-900 mt-1">47 days</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <i data-feather="server" class="w-6 h-6 text-green-600 stroke-current"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Initialize Feather icons
  feather.replace();
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
