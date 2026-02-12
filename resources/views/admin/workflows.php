<?php
$pageTitle = 'Workflow Automation';
$activeMenu = 'workflows';

ob_start();
?>

<!-- Header with Actions -->
<div class="mb-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Workflow Automation</h1>
      <p class="mt-2 text-sm text-gray-600">Design and manage automated business processes</p>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="openTemplates()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="layers" class="w-4 h-4 mr-2"></i>
        Templates
      </button>
      <button onclick="createWorkflow()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i>
        Create Workflow
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Active Workflows -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-blue-100 rounded-lg">
        <i data-feather="zap" class="w-6 h-6 text-blue-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Active</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">24</h3>
    <p class="text-sm text-gray-600 mt-1">Active Workflows</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">98.5% uptime</span>
    </div>
  </div>

  <!-- Executions Today -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-purple-100 rounded-lg">
        <i data-feather="activity" class="w-6 h-6 text-purple-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full">Today</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">1,847</h3>
    <p class="text-sm text-gray-600 mt-1">Executions Today</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">+12% vs yesterday</span>
    </div>
  </div>

  <!-- Success Rate -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-green-100 rounded-lg">
        <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Success</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">97.8%</h3>
    <p class="text-sm text-gray-600 mt-1">Success Rate</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">1,805 successful</span>
    </div>
  </div>

  <!-- Failed/Pending -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-red-100 rounded-lg">
        <i data-feather="alert-circle" class="w-6 h-6 text-red-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-red-100 text-red-800 rounded-full">Failed</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">42</h3>
    <p class="text-sm text-gray-600 mt-1">Failed Executions</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-red-600 font-medium">Needs attention</span>
    </div>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
      <button onclick="switchTab('workflows')" id="tab-workflows" class="tab-button border-b-2 border-blue-600 text-blue-600 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Active Workflows (24)
      </button>
      <button onclick="switchTab('executions')" id="tab-executions" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Recent Executions
      </button>
      <button onclick="switchTab('templates')" id="tab-templates" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Templates
      </button>
      <button onclick="switchTab('monitoring')" id="tab-monitoring" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Monitoring
      </button>
    </nav>
  </div>
</div>

