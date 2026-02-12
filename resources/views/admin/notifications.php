<?php
$pageTitle = 'Notifications Center';
$activeMenu = 'notifications';

ob_start();
?>

<!-- Header with Actions -->
<div class="mb-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Notifications Center</h1>
      <p class="mt-2 text-sm text-gray-600">Manage system alerts, updates, and user notifications</p>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="markAllRead()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="check-circle" class="w-4 h-4 mr-2"></i>
        Mark All Read
      </button>
      <button onclick="clearAll()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="trash-2" class="w-4 h-4 mr-2"></i>
        Clear All
      </button>
      <button onclick="openSettings()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="settings" class="w-4 h-4 mr-2"></i>
        Settings
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Notifications -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-blue-100 rounded-lg">
        <i data-feather="bell" class="w-6 h-6 text-blue-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full">Total</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">247</h3>
    <p class="text-sm text-gray-600 mt-1">Total Notifications</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">+32 today</span>
    </div>
  </div>

  <!-- Unread -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-red-100 rounded-lg">
        <i data-feather="alert-circle" class="w-6 h-6 text-red-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-red-100 text-red-800 rounded-full">Unread</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">42</h3>
    <p class="text-sm text-gray-600 mt-1">Unread Messages</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-red-600 font-medium">Needs attention</span>
    </div>
  </div>

  <!-- Critical Alerts -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-yellow-100 rounded-lg">
        <i data-feather="alert-triangle" class="w-6 h-6 text-yellow-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-yellow-100 text-yellow-800 rounded-full">Critical</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">8</h3>
    <p class="text-sm text-gray-600 mt-1">Critical Alerts</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-yellow-600 font-medium">Urgent action required</span>
    </div>
  </div>

  <!-- System Updates -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-green-100 rounded-lg">
        <i data-feather="info" class="w-6 h-6 text-green-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Updates</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">15</h3>
    <p class="text-sm text-gray-600 mt-1">System Updates</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">3 pending</span>
    </div>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8 overflow-x-auto">
      <button onclick="switchTab('all')" id="tab-all" class="tab-button border-b-2 border-blue-600 text-blue-600 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="list" class="w-4 h-4 mr-2"></i>
        All (247)
      </button>
      <button onclick="switchTab('unread')" id="tab-unread" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="bell" class="w-4 h-4 mr-2"></i>
        Unread (42)
      </button>
      <button onclick="switchTab('critical')" id="tab-critical" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="alert-triangle" class="w-4 h-4 mr-2"></i>
        Critical (8)
      </button>
      <button onclick="switchTab('system')" id="tab-system" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="server" class="w-4 h-4 mr-2"></i>
        System (15)
      </button>
      <button onclick="switchTab('archived')" id="tab-archived" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="archive" class="w-4 h-4 mr-2"></i>
        Archived
      </button>
    </nav>
  </div>
</div>

