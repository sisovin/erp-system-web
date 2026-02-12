<?php
/**
 * Admin Layout Template
 * 
 * Usage:
 * $pageTitle = 'Dashboard';
 * $activeMenu = 'dashboard'; // dashboard, users, roles, audits, settings, etc.
 * ob_start();
 * ?>
 * <!-- Your page content here -->
 * <?php
 * $content = ob_get_clean();
 * include __DIR__ . '/../layout/admin_layout.php';
 */

// Default values if not set
$pageTitle = $pageTitle ?? 'Admin';
$activeMenu = $activeMenu ?? 'dashboard';
$content = $content ?? '';
$user = $user ?? null;

// Helper function to check if menu is active
function isActive($menu, $activeMenu) {
    return $menu === $activeMenu ? 'text-white bg-gradient-to-r from-blue-600 to-purple-600' : 'text-gray-700 hover:bg-gray-100';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?php echo htmlentities($pageTitle); ?> - Nexus ERP</title>
  <link href="/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-50">
  <!-- Fixed Header -->
  <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo and Mobile Menu -->
        <div class="flex items-center">
          <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 mr-3">
            <i data-feather="menu" class="w-6 h-6 stroke-current"></i>
          </button>
          <h1 class="text-2xl font-bold text-blue-600">PEANECH ERP</h1>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center space-x-4">
          <div class="hidden md:flex items-center px-3 py-2 bg-gray-100 rounded-lg">
            <i data-feather="calendar" class="w-4 h-4 mr-2 text-gray-500 stroke-current"></i>
            <span class="text-sm text-gray-700"><?php echo date('M d, Y'); ?></span>
          </div>
          
          <!-- Notifications Dropdown -->
          <div class="relative">
            <button id="notifications-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg relative" title="Notifications">
              <i data-feather="bell" class="w-5 h-5 stroke-current"></i>
              <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-semibold rounded-full flex items-center justify-center">42</span>
            </button>

            <!-- Dropdown Menu -->
            <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
              <!-- Header -->
              <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                <div class="flex items-center space-x-2">
                  <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">42 Unread</span>
                  <button class="text-xs text-blue-600 hover:text-blue-700 font-medium">Mark all read</button>
                </div>
              </div>

              <!-- Notifications List -->
              <div class="max-h-96 overflow-y-auto">
                <!-- Notification Item 1 - Critical -->
                <a href="/admin/notifications" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-red-500 rounded-full animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between">
                        <p class="text-sm font-medium text-gray-900">System Security Alert</p>
                        <span class="text-xs text-gray-500">2m ago</span>
                      </div>
                      <p class="text-sm text-gray-600 mt-1">Multiple failed login attempts detected from IP 203.0.113.45</p>
                      <div class="flex items-center mt-2">
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Critical</span>
                      </div>
                    </div>
                  </div>
                </a>

                <!-- Notification Item 2 - Warning -->
                <a href="/admin/notifications" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between">
                        <p class="text-sm font-medium text-gray-900">Database Backup Completed</p>
                        <span class="text-xs text-gray-500">15m ago</span>
                      </div>
                      <p class="text-sm text-gray-600 mt-1">Scheduled backup completed successfully. Size: 2.4 GB</p>
                      <div class="flex items-center mt-2">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Success</span>
                      </div>
                    </div>
                  </div>
                </a>

                <!-- Notification Item 3 - Info -->
                <a href="/admin/notifications" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between">
                        <p class="text-sm font-medium text-gray-900">New User Registration</p>
                        <span class="text-xs text-gray-500">1h ago</span>
                      </div>
                      <p class="text-sm text-gray-600 mt-1">Sarah Johnson has registered and is awaiting approval</p>
                      <div class="flex items-center mt-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Info</span>
                      </div>
                    </div>
                  </div>
                </a>

                <!-- Notification Item 4 - Warning -->
                <a href="/admin/notifications" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-yellow-500 rounded-full animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between">
                        <p class="text-sm font-medium text-gray-900">Storage Quota Warning</p>
                        <span class="text-xs text-gray-500">3h ago</span>
                      </div>
                      <p class="text-sm text-gray-600 mt-1">Database storage is at 85% capacity (42.5 GB / 50 GB)</p>
                      <div class="flex items-center mt-2">
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">Warning</span>
                      </div>
                    </div>
                  </div>
                </a>

                <!-- Notification Item 5 - Success -->
                <a href="/admin/notifications" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition">
                  <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-start justify-between">
                        <p class="text-sm font-medium text-gray-900">Workflow Execution Complete</p>
                        <span class="text-xs text-gray-500">5h ago</span>
                      </div>
                      <p class="text-sm text-gray-600 mt-1">Employee Onboarding workflow completed for 3 new hires</p>
                      <div class="flex items-center mt-2">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Success</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Footer -->
              <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                <a href="/admin/notifications" class="block text-center text-sm font-medium text-blue-600 hover:text-blue-700">
                  View All Notifications
                </a>
              </div>
            </div>
          </div>

          <?php if ($user): ?>
          <!-- User Profile -->
          <div class="hidden sm:flex items-center border-l border-gray-200 pl-4">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
              <?php echo strtoupper(substr($user->name, 0, 1)); ?>
            </div>
            <div class="ml-3 mr-4">
              <p class="text-sm font-medium text-gray-900"><?php echo htmlentities($user->name); ?></p>
              <p class="text-xs text-gray-500"><?php echo htmlentities($user->email); ?></p>
            </div>
          </div>
          <?php endif; ?>

          <a href="/logout" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
            <i data-feather="log-out" class="w-4 h-4 mr-2 stroke-current"></i>
            <span class="hidden sm:inline">Logout</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Overlay -->
  <div id="mobile-overlay" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 hidden lg:hidden"></div>

  <!-- Scrollable Container (everything below header scrolls together) -->
  <div class="pt-16 h-screen overflow-y-auto">
    <div class="flex min-h-full">
      <!-- Sidebar (scrolls with content) -->
      <aside id="sidebar" class="hidden lg:block w-64 bg-white shadow-lg flex-shrink-0">
        <nav class="px-4 py-6 space-y-6">
          <!-- Main Menu -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Main Menu</h3>
            <div class="space-y-1">
              <a href="/admin" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('dashboard', $activeMenu); ?> rounded-lg transition">
                <i data-feather="home" class="w-5 h-5 mr-3 stroke-current"></i>
                Dashboard
              </a>
              <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('users', $activeMenu); ?> rounded-lg transition">
                <i data-feather="users" class="w-5 h-5 mr-3 stroke-current"></i>
                Users
              </a>
              <a href="/admin/roles" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('roles', $activeMenu); ?> rounded-lg transition">
                <i data-feather="shield" class="w-5 h-5 mr-3 stroke-current"></i>
                Roles & Permissions
              </a>
              <a href="/admin/departments" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('departments', $activeMenu); ?> rounded-lg transition">
                <i data-feather="briefcase" class="w-5 h-5 mr-3 stroke-current"></i>
                Departments
              </a>
            </div>
          </div>

          <!-- Monitoring -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Monitoring</h3>
            <div class="space-y-1">
              <a href="/admin/audits" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('audits', $activeMenu); ?> rounded-lg transition">
                <i data-feather="file-text" class="w-5 h-5 mr-3 stroke-current"></i>
                Audit Logs
              </a>
              <a href="/admin/activity" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('activity', $activeMenu); ?> rounded-lg transition">
                <i data-feather="activity" class="w-5 h-5 mr-3 stroke-current"></i>
                Activity Monitor
              </a>
              <a href="/admin/reports" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('reports', $activeMenu); ?> rounded-lg transition">
                <i data-feather="bar-chart-2" class="w-5 h-5 mr-3 stroke-current"></i>
                Reports
              </a>
            </div>
          </div>

          <!-- Automation -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Automation</h3>
            <div class="space-y-1">
              <a href="/admin/scheduled-exports" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('scheduled-exports', $activeMenu); ?> rounded-lg transition">
                <i data-feather="clock" class="w-5 h-5 mr-3 stroke-current"></i>
                Scheduled Exports
              </a>
              <a href="/admin/jobs" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('jobs', $activeMenu); ?> rounded-lg transition">
                <i data-feather="cpu" class="w-5 h-5 mr-3 stroke-current"></i>
                Background Jobs
              </a>
              <a href="/admin/workflows" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('workflows', $activeMenu); ?> rounded-lg transition">
                <i data-feather="git-branch" class="w-5 h-5 mr-3 stroke-current"></i>
                Workflows
              </a>
            </div>
          </div>

          <!-- System -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">System</h3>
            <div class="space-y-1">
              <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('settings', $activeMenu); ?> rounded-lg transition">
                <i data-feather="settings" class="w-5 h-5 mr-3 stroke-current"></i>
                Settings
              </a>
              <a href="/admin/notifications" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('notifications', $activeMenu); ?> rounded-lg transition">
                <i data-feather="bell" class="w-5 h-5 mr-3 stroke-current"></i>
                Notifications
              </a>
              <a href="/admin/integrations" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('integrations', $activeMenu); ?> rounded-lg transition">
                <i data-feather="share-2" class="w-5 h-5 mr-3 stroke-current"></i>
                Integrations
              </a>
              <a href="/admin/database" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('database', $activeMenu); ?> rounded-lg transition">
                <i data-feather="database" class="w-5 h-5 mr-3 stroke-current"></i>
                Database
              </a>
            </div>
          </div>

          <!-- Help & Support -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Help & Support</h3>
            <div class="space-y-1">
              <a href="/admin/documentation" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('documentation', $activeMenu); ?> rounded-lg transition">
                <i data-feather="book-open" class="w-5 h-5 mr-3 stroke-current"></i>
                Documentation
              </a>
              <a href="/admin/support" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('support', $activeMenu); ?> rounded-lg transition">
                <i data-feather="help-circle" class="w-5 h-5 mr-3 stroke-current"></i>
                Support
              </a>
            </div>
          </div>
        </nav>
      </aside>

      <!-- Mobile Sidebar (fixed position for mobile) -->
      <aside id="sidebar-mobile" class="lg:hidden fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 pt-16 overflow-y-auto">
        <nav class="px-4 py-6 space-y-6 pb-20">
          <!-- Main Menu -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Main Menu</h3>
            <div class="space-y-1">
              <a href="/admin" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('dashboard', $activeMenu); ?> rounded-lg transition">
                <i data-feather="home" class="w-5 h-5 mr-3 stroke-current"></i>
                Dashboard
              </a>
              <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('users', $activeMenu); ?> rounded-lg transition">
                <i data-feather="users" class="w-5 h-5 mr-3 stroke-current"></i>
                Users
              </a>
              <a href="/admin/roles" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('roles', $activeMenu); ?> rounded-lg transition">
                <i data-feather="shield" class="w-5 h-5 mr-3 stroke-current"></i>
                Roles & Permissions
              </a>
              <a href="/admin/departments" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('departments', $activeMenu); ?> rounded-lg transition">
                <i data-feather="briefcase" class="w-5 h-5 mr-3 stroke-current"></i>
                Departments
              </a>
            </div>
          </div>

          <!-- Monitoring -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Monitoring</h3>
            <div class="space-y-1">
              <a href="/admin/audits" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('audits', $activeMenu); ?> rounded-lg transition">
                <i data-feather="file-text" class="w-5 h-5 mr-3 stroke-current"></i>
                Audit Logs
              </a>
              <a href="/admin/activity" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('activity', $activeMenu); ?> rounded-lg transition">
                <i data-feather="activity" class="w-5 h-5 mr-3 stroke-current"></i>
                Activity Monitor
              </a>
              <a href="/admin/reports" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('reports', $activeMenu); ?> rounded-lg transition">
                <i data-feather="bar-chart-2" class="w-5 h-5 mr-3 stroke-current"></i>
                Reports
              </a>
            </div>
          </div>

          <!-- Automation -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Automation</h3>
            <div class="space-y-1">
              <a href="/admin/scheduled-exports" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('scheduled-exports', $activeMenu); ?> rounded-lg transition">
                <i data-feather="clock" class="w-5 h-5 mr-3 stroke-current"></i>
                Scheduled Exports
              </a>
              <a href="/admin/jobs" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('jobs', $activeMenu); ?> rounded-lg transition">
                <i data-feather="cpu" class="w-5 h-5 mr-3 stroke-current"></i>
                Background Jobs
              </a>
              <a href="/admin/workflows" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('workflows', $activeMenu); ?> rounded-lg transition">
                <i data-feather="git-branch" class="w-5 h-5 mr-3 stroke-current"></i>
                Workflows
              </a>
            </div>
          </div>

          <!-- System -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">System</h3>
            <div class="space-y-1">
              <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('settings', $activeMenu); ?> rounded-lg transition">
                <i data-feather="settings" class="w-5 h-5 mr-3 stroke-current"></i>
                Settings
              </a>
              <a href="/admin/notifications" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('notifications', $activeMenu); ?> rounded-lg transition">
                <i data-feather="bell" class="w-5 h-5 mr-3 stroke-current"></i>
                Notifications
              </a>
              <a href="/admin/integrations" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('integrations', $activeMenu); ?> rounded-lg transition">
                <i data-feather="share-2" class="w-5 h-5 mr-3 stroke-current"></i>
                Integrations
              </a>
              <a href="/admin/database" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('database', $activeMenu); ?> rounded-lg transition">
                <i data-feather="database" class="w-5 h-5 mr-3 stroke-current"></i>
                Database
              </a>
            </div>
          </div>

          <!-- Help & Support -->
          <div>
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Help & Support</h3>
            <div class="space-y-1">
              <a href="/admin/documentation" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('documentation', $activeMenu); ?> rounded-lg transition">
                <i data-feather="book-open" class="w-5 h-5 mr-3 stroke-current"></i>
                Documentation
              </a>
              <a href="/admin/support" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isActive('support', $activeMenu); ?> rounded-lg transition">
                <i data-feather="help-circle" class="w-5 h-5 mr-3 stroke-current"></i>
                Support
              </a>
            </div>
          </div>
        </nav>
      </aside>

      <!-- Main Content Area (scrolls with sidebar) -->
      <main class="flex-1">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
          <?php echo $content; ?>

          <!-- Footer -->
          <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
              <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-sm text-gray-500">
                  &copy; <?php echo date('Y'); ?> Nexus ERP. All rights reserved.
                </div>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                  <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Documentation</a>
                  <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Support</a>
                  <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Privacy Policy</a>
                  <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Terms of Service</a>
                </div>
              </div>
              <div class="mt-4 text-xs text-gray-400 text-center md:text-left">
                Version 1.0.0 | Last updated: <?php echo date('F j, Y'); ?>
              </div>
            </div>
          </footer>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Initialize Feather icons
    feather.replace({ 
      stroke: 'currentColor',
      'stroke-width': 2 
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebarMobile = document.getElementById('sidebar-mobile');
    const mobileOverlay = document.getElementById('mobile-overlay');

    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', () => {
        sidebarMobile.classList.toggle('-translate-x-full');
        mobileOverlay.classList.toggle('hidden');
      });
    }

    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', () => {
        sidebarMobile.classList.add('-translate-x-full');
        mobileOverlay.classList.add('hidden');
      });
    }

    // Notifications dropdown toggle
    const notificationsBtn = document.getElementById('notifications-btn');
    const notificationsDropdown = document.getElementById('notifications-dropdown');

    if (notificationsBtn && notificationsDropdown) {
      // Toggle dropdown on button click
      notificationsBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationsDropdown.classList.toggle('hidden');
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', (e) => {
        if (!notificationsBtn.contains(e.target) && !notificationsDropdown.contains(e.target)) {
          notificationsDropdown.classList.add('hidden');
        }
      });

      // Prevent dropdown from closing when clicking inside it
      notificationsDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  </script>

  <!-- App.js - Client-side utilities -->
  <script src="/js/app.js"></script>
</body>
</html>