<!-- Active Workflows Tab -->
<div id="content-workflows" class="tab-content">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <?php
    $workflows = [
      [
        'id' => 1,
        'name' => 'Automated Invoice Processing',
        'description' => 'Automatically process and approve invoices under $1,000',
        'trigger' => 'New Invoice Created',
        'status' => 'Active',
        'executions' => 342,
        'success_rate' => 99.4,
        'last_run' => '2 minutes ago',
        'category' => 'Finance',
        'steps' => 5
      ],
      [
        'id' => 2,
        'name' => 'Employee Onboarding',
        'description' => 'Setup accounts, permissions, and welcome email for new hires',
        'trigger' => 'New Employee Added',
        'status' => 'Active',
        'executions' => 12,
        'success_rate' => 100,
        'last_run' => '3 hours ago',
        'category' => 'HR',
        'steps' => 8
      ],
      [
        'id' => 3,
        'name' => 'Sales Lead Follow-up',
        'description' => 'Send automated follow-up emails to new leads',
        'trigger' => 'Lead Created',
        'status' => 'Active',
        'executions' => 567,
        'success_rate' => 98.2,
        'last_run' => '15 minutes ago',
        'category' => 'Sales',
        'steps' => 4
      ],
      [
        'id' => 4,
        'name' => 'Inventory Reorder Alert',
        'description' => 'Alert purchasing when inventory drops below threshold',
        'trigger' => 'Low Stock Detected',
        'status' => 'Active',
        'executions' => 89,
        'success_rate' => 96.6,
        'last_run' => '1 hour ago',
        'category' => 'Inventory',
        'steps' => 3
      ],
      [
        'id' => 5,
        'name' => 'Monthly Report Generation',
        'description' => 'Generate and email monthly financial reports',
        'trigger' => 'Schedule: Monthly',
        'status' => 'Active',
        'executions' => 24,
        'success_rate' => 100,
        'last_run' => '5 days ago',
        'category' => 'Reporting',
        'steps' => 6
      ],
      [
        'id' => 6,
        'name' => 'Customer Support Ticket Routing',
        'description' => 'Route tickets to appropriate department based on category',
        'trigger' => 'New Ticket Created',
        'status' => 'Active',
        'executions' => 428,
        'success_rate' => 99.1,
        'last_run' => '5 minutes ago',
        'category' => 'Support',
        'steps' => 4
      ],
      [
        'id' => 7,
        'name' => 'Expense Approval Workflow',
        'description' => 'Multi-level approval for employee expense reports',
        'trigger' => 'Expense Submitted',
        'status' => 'Active',
        'executions' => 156,
        'success_rate' => 97.4,
        'last_run' => '30 minutes ago',
        'category' => 'Finance',
        'steps' => 7
      ],
      [
        'id' => 8,
        'name' => 'Weekly Backup Notification',
        'description' => 'Verify backups completed and notify admins',
        'trigger' => 'Schedule: Weekly',
        'status' => 'Active',
        'executions' => 52,
        'success_rate' => 100,
        'last_run' => '2 days ago',
        'category' => 'IT',
        'steps' => 3
      ]
    ];

    foreach ($workflows as $workflow):
      $statusColor = $workflow['status'] === 'Active' ? 'green' : 'gray';
      $categoryColors = [
        'Finance' => 'blue',
        'HR' => 'purple',
        'Sales' => 'green',
        'Inventory' => 'yellow',
        'Reporting' => 'indigo',
        'Support' => 'pink',
        'IT' => 'red'
      ];
      $categoryColor = $categoryColors[$workflow['category']] ?? 'gray';
    ?>
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition">
        <!-- Header -->
        <div class="flex items-start justify-between mb-4">
          <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
              <h3 class="text-lg font-bold text-gray-900"><?php echo htmlspecialchars($workflow['name']); ?></h3>
              <span class="text-xs font-semibold px-2 py-1 bg-<?php echo $statusColor; ?>-100 text-<?php echo $statusColor; ?>-800 rounded-full">
                <?php echo htmlspecialchars($workflow['status']); ?>
              </span>
            </div>
            <p class="text-sm text-gray-600 mb-3"><?php echo htmlspecialchars($workflow['description']); ?></p>
            <div class="flex items-center gap-2">
              <span class="text-xs font-medium px-2 py-1 bg-<?php echo $categoryColor; ?>-100 text-<?php echo $categoryColor; ?>-800 rounded">
                <?php echo htmlspecialchars($workflow['category']); ?>
              </span>
              <span class="text-xs text-gray-500">
                <i data-feather="git-branch" class="w-3 h-3 inline"></i>
                <?php echo $workflow['steps']; ?> steps
              </span>
            </div>
          </div>
          <div class="ml-4">
            <button class="p-2 text-gray-400 hover:text-gray-600 transition">
              <i data-feather="more-vertical" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

        <!-- Trigger -->
        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center text-sm">
            <i data-feather="play-circle" class="w-4 h-4 text-gray-500 mr-2"></i>
            <span class="text-gray-600">Trigger:</span>
            <span class="ml-2 font-medium text-gray-900"><?php echo htmlspecialchars($workflow['trigger']); ?></span>
          </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 mb-4">
          <div>
            <p class="text-xs text-gray-600">Executions</p>
            <p class="text-lg font-bold text-gray-900"><?php echo number_format($workflow['executions']); ?></p>
          </div>
          <div>
            <p class="text-xs text-gray-600">Success Rate</p>
            <p class="text-lg font-bold text-green-600"><?php echo $workflow['success_rate']; ?>%</p>
          </div>
          <div>
            <p class="text-xs text-gray-600">Last Run</p>
            <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($workflow['last_run']); ?></p>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2">
          <button onclick="viewWorkflow(<?php echo $workflow['id']; ?>)" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
            View Details
          </button>
          <button onclick="editWorkflow(<?php echo $workflow['id']; ?>)" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="edit-2" class="w-4 h-4"></i>
          </button>
          <button onclick="runWorkflow(<?php echo $workflow['id']; ?>)" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="play" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Recent Executions Tab -->
<div id="content-executions" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Workflow</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Started</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Triggered By</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
          $executions = [
            ['workflow' => 'Automated Invoice Processing', 'started' => '2 min ago', 'duration' => '1.2s', 'status' => 'Success', 'trigger' => 'Invoice #INV-2847'],
            ['workflow' => 'Sales Lead Follow-up', 'started' => '15 min ago', 'duration' => '0.8s', 'status' => 'Success', 'trigger' => 'Lead: John Doe'],
            ['workflow' => 'Customer Support Ticket Routing', 'started' => '25 min ago', 'duration' => '0.5s', 'status' => 'Success', 'trigger' => 'Ticket #1234'],
            ['workflow' => 'Expense Approval Workflow', 'started' => '30 min ago', 'duration' => '2.1s', 'status' => 'Success', 'trigger' => 'Expense #EXP-892'],
            ['workflow' => 'Inventory Reorder Alert', 'started' => '1 hour ago', 'duration' => '0.3s', 'status' => 'Success', 'trigger' => 'SKU-1234'],
            ['workflow' => 'Automated Invoice Processing', 'started' => '1 hour ago', 'duration' => '3.5s', 'status' => 'Failed', 'trigger' => 'Invoice #INV-2846'],
            ['workflow' => 'Employee Onboarding', 'started' => '3 hours ago', 'duration' => '12.8s', 'status' => 'Success', 'trigger' => 'New Employee'],
            ['workflow' => 'Sales Lead Follow-up', 'started' => '4 hours ago', 'duration' => '0.9s', 'status' => 'Success', 'trigger' => 'Lead: Jane Smith']
          ];

          foreach ($executions as $exec):
            $statusColors = [
              'Success' => 'bg-green-100 text-green-800',
              'Failed' => 'bg-red-100 text-red-800',
              'Running' => 'bg-blue-100 text-blue-800',
              'Pending' => 'bg-yellow-100 text-yellow-800'
            ];
          ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($exec['workflow']); ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo htmlspecialchars($exec['started']); ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <?php echo htmlspecialchars($exec['duration']); ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusColors[$exec['status']]; ?>">
                  <?php echo htmlspecialchars($exec['status']); ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo htmlspecialchars($exec['trigger']); ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button class="text-blue-600 hover:text-blue-900 mr-3">View Logs</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Templates Tab -->