<!-- All Notifications Tab -->
<div id="content-all" class="tab-content">
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
    <?php
    $notifications = [
      [
        'id' => 1,
        'type' => 'critical',
        'icon' => 'alert-triangle',
        'color' => 'red',
        'title' => 'Security Alert: Multiple Failed Login Attempts',
        'message' => 'User account "admin@example.com" has experienced 5 failed login attempts from IP 203.0.113.45',
        'time' => '5 minutes ago',
        'read' => false,
        'actions' => true
      ],
      [
        'id' => 2,
        'type' => 'warning',
        'icon' => 'alert-circle',
        'color' => 'yellow',
        'title' => 'Low Disk Space Warning',
        'message' => 'Server storage is at 87% capacity. Consider cleaning up old backups or expanding storage.',
        'time' => '15 minutes ago',
        'read' => false,
        'actions' => true
      ],
      [
        'id' => 3,
        'type' => 'success',
        'icon' => 'check-circle',
        'color' => 'green',
        'title' => 'Backup Completed Successfully',
        'message' => 'Daily database backup completed. Backup size: 2.3 GB. Uploaded to S3: nexus-erp-backups.',
        'time' => '1 hour ago',
        'read' => true,
        'actions' => false
      ],
      [
        'id' => 4,
        'type' => 'info',
        'icon' => 'user-plus',
        'color' => 'blue',
        'title' => 'New User Registration',
        'message' => 'Sarah Johnson (sarah.j@example.com) has registered for an account and requires approval.',
        'time' => '2 hours ago',
        'read' => false,
        'actions' => true
      ],
      [
        'id' => 5,
        'type' => 'info',
        'icon' => 'mail',
        'color' => 'purple',
        'title' => 'Scheduled Export Report Sent',
        'message' => 'Monthly audit export has been generated and sent to 3 recipients.',
        'time' => '3 hours ago',
        'read' => true,
        'actions' => false
      ],
      [
        'id' => 6,
        'type' => 'warning',
        'icon' => 'trending-up',
        'color' => 'orange',
        'title' => 'High CPU Usage Detected',
        'message' => 'Server CPU usage has exceeded 80% for the past 15 minutes. Current usage: 92%.',
        'time' => '4 hours ago',
        'read' => false,
        'actions' => true
      ],
      [
        'id' => 7,
        'type' => 'success',
        'icon' => 'upload-cloud',
        'color' => 'green',
        'title' => 'Export Uploaded to S3',
        'message' => 'File "audit_export_20260212.csv" successfully uploaded to Amazon S3.',
        'time' => '5 hours ago',
        'read' => true,
        'actions' => false
      ],
      [
        'id' => 8,
        'type' => 'info',
        'icon' => 'refresh-cw',
        'color' => 'blue',
        'title' => 'System Update Available',
        'message' => 'Nexus ERP v2.5.0 is now available. Includes security patches and new features.',
        'time' => '1 day ago',
        'read' => true,
        'actions' => true
      ],
      [
        'id' => 9,
        'type' => 'critical',
        'icon' => 'shield-off',
        'color' => 'red',
        'title' => 'SSL Certificate Expiring Soon',
        'message' => 'SSL certificate for nexuserp.com will expire in 15 days. Renew to maintain security.',
        'time' => '1 day ago',
        'read' => false,
        'actions' => true
      ],
      [
        'id' => 10,
        'type' => 'success',
        'icon' => 'zap',
        'color' => 'green',
        'title' => 'Workflow Execution Completed',
        'message' => 'Automated invoice processing workflow completed successfully. Processed 47 invoices.',
        'time' => '2 days ago',
        'read' => true,
        'actions' => false
      ]
    ];

    foreach ($notifications as $notif):
      $bgClass = $notif['read'] ? 'bg-white' : 'bg-blue-50';
    ?>
      <div class="p-6 hover:bg-gray-50 transition <?php echo $bgClass; ?>">
        <div class="flex items-start gap-4">
          <!-- Icon -->
          <div class="flex-shrink-0">
            <div class="p-3 bg-<?php echo $notif['color']; ?>-100 rounded-lg">
              <i data-feather="<?php echo $notif['icon']; ?>" class="w-5 h-5 text-<?php echo $notif['color']; ?>-600"></i>
            </div>
          </div>

          <!-- Content -->
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                  <h3 class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($notif['title']); ?></h3>
                  <?php if (!$notif['read']): ?>
                    <span class="flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                  <?php endif; ?>
                </div>
                <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($notif['message']); ?></p>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                  <span class="flex items-center">
                    <i data-feather="clock" class="w-3 h-3 mr-1"></i>
                    <?php echo htmlspecialchars($notif['time']); ?>
                  </span>
                  <span class="text-<?php echo $notif['color']; ?>-600 font-medium uppercase"><?php echo htmlspecialchars($notif['type']); ?></span>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex items-center gap-2">
                <?php if ($notif['actions']): ?>
                  <button onclick="viewNotification(<?php echo $notif['id']; ?>)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="View Details">
                    <i data-feather="eye" class="w-4 h-4"></i>
                  </button>
                <?php endif; ?>
                <?php if (!$notif['read']): ?>
                  <button onclick="markRead(<?php echo $notif['id']; ?>)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Mark as Read">
                    <i data-feather="check" class="w-4 h-4"></i>
                  </button>
                <?php endif; ?>
                <button onclick="archiveNotification(<?php echo $notif['id']; ?>)" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Archive">
                  <i data-feather="archive" class="w-4 h-4"></i>
                </button>
                <button onclick="deleteNotification(<?php echo $notif['id']; ?>)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                  <i data-feather="trash-2" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <div class="mt-6 flex items-center justify-between">
    <p class="text-sm text-gray-600">Showing 1 to 10 of 247 notifications</p>
    <div class="flex gap-2">
      <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition disabled:opacity-50" disabled>
        <i data-feather="chevron-left" class="w-4 h-4"></i>
      </button>
      <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">1</button>
      <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">2</button>
      <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">3</button>
      <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
        <i data-feather="chevron-right" class="w-4 h-4"></i>
      </button>
    </div>
  </div>
</div>

<!-- Unread Notifications Tab -->
<div id="content-unread" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="text-center py-12">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
        <i data-feather="bell" class="w-8 h-8 text-blue-600"></i>
      </div>
      <h3 class="text-lg font-semibold text-gray-900 mb-2">42 Unread Notifications</h3>
      <p class="text-gray-600 mb-6">Filter showing only unread items</p>
      <button onclick="switchTab('all')" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
        View All Notifications
      </button>
    </div>
  </div>
