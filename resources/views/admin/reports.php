<?php
/**
 * Admin - Reports & Analytics
 */
$pageTitle = 'Reports & Analytics';
$activeMenu = 'reports';

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
  <div class="flex items-center justify-between flex-wrap gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Reports & Analytics</h1>
      <p class="text-gray-600">Generate and view comprehensive business reports</p>
    </div>
    <div class="flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="calendar" class="w-4 h-4 mr-2 stroke-current"></i>
        Date Range
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Create Report
      </button>
    </div>
  </div>
</div>

<!-- Report Categories -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Financial Reports -->
  <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white cursor-pointer hover:shadow-xl transition">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
        <i data-feather="dollar-sign" class="w-6 h-6 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold bg-white/20 px-2 py-1 rounded-full">24 Reports</span>
    </div>
    <h3 class="text-lg font-bold mb-2">Financial Reports</h3>
    <p class="text-sm text-blue-100">Revenue, expenses, and profit analysis</p>
  </div>

  <!-- Sales Reports -->
  <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white cursor-pointer hover:shadow-xl transition">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
        <i data-feather="trending-up" class="w-6 h-6 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold bg-white/20 px-2 py-1 rounded-full">18 Reports</span>
    </div>
    <h3 class="text-lg font-bold mb-2">Sales Reports</h3>
    <p class="text-sm text-green-100">Sales performance and forecasting</p>
  </div>

  <!-- HR Reports -->
  <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white cursor-pointer hover:shadow-xl transition">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
        <i data-feather="users" class="w-6 h-6 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold bg-white/20 px-2 py-1 rounded-full">12 Reports</span>
    </div>
    <h3 class="text-lg font-bold mb-2">HR Reports</h3>
    <p class="text-sm text-purple-100">Workforce analytics and attendance</p>
  </div>

  <!-- Inventory Reports -->
  <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white cursor-pointer hover:shadow-xl transition">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
        <i data-feather="package" class="w-6 h-6 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold bg-white/20 px-2 py-1 rounded-full">15 Reports</span>
    </div>
    <h3 class="text-lg font-bold mb-2">Inventory Reports</h3>
    <p class="text-sm text-orange-100">Stock levels and movement tracking</p>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
      <button class="tab-button border-b-2 border-blue-600 py-4 px-1 text-sm font-medium text-blue-600" data-tab="popular">
        <i data-feather="star" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Popular Reports
      </button>
      <button class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="recent">
        <i data-feather="clock" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Recent
      </button>
      <button class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="scheduled">
        <i data-feather="calendar" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Scheduled
      </button>
    </nav>
  </div>
</div>

<!-- Popular Reports Tab -->
<div id="popular-tab" class="tab-content">
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Report Card 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-feather="bar-chart-2" class="w-6 h-6 text-blue-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Revenue Summary</h3>
        <p class="text-sm text-gray-600 mb-4">Monthly revenue breakdown with trends and comparisons</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            142 downloads
          </span>
          <span>Last run: 2 hours ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Report Card 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <i data-feather="trending-up" class="w-6 h-6 text-green-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Sales Performance</h3>
        <p class="text-sm text-gray-600 mb-4">Sales metrics by team, product, and region</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            98 downloads
          </span>
          <span>Last run: 4 hours ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Report Card 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <i data-feather="users" class="w-6 h-6 text-purple-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Employee Attendance</h3>
        <p class="text-sm text-gray-600 mb-4">Attendance records and patterns analysis</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            76 downloads
          </span>
          <span>Last run: 1 day ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Report Card 4 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
            <i data-feather="package" class="w-6 h-6 text-orange-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Inventory Status</h3>
        <p class="text-sm text-gray-600 mb-4">Current stock levels and reorder alerts</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            64 downloads
          </span>
          <span>Last run: 6 hours ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Report Card 5 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
            <i data-feather="credit-card" class="w-6 h-6 text-red-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Expense Analysis</h3>
        <p class="text-sm text-gray-600 mb-4">Detailed breakdown of company expenses</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            52 downloads
          </span>
          <span>Last run: 3 hours ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Report Card 6 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
            <i data-feather="shopping-cart" class="w-6 h-6 text-teal-600 stroke-current"></i>
          </div>
          <span class="text-xs font-semibold text-teal-600 bg-teal-100 px-2 py-1 rounded-full">Popular</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Customer Orders</h3>
        <p class="text-sm text-gray-600 mb-4">Order history and fulfillment metrics</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span class="flex items-center">
            <i data-feather="download" class="w-3 h-3 mr-1 stroke-current"></i>
            48 downloads
          </span>
          <span>Last run: 5 hours ago</span>
        </div>
        <div class="flex space-x-2">
          <button class="flex-1 px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 transition">
            Generate
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Reports Tab -->
<div id="recent-tab" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-900">Recently Generated Reports</h2>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generated By</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="file-text" class="w-5 h-5 text-blue-500 mr-3 stroke-current"></i>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Monthly Revenue Report</div>
                  <div class="text-xs text-gray-500">revenue_jan_2026.pdf</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                Financial
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Feb 12, 2026 10:30 AM</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Download">
                <i data-feather="download" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="Share">
                <i data-feather="share-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <i data-feather="file-text" class="w-5 h-5 text-green-500 mr-3 stroke-current"></i>
                <div>
                  <div class="text-sm font-semibold text-gray-900">Sales Q1 Performance</div>
                  <div class="text-xs text-gray-500">sales_q1_2026.xlsx</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Sales
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sarah Miller</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Feb 11, 2026 3:45 PM</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3" title="Download">
                <i data-feather="download" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="text-gray-400 hover:text-gray-600" title="Share">
                <i data-feather="share-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Scheduled Reports Tab -->
<div id="scheduled-tab" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Scheduled Reports</h2>
    <p class="text-gray-600">Automated report scheduling coming soon.</p>
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
