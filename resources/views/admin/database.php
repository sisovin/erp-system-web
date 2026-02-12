<?php
/**
 * Admin Database Management Page
 * Database monitoring, backups, migrations, and optimization
 */

$pageTitle = 'Database Management';
$activeMenu = 'database';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Database Management</h1>
      <p class="mt-2 text-sm text-gray-600">Monitor, optimize, and manage your database</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="refresh-cw" class="w-4 h-4 mr-2 stroke-current"></i>
        Refresh
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Backup Now
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Database Size</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">42.5 GB</p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="database" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
    </div>
    <div class="mt-4">
      <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
        <span>Storage Used</span>
        <span>85%</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-blue-600 h-2 rounded-full" style="width: 85%"></div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Tables</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">47</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="layers" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">12 InnoDB, 35 MyISAM</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Records</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">1.2M</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="file-text" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-green-600 mt-4">↑ 15K new this week</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Last Backup</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">2h</p>
      </div>
      <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
        <i data-feather="clock" class="w-6 h-6 text-yellow-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Today at 12:15 PM</p>
  </div>
</div>

<!-- Tabs -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
  <div class="border-b border-gray-200">
    <nav class="flex -mb-px">
      <button class="tab-button active px-6 py-4 text-sm font-medium border-b-2 border-blue-600 text-blue-600" data-tab="overview">
        Overview
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="tables">
        Tables (47)
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="backups">
        Backups
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="migrations">
        Migrations
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="queries">
        Query Monitor
      </button>
    </nav>
  </div>

  <!-- Tab Content: Overview -->
  <div class="tab-content active p-6" id="overview">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Database Info -->
      <div class="space-y-6">
        <div>
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Database Information</h3>
          <div class="bg-gray-50 rounded-lg p-4 space-y-3">
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
              <span class="text-sm font-medium text-gray-600">Server</span>
              <span class="text-sm text-gray-900">MySQL 8.0.32</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
              <span class="text-sm font-medium text-gray-600">Host</span>
              <span class="text-sm text-gray-900">localhost:3306</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
              <span class="text-sm font-medium text-gray-600">Database Name</span>
              <span class="text-sm text-gray-900">erp_system</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
              <span class="text-sm font-medium text-gray-600">Charset</span>
              <span class="text-sm text-gray-900">utf8mb4_unicode_ci</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
              <span class="text-sm font-medium text-gray-600">Uptime</span>
              <span class="text-sm text-gray-900">24 days, 14 hours</span>
            </div>
            <div class="flex items-center justify-between py-2">
              <span class="text-sm font-medium text-gray-600">Max Connections</span>
              <span class="text-sm text-gray-900">151</span>
            </div>
          </div>
        </div>

        <!-- Performance Metrics -->
        <div>
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance Metrics</h3>
          <div class="space-y-4">
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-600">Query Cache Hit Rate</span>
                <span class="text-sm font-semibold text-green-600">94.2%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full" style="width: 94.2%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-600">Buffer Pool Usage</span>
                <span class="text-sm font-semibold text-blue-600">78.5%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: 78.5%"></div>
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-600">Thread Cache Hit Rate</span>
                <span class="text-sm font-semibold text-purple-600">99.1%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-purple-600 h-2 rounded-full" style="width: 99.1%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity & Actions -->
      <div class="space-y-6">
        <!-- Quick Actions -->
        <div>
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
          <div class="grid grid-cols-2 gap-3">
            <button class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition text-left">
              <i data-feather="download" class="w-5 h-5 text-blue-600 mb-2 stroke-current"></i>
              <p class="text-sm font-medium text-blue-900">Backup Database</p>
              <p class="text-xs text-blue-600 mt-1">Create manual backup</p>
            </button>
            <button class="p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition text-left">
              <i data-feather="zap" class="w-5 h-5 text-purple-600 mb-2 stroke-current"></i>
              <p class="text-sm font-medium text-purple-900">Optimize Tables</p>
              <p class="text-xs text-purple-600 mt-1">Run optimization</p>
            </button>
            <button class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition text-left">
              <i data-feather="play" class="w-5 h-5 text-green-600 mb-2 stroke-current"></i>
              <p class="text-sm font-medium text-green-900">Run Migration</p>
              <p class="text-xs text-green-600 mt-1">Execute pending</p>
            </button>
            <button class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition text-left">
              <i data-feather="search" class="w-5 h-5 text-yellow-600 mb-2 stroke-current"></i>
              <p class="text-sm font-medium text-yellow-900">Check Health</p>
              <p class="text-xs text-yellow-600 mt-1">Run diagnostics</p>
            </button>
          </div>
        </div>

        <!-- Recent Activity -->
        <div>
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
          <div class="space-y-3">
            <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
              <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="check" class="w-4 h-4 text-green-600 stroke-current"></i>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">Backup Completed</p>
                <p class="text-xs text-gray-500 mt-1">Database backup saved (2.4 GB)</p>
                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
              </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
              <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="database" class="w-4 h-4 text-blue-600 stroke-current"></i>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">Table Optimized</p>
                <p class="text-xs text-gray-500 mt-1">users table optimized successfully</p>
                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
              </div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
              <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="upload" class="w-4 h-4 text-purple-600 stroke-current"></i>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">Migration Applied</p>
                <p class="text-xs text-gray-500 mt-1">add_refresh_tokens_table migration</p>
                <p class="text-xs text-gray-400 mt-1">1 day ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Tables -->
  <div class="tab-content hidden p-6" id="tables">
    <!-- Search -->
    <div class="mb-6">
      <div class="relative max-w-md">
        <i data-feather="search" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 stroke-current"></i>
        <input type="text" placeholder="Search tables..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>
    </div>

    <!-- Tables List -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Engine</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rows</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Collation</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="table" class="w-4 h-4 text-gray-400 mr-2 stroke-current"></i>
                <span class="text-sm font-medium text-gray-900">users</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">InnoDB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">24,567</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">4.2 MB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">utf8mb4_unicode_ci</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <div class="flex items-center space-x-2">
                <button class="text-blue-600 hover:text-blue-800">Browse</button>
                <button class="text-purple-600 hover:text-purple-800">Optimize</button>
                <button class="text-green-600 hover:text-green-800">Export</button>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="table" class="w-4 h-4 text-gray-400 mr-2 stroke-current"></i>
                <span class="text-sm font-medium text-gray-900">audit_logs</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">InnoDB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">847,234</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">142 MB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">utf8mb4_unicode_ci</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <div class="flex items-center space-x-2">
                <button class="text-blue-600 hover:text-blue-800">Browse</button>
                <button class="text-purple-600 hover:text-purple-800">Optimize</button>
                <button class="text-green-600 hover:text-green-800">Export</button>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="table" class="w-4 h-4 text-gray-400 mr-2 stroke-current"></i>
                <span class="text-sm font-medium text-gray-900">scheduled_exports</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">InnoDB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">156</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">128 KB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">utf8mb4_unicode_ci</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <div class="flex items-center space-x-2">
                <button class="text-blue-600 hover:text-blue-800">Browse</button>
                <button class="text-purple-600 hover:text-purple-800">Optimize</button>
                <button class="text-green-600 hover:text-green-800">Export</button>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="table" class="w-4 h-4 text-gray-400 mr-2 stroke-current"></i>
                <span class="text-sm font-medium text-gray-900">refresh_tokens</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">InnoDB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3,421</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">892 KB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">utf8mb4_unicode_ci</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <div class="flex items-center space-x-2">
                <button class="text-blue-600 hover:text-blue-800">Browse</button>
                <button class="text-purple-600 hover:text-purple-800">Optimize</button>
                <button class="text-green-600 hover:text-green-800">Export</button>
              </div>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="table" class="w-4 h-4 text-gray-400 mr-2 stroke-current"></i>
                <span class="text-sm font-medium text-gray-900">settings</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">InnoDB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">87</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">64 KB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">utf8mb4_unicode_ci</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <div class="flex items-center space-x-2">
                <button class="text-blue-600 hover:text-blue-800">Browse</button>
                <button class="text-purple-600 hover:text-purple-800">Optimize</button>
                <button class="text-green-600 hover:text-green-800">Export</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
      <p class="text-sm text-gray-600">Showing 5 of 47 tables</p>
      <div class="flex items-center space-x-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
      </div>
    </div>
  </div>

  <!-- Tab Content: Backups -->
  <div class="tab-content hidden p-6" id="backups">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h3 class="text-lg font-semibold text-gray-900">Backup History</h3>
        <p class="text-sm text-gray-600 mt-1">Automatic backups run daily at 2:00 AM</p>
      </div>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Create Backup
      </button>
    </div>

    <!-- Backups List -->
    <div class="space-y-4">
      <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
        <div class="flex items-start justify-between">
          <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-feather="check-circle" class="w-6 h-6 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">database_backup_2026-02-12.sql.gz</h4>
              <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-4 h-4 mr-1 stroke-current"></i>
                  Feb 12, 2026 at 2:00 AM
                </span>
                <span class="flex items-center">
                  <i data-feather="hard-drive" class="w-4 h-4 mr-1 stroke-current"></i>
                  2.4 GB
                </span>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Automatic</span>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <button class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
              <i data-feather="download" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Download
            </button>
            <button class="px-3 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition text-sm font-medium">
              <i data-feather="rotate-ccw" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Restore
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
        <div class="flex items-start justify-between">
          <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-feather="check-circle" class="w-6 h-6 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">database_backup_2026-02-11.sql.gz</h4>
              <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-4 h-4 mr-1 stroke-current"></i>
                  Feb 11, 2026 at 2:00 AM
                </span>
                <span class="flex items-center">
                  <i data-feather="hard-drive" class="w-4 h-4 mr-1 stroke-current"></i>
                  2.3 GB
                </span>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Automatic</span>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <button class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
              <i data-feather="download" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Download
            </button>
            <button class="px-3 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition text-sm font-medium">
              <i data-feather="rotate-ccw" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Restore
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
        <div class="flex items-start justify-between">
          <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-feather="user" class="w-6 h-6 text-blue-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900">pre_migration_backup_2026-02-10.sql.gz</h4>
              <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-4 h-4 mr-1 stroke-current"></i>
                  Feb 10, 2026 at 3:45 PM
                </span>
                <span class="flex items-center">
                  <i data-feather="hard-drive" class="w-4 h-4 mr-1 stroke-current"></i>
                  2.2 GB
                </span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Manual</span>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <button class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
              <i data-feather="download" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Download
            </button>
            <button class="px-3 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition text-sm font-medium">
              <i data-feather="rotate-ccw" class="w-4 h-4 inline mr-1 stroke-current"></i>
              Restore
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Migrations -->
  <div class="tab-content hidden p-6" id="migrations">
    <div class="mb-6 flex items-center justify-between">
      <div>
        <h3 class="text-lg font-semibold text-gray-900">Database Migrations</h3>
        <p class="text-sm text-gray-600 mt-1">Track and manage database schema changes</p>
      </div>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="play" class="w-4 h-4 mr-2 stroke-current"></i>
        Run Pending
      </button>
    </div>

    <!-- Migrations List -->
    <div class="space-y-3">
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
              <i data-feather="check" class="w-5 h-5 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-sm font-semibold text-gray-900">2026_02_10_create_refresh_tokens_table</h4>
              <p class="text-xs text-gray-600 mt-1">Applied on Feb 10, 2026 at 3:47 PM</p>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Applied</span>
            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs font-medium">
              Rollback
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
              <i data-feather="check" class="w-5 h-5 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-sm font-semibold text-gray-900">2026_02_05_add_schedule_to_scheduled_exports</h4>
              <p class="text-xs text-gray-600 mt-1">Applied on Feb 5, 2026 at 10:22 AM</p>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Applied</span>
            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs font-medium">
              Rollback
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
              <i data-feather="check" class="w-5 h-5 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-sm font-semibold text-gray-900">2026_01_15_create_audit_logs_table</h4>
              <p class="text-xs text-gray-600 mt-1">Applied on Jan 15, 2026 at 2:15 PM</p>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Applied</span>
            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs font-medium">
              Rollback
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-yellow-300 rounded-lg p-4 bg-yellow-50">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
              <i data-feather="clock" class="w-5 h-5 text-yellow-600 stroke-current"></i>
            </div>
            <div>
              <h4 class="text-sm font-semibold text-gray-900">2026_02_12_add_notification_preferences</h4>
              <p class="text-xs text-gray-600 mt-1">Ready to apply</p>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Pending</span>
            <button class="px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-xs font-medium">
              Run Now
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Query Monitor -->
  <div class="tab-content hidden p-6" id="queries">
    <div class="mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Slow Query Log</h3>
      <p class="text-sm text-gray-600 mt-1">Queries taking longer than 1 second</p>
    </div>

    <!-- Queries List -->
    <div class="space-y-4">
      <div class="bg-white border border-red-200 rounded-lg p-4">
        <div class="flex items-start justify-between mb-3">
          <div class="flex items-center space-x-3">
            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">3.42s</span>
            <span class="text-xs text-gray-500">Executed 15 minutes ago</span>
          </div>
          <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Explain</button>
        </div>
        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
          <code class="text-xs text-green-400 font-mono">
            SELECT * FROM audit_logs WHERE user_id = 1247 AND created_at > '2026-01-01' ORDER BY created_at DESC LIMIT 1000;
          </code>
        </div>
      </div>

      <div class="bg-white border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start justify-between mb-3">
          <div class="flex items-center space-x-3">
            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">1.87s</span>
            <span class="text-xs text-gray-500">Executed 1 hour ago</span>
          </div>
          <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Explain</button>
        </div>
        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
          <code class="text-xs text-green-400 font-mono">
            SELECT u.*, COUNT(al.id) as log_count FROM users u LEFT JOIN audit_logs al ON u.id = al.user_id GROUP BY u.id;
          </code>
        </div>
      </div>

      <div class="bg-white border border-yellow-200 rounded-lg p-4">
        <div class="flex items-start justify-between mb-3">
          <div class="flex items-center space-x-3">
            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">1.23s</span>
            <span class="text-xs text-gray-500">Executed 2 hours ago</span>
          </div>
          <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Explain</button>
        </div>
        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
          <code class="text-xs text-green-400 font-mono">
            UPDATE users SET last_activity = NOW() WHERE id IN (SELECT DISTINCT user_id FROM sessions WHERE expires_at > NOW());
          </code>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Tab switching
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      const tabName = button.dataset.tab;
      
      // Update button states
      document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'border-blue-600', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
      });
      button.classList.add('active', 'border-blue-600', 'text-blue-600');
      button.classList.remove('border-transparent', 'text-gray-500');
      
      // Update content visibility
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
      });
      const activeContent = document.getElementById(tabName);
      if (activeContent) {
        activeContent.classList.remove('hidden');
        activeContent.classList.add('active');
      }
      
      // Re-initialize Feather icons for newly displayed content
      feather.replace();
    });
  });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
