<?php
/**
 * Admin - Activity Monitor
 */
$pageTitle = 'Activity Monitor';
$activeMenu = 'activity';

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
  <div class="flex items-center justify-between flex-wrap gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Activity Monitor</h1>
      <p class="text-gray-600">Real-time system activity and user actions</p>
    </div>
    <div class="flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="filter" class="w-4 h-4 mr-2 stroke-current"></i>
        Filter
      </button>
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export
      </button>
      <button id="refresh-btn" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition flex items-center">
        <i data-feather="refresh-cw" class="w-4 h-4 mr-2 stroke-current"></i>
        Refresh
      </button>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Active Users -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="users" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Online</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">28</h3>
    <p class="text-sm text-gray-600">Active Users</p>
    <div class="mt-2 flex items-center text-xs text-green-600">
      <i data-feather="trending-up" class="w-3 h-3 mr-1 stroke-current"></i>
      <span>+12% from yesterday</span>
    </div>
  </div>

  <!-- Actions Today -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="activity" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Today</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">1,247</h3>
    <p class="text-sm text-gray-600">Actions Today</p>
    <div class="mt-2 flex items-center text-xs text-blue-600">
      <i data-feather="zap" class="w-3 h-3 mr-1 stroke-current"></i>
      <span>524 in last hour</span>
    </div>
  </div>

  <!-- Failed Actions -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <i data-feather="alert-circle" class="w-6 h-6 text-red-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">Errors</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">8</h3>
    <p class="text-sm text-gray-600">Failed Actions</p>
    <div class="mt-2 flex items-center text-xs text-gray-500">
      <i data-feather="minus" class="w-3 h-3 mr-1 stroke-current"></i>
      <span>-40% from yesterday</span>
    </div>
  </div>

  <!-- Response Time -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="clock" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Avg</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">124ms</h3>
    <p class="text-sm text-gray-600">Response Time</p>
    <div class="mt-2 flex items-center text-xs text-green-600">
      <i data-feather="trending-down" class="w-3 h-3 mr-1 stroke-current"></i>
      <span>-8% faster</span>
    </div>
  </div>
</div>