<div id="content-templates" class="tab-content hidden">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php
    $templates = [
      ['name' => 'Invoice Approval', 'icon' => 'file-text', 'description' => 'Multi-level invoice approval workflow', 'uses' => 124],
      ['name' => 'Employee Onboarding', 'icon' => 'user-plus', 'description' => 'Complete new hire setup process', 'uses' => 89],
      ['name' => 'Lead Nurturing', 'icon' => 'target', 'description' => 'Automated sales lead follow-up', 'uses' => 201],
      ['name' => 'Expense Reports', 'icon' => 'dollar-sign', 'description' => 'Employee expense submission & approval', 'uses' => 156],
      ['name' => 'Support Escalation', 'icon' => 'alert-triangle', 'description' => 'Auto-escalate priority tickets', 'uses' => 92],
      ['name' => 'Data Backup', 'icon' => 'database', 'description' => 'Scheduled backup & notification', 'uses' => 67]
    ];

    foreach ($templates as $template):
    ?>
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center mb-4">
          <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg">
            <i data-feather="<?php echo $template['icon']; ?>" class="w-6 h-6 text-white"></i>
          </div>
          <div class="ml-4 flex-1">
            <h4 class="font-semibold text-gray-900"><?php echo htmlspecialchars($template['name']); ?></h4>
            <p class="text-xs text-gray-500"><?php echo number_format($template['uses']); ?> uses</p>
          </div>
        </div>
        <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($template['description']); ?></p>
        <button onclick="useTemplate('<?php echo htmlspecialchars($template['name']); ?>')" class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
          Use Template
        </button>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Monitoring Tab -->
<div id="content-monitoring" class="tab-content hidden">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Performance Chart -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Execution Performance</h3>
      <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
        <p class="text-gray-500">Performance chart placeholder</p>
      </div>
    </div>

    <!-- Error Rate -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Error Rate Trend</h3>
      <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
        <p class="text-gray-500">Error rate chart placeholder</p>
      </div>
    </div>

    <!-- Top Failing Workflows -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Failing Workflows</h3>
      <div class="space-y-3">
        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
          <span class="text-sm font-medium text-gray-900">Inventory Reorder Alert</span>
          <span class="text-sm font-semibold text-red-600">3.4% error rate</span>
        </div>
        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
          <span class="text-sm font-medium text-gray-900">Expense Approval Workflow</span>
          <span class="text-sm font-semibold text-yellow-600">2.6% error rate</span>
        </div>
        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
          <span class="text-sm font-medium text-gray-900">Sales Lead Follow-up</span>
          <span class="text-sm font-semibold text-yellow-600">1.8% error rate</span>
        </div>
      </div>
    </div>

    <!-- System Health -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">System Health</h3>
      <div class="space-y-4">
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Workflow Engine</span>
            <span class="text-sm font-semibold text-green-600">Healthy</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-600 h-2 rounded-full" style="width: 98%"></div>
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Queue Processing</span>
            <span class="text-sm font-semibold text-green-600">Healthy</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-600 h-2 rounded-full" style="width: 95%"></div>
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Notification Service</span>
            <span class="text-sm font-semibold text-yellow-600">Degraded</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-yellow-600 h-2 rounded-full" style="width: 78%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Tab switching
  function switchTab(tab) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(el => {
      el.classList.remove('border-blue-600', 'text-blue-600');
      el.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Activate selected tab
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-600', 'text-blue-600');
  }

  // Workflow actions
  function createWorkflow() {
    alert('Open workflow designer');
  }

  function openTemplates() {
    switchTab('templates');
  }

  function viewWorkflow(id) {
    alert('View workflow #' + id);
  }

  function editWorkflow(id) {
    alert('Edit workflow #' + id);
  }

  function runWorkflow(id) {
    alert('Run workflow #' + id);
  }

  function useTemplate(name) {
    alert('Create workflow from template: ' + name);
  }

  // Initialize Feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
?>