</div>

<!-- Critical Alerts Tab -->
<div id="content-critical" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
    <?php
    $criticalAlerts = [
      [
        'title' => 'Security Alert: Multiple Failed Login Attempts',
        'message' => 'User account "admin@example.com" has experienced 5 failed login attempts',
        'time' => '5 minutes ago',
        'severity' => 'High'
      ],
      [
        'title' => 'SSL Certificate Expiring Soon',
        'message' => 'SSL certificate for nexuserp.com will expire in 15 days',
        'time' => '1 day ago',
        'severity' => 'High'
      ],
      [
        'title' => 'Database Connection Timeout',
        'message' => 'Database experienced connection timeout. Automatically recovered.',
        'time' => '2 days ago',
        'severity' => 'Medium'
      ]
    ];

    foreach ($criticalAlerts as $alert):
    ?>
      <div class="p-6 hover:bg-red-50 transition">
        <div class="flex items-start gap-4">
          <div class="p-3 bg-red-100 rounded-lg">
            <i data-feather="alert-triangle" class="w-5 h-5 text-red-600"></i>
          </div>
          <div class="flex-1">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($alert['title']); ?></h3>
              <span class="text-xs font-semibold px-2.5 py-1 bg-red-100 text-red-800 rounded-full"><?php echo htmlspecialchars($alert['severity']); ?></span>
            </div>
            <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($alert['message']); ?></p>
            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($alert['time']); ?></p>
          </div>
          <button class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
            Investigate
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- System Updates Tab -->
<div id="content-system" class="tab-content hidden">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php
    $systemUpdates = [
      ['title' => 'System Update v2.5.0 Available', 'icon' => 'package', 'color' => 'blue', 'date' => '1 day ago'],
      ['title' => 'Security Patch Applied', 'icon' => 'shield', 'color' => 'green', 'date' => '3 days ago'],
      ['title' => 'Database Optimization Complete', 'icon' => 'database', 'color' => 'purple', 'date' => '5 days ago'],
      ['title' => 'Cache System Upgraded', 'icon' => 'zap', 'color' => 'yellow', 'date' => '1 week ago'],
      ['title' => 'Backup System Configured', 'icon' => 'hard-drive', 'color' => 'indigo', 'date' => '1 week ago'],
      ['title' => 'SSL Certificate Renewed', 'icon' => 'lock', 'color' => 'green', 'date' => '2 weeks ago']
    ];

    foreach ($systemUpdates as $update):
    ?>
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center gap-4 mb-4">
          <div class="p-3 bg-<?php echo $update['color']; ?>-100 rounded-lg">
            <i data-feather="<?php echo $update['icon']; ?>" class="w-6 h-6 text-<?php echo $update['color']; ?>-600"></i>
          </div>
          <div class="flex-1">
            <h3 class="font-semibold text-gray-900"><?php echo htmlspecialchars($update['title']); ?></h3>
            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($update['date']); ?></p>
          </div>
        </div>
        <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition">
          View Details
        </button>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Archived Tab -->
<div id="content-archived" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="text-center py-12">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
        <i data-feather="archive" class="w-8 h-8 text-gray-600"></i>
      </div>
      <h3 class="text-lg font-semibold text-gray-900 mb-2">No Archived Notifications</h3>
      <p class="text-gray-600">Archived notifications will appear here</p>
    </div>
  </div>
</div>

<script>
  // Tab switching
  function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-button').forEach(el => {
      el.classList.remove('border-blue-600', 'text-blue-600');
      el.classList.add('border-transparent', 'text-gray-500');
    });
    
    document.getElementById('content-' + tab).classList.remove('hidden');
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-600', 'text-blue-600');
  }

  // Notification actions
  function markAllRead() {
    if (confirm('Mark all notifications as read?')) {
      alert('All notifications marked as read');
      location.reload();
    }
  }

  function clearAll() {
    if (confirm('Clear all notifications? This cannot be undone.')) {
      alert('All notifications cleared');
      location.reload();
    }
  }

  function openSettings() {
    window.location.href = '/admin/settings';
  }

  function viewNotification(id) {
    alert('View notification #' + id);
  }

  function markRead(id) {
    alert('Marked notification #' + id + ' as read');
    location.reload();
  }

  function archiveNotification(id) {
    alert('Archived notification #' + id);
    location.reload();
  }

  function deleteNotification(id) {
    if (confirm('Delete this notification?')) {
      alert('Deleted notification #' + id);
      location.reload();
    }
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