<!-- Activity Timeline -->
<div class="grid lg:grid-cols-3 gap-6">
  <!-- Recent Activity -->
  <div class="lg:col-span-2">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
          <div class="flex items-center space-x-2">
            <select class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option>All Actions</option>
              <option>Logins</option>
              <option>Updates</option>
              <option>Deletions</option>
              <option>Errors</option>
            </select>
          </div>
        </div>
      </div>

      <div class="divide-y divide-gray-200 max-h-[600px] overflow-y-auto">
        <!-- Activity Item 1 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="log-in" class="w-5 h-5 text-green-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">User Login</p>
                <span class="text-xs text-gray-500">2 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">John Doe</span> logged in from Chrome on Windows
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="map-pin" class="w-3 h-3 mr-1 stroke-current"></i>
                  192.168.1.105
                </span>
                <span class="flex items-center">
                  <i data-feather="monitor" class="w-3 h-3 mr-1 stroke-current"></i>
                  Desktop
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 2 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="edit" class="w-5 h-5 text-blue-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">Data Update</p>
                <span class="text-xs text-gray-500">5 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Sarah Miller</span> updated customer record #4523
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="file-text" class="w-3 h-3 mr-1 stroke-current"></i>
                  Customer Module
                </span>
                <span class="flex items-center">
                  <i data-feather="clock" class="w-3 h-3 mr-1 stroke-current"></i>
                  142ms
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 3 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="plus-circle" class="w-5 h-5 text-purple-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">New Record Created</p>
                <span class="text-xs text-gray-500">12 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Robert Johnson</span> created new invoice #INV-2024
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="file-text" class="w-3 h-3 mr-1 stroke-current"></i>
                  Sales Module
                </span>
                <span class="flex items-center">
                  <i data-feather="dollar-sign" class="w-3 h-3 mr-1 stroke-current"></i>
                  $12,450.00
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 4 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="trash-2" class="w-5 h-5 text-red-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">Record Deleted</p>
                <span class="text-xs text-gray-500">18 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Emily Brown</span> deleted product #P-8832
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="package" class="w-3 h-3 mr-1 stroke-current"></i>
                  Inventory Module
                </span>
                <span class="flex items-center">
                  <i data-feather="alert-triangle" class="w-3 h-3 mr-1 stroke-current"></i>
                  Requires approval
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 5 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="alert-circle" class="w-5 h-5 text-yellow-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">Failed Action</p>
                <span class="text-xs text-gray-500">25 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Mike Wilson</span> failed to export report
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="alert-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                  Permission denied
                </span>
                <span class="flex items-center">
                  <i data-feather="clock" class="w-3 h-3 mr-1 stroke-current"></i>
                  Timeout: 5000ms
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 6 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="download" class="w-5 h-5 text-indigo-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">File Export</p>
                <span class="text-xs text-gray-500">32 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Lisa Chen</span> exported financial report
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="file" class="w-3 h-3 mr-1 stroke-current"></i>
                  report_2026_02.xlsx
                </span>
                <span class="flex items-center">
                  <i data-feather="hard-drive" class="w-3 h-3 mr-1 stroke-current"></i>
                  2.4 MB
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 7 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="log-in" class="w-5 h-5 text-green-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">User Login</p>
                <span class="text-xs text-gray-500">45 min ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">David Taylor</span> logged in from Safari on macOS
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="map-pin" class="w-3 h-3 mr-1 stroke-current"></i>
                  192.168.1.142
                </span>
                <span class="flex items-center">
                  <i data-feather="laptop" class="w-3 h-3 mr-1 stroke-current"></i>
                  MacBook Pro
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Item 8 -->
        <div class="p-4 hover:bg-gray-50 transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
              <i data-feather="settings" class="w-5 h-5 text-teal-600 stroke-current"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-semibold text-gray-900">Settings Changed</p>
                <span class="text-xs text-gray-500">1 hour ago</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                <span class="font-medium text-gray-900">Anna Kim</span> updated system configuration
              </p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="settings" class="w-3 h-3 mr-1 stroke-current"></i>
                  Email Settings
                </span>
                <span class="flex items-center">
                  <i data-feather="check-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                  Applied
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Load More -->
      <div class="p-4 border-t border-gray-200 bg-gray-50">
        <button class="w-full px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition">
          Load More Activities
        </button>
      </div>
    </div>
  </div>

  <!-- Active Users Panel -->
  <div class="space-y-6">
    <!-- Online Users -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
      <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Online Users</h2>
        <p class="text-sm text-gray-500 mt-1">Currently active in the system</p>
      </div>
      <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
        <!-- User 1 -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="relative">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                JD
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-semibold text-gray-900">John Doe</p>
              <p class="text-xs text-gray-500">Admin</p>
            </div>
          </div>
          <span class="text-xs text-gray-400">2m ago</span>
        </div>

        <!-- User 2 -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="relative">
              <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                SM
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-semibold text-gray-900">Sarah Miller</p>
              <p class="text-xs text-gray-500">Manager</p>
            </div>
          </div>
          <span class="text-xs text-gray-400">5m ago</span>
        </div>

        <!-- User 3 -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="relative">
              <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                RJ
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-semibold text-gray-900">Robert Johnson</p>
              <p class="text-xs text-gray-500">Employee</p>
            </div>
          </div>
          <span class="text-xs text-gray-400">12m ago</span>
        </div>

        <!-- User 4 -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="relative">
              <div class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                EB
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-semibold text-gray-900">Emily Brown</p>
              <p class="text-xs text-gray-500">Manager</p>
            </div>
          </div>
          <span class="text-xs text-gray-400">18m ago</span>
        </div>

        <!-- User 5 -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="relative">
              <div class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                MW
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-semibold text-gray-900">Mike Wilson</p>
              <p class="text-xs text-gray-500">Employee</p>
            </div>
          </div>
          <span class="text-xs text-gray-400">25m ago</span>
        </div>
      </div>
      <div class="p-4 border-t border-gray-200 bg-gray-50">
        <button class="w-full text-sm font-medium text-blue-600 hover:text-blue-700 transition">
          View All (28 online)
        </button>
      </div>
    </div>

    <!-- System Health -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
      <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">System Health</h2>
      </div>
      <div class="p-6 space-y-4">
        <!-- CPU Usage -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">CPU Usage</span>
            <span class="text-sm font-semibold text-gray-900">42%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-blue-600 h-2 rounded-full" style="width: 42%"></div>
          </div>
        </div>

        <!-- Memory Usage -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Memory</span>
            <span class="text-sm font-semibold text-gray-900">68%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-600 h-2 rounded-full" style="width: 68%"></div>
          </div>
        </div>

        <!-- Disk Usage -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Disk</span>
            <span class="text-sm font-semibold text-gray-900">54%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-purple-600 h-2 rounded-full" style="width: 54%"></div>
          </div>
        </div>

        <!-- Network -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Network</span>
            <span class="text-sm font-semibold text-gray-900">28%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-yellow-600 h-2 rounded-full" style="width: 28%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Refresh button functionality
document.getElementById('refresh-btn').addEventListener('click', function() {
  const icon = this.querySelector('i');
  icon.style.animation = 'spin 1s linear';
  setTimeout(() => {
    icon.style.animation = '';
    // In a real app, you would fetch new data here
  }, 1000);
});

// Add spin animation
const style = document.createElement('style');
style.textContent = `
  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
`;
document.head.appendChild(style);
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
?>
