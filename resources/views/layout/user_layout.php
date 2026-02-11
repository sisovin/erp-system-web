<?php
/**
 * User Layout Template
 * 
 * Usage:
 * $pageTitle = 'Dashboard';
 * $activeMenu = 'dashboard'; // dashboard, profile, settings, etc.
 * ob_start();
 * ?>
 * <!-- Your page content here -->
 * <?php
 * $content = ob_get_clean();
 * include __DIR__ . '/../layout/user_layout.php';
 */

// Default values if not set
$pageTitle = $pageTitle ?? 'Nexus ERP';
$activeMenu = $activeMenu ?? 'dashboard';
$content = $content ?? '';
$user = $user ?? null;

// Helper function to check if menu is active
function isUserMenuActive($menu, $activeMenu) {
    return $menu === $activeMenu ? 'text-white bg-primary-600' : 'text-gray-700 hover:bg-gray-100';
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
        <?php if ($user): ?>
          <!-- Authenticated User Header -->
          <!-- Logo and Mobile Menu -->
          <div class="flex items-center">
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 mr-3">
              <i data-feather="menu" class="w-6 h-6 stroke-current"></i>
            </button>
            <a href="/dashboard" class="flex items-center">
              <div class="w-10 h-10 bg-primary-600 rounded-full border-2 border-blue-600 flex items-center justify-center mr-3">
                <i data-feather="zap" class="w-6 h-6 text-white stroke-current"></i>
              </div>
              <h1 class="text-2xl font-bold text-primary-600">PEANECH ERP</h1>
            </a>
          </div>

          <!-- Header Actions -->
          <div class="flex items-center space-x-4">
            <div class="hidden md:flex items-center px-3 py-2 bg-gray-100 rounded-lg">
              <i data-feather="calendar" class="w-4 h-4 mr-2 text-gray-500 stroke-current"></i>
              <span class="text-sm text-gray-700"><?php echo date('M d, Y'); ?></span>
            </div>
            
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg relative" title="Notifications">
              <i data-feather="bell" class="w-5 h-5 stroke-current"></i>
              <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            <!-- User Profile -->
            <div class="hidden sm:flex items-center border-l border-gray-200 pl-4">
              <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-semibold">
                <?php echo strtoupper(substr($user->name, 0, 1)); ?>
              </div>
              <div class="ml-3 mr-4">
                <p class="text-sm font-medium text-gray-900"><?php echo htmlentities($user->name); ?></p>
                <p class="text-xs text-gray-500"><?php echo htmlentities($user->email); ?></p>
              </div>
            </div>

            <a href="/logout" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
              <i data-feather="log-out" class="w-4 h-4 mr-2 stroke-current"></i>
              <span class="hidden sm:inline">Logout</span>
            </a>
          </div>
        <?php else: ?>
          <!-- Public/Guest Header -->
          <!-- Left: Logo/Branding -->
          <div class="flex items-center">
            <a href="/" class="flex items-center">
              <div class="w-10 h-10 bg-primary-600 rounded-full border-2 border-blue-600 flex items-center justify-center mr-3">
                <i data-feather="zap" class="w-6 h-6 text-white stroke-current"></i>
              </div>
              <h1 class="text-2xl font-bold text-primary-600">PEANECH ERP</h1>
            </a>
          </div>

          <!-- Center: Navigation Menu (Hidden on mobile) -->
          <nav class="hidden md:flex items-center space-x-8">
            <a href="/" class="text-sm font-medium text-gray-700 hover:text-primary-600 transition">
              Home
            </a>
            <a href="/about" class="text-sm font-medium text-gray-700 hover:text-primary-600 transition">
              About
            </a>
            <a href="/contact" class="text-sm font-medium text-gray-700 hover:text-primary-600 transition">
              Contact
            </a>
          </nav>

          <!-- Right: Login & Get Started Buttons -->
          <div class="flex items-center space-x-3">
            <a href="/login" class="hidden sm:flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition">
              <i data-feather="log-in" class="w-4 h-4 mr-2 stroke-current"></i>
              Login
            </a>
            <a href="/register" class="flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-md hover:shadow-lg">
              <i data-feather="user-plus" class="w-4 h-4 mr-2 stroke-current"></i>
              Get Started Now
            </a>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn-guest" class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100">
              <i data-feather="menu" class="w-6 h-6 stroke-current"></i>
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!$user): ?>
      <!-- Mobile Navigation Menu (Guest) -->
      <div id="mobile-nav-guest" class="hidden md:hidden border-t border-gray-200 bg-white">
        <nav class="px-4 py-4 space-y-2">
          <a href="/" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
            Home
          </a>
          <a href="/about" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
            About
          </a>
          <a href="/contact" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
            Contact
          </a>
          <a href="/login" class="block px-4 py-2 text-sm font-medium text-green-700 hover:bg-green-50 rounded-lg transition">
            <i data-feather="log-in" class="w-4 h-4 mr-2 stroke-current inline"></i>
            Login
          </a>
        </nav>
      </div>
    <?php endif; ?>
  </header>

  <!-- Mobile Overlay -->
  <div id="mobile-overlay" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 hidden lg:hidden"></div>

  <!-- Scrollable Container (everything below header scrolls together) -->
  <div class="pt-16 min-h-screen">
    <?php if ($user): ?>
      <div class="flex min-h-full">
        <!-- Sidebar (Desktop) -->
        <aside id="sidebar" class="hidden lg:block w-64 bg-white shadow-lg flex-shrink-0">
          <nav class="px-4 py-6 space-y-6">
            <!-- Main Menu -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu</h3>
              <div class="space-y-1">
                <a href="/dashboard" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('dashboard', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="home" class="w-5 h-5 mr-3 stroke-current"></i>
                  Dashboard
                </a>
                <a href="/profile" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('profile', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="user" class="w-5 h-5 mr-3 stroke-current"></i>
                  My Profile
                </a>
                <a href="/tasks" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('tasks', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="check-square" class="w-5 h-5 mr-3 stroke-current"></i>
                  Tasks
                </a>
                <a href="/documents" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('documents', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="folder" class="w-5 h-5 mr-3 stroke-current"></i>
                  Documents
                </a>
              </div>
            </div>

            <!-- Reports -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Reports</h3>
              <div class="space-y-1">
                <a href="/reports/personal" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('reports-personal', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="bar-chart-2" class="w-5 h-5 mr-3 stroke-current"></i>
                  Personal Reports
                </a>
                <a href="/reports/team" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('reports-team', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="users" class="w-5 h-5 mr-3 stroke-current"></i>
                  Team Reports
                </a>
              </div>
            </div>

            <!-- Settings -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Settings</h3>
              <div class="space-y-1">
                <a href="/settings" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('settings', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="settings" class="w-5 h-5 mr-3 stroke-current"></i>
                  Preferences
                </a>
                <a href="/help" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('help', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="help-circle" class="w-5 h-5 mr-3 stroke-current"></i>
                  Help & Support
                </a>
              </div>
            </div>
          </nav>
        </aside>

        <!-- Mobile Sidebar -->
        <aside id="sidebar-mobile" class="lg:hidden fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 pt-16 overflow-y-auto">
          <nav class="px-4 py-6 space-y-6 pb-20">
            <!-- Main Menu -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu</h3>
              <div class="space-y-1">
                <a href="/dashboard" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('dashboard', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="home" class="w-5 h-5 mr-3 stroke-current"></i>
                  Dashboard
                </a>
                <a href="/profile" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('profile', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="user" class="w-5 h-5 mr-3 stroke-current"></i>
                  My Profile
                </a>
                <a href="/tasks" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('tasks', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="check-square" class="w-5 h-5 mr-3 stroke-current"></i>
                  Tasks
                </a>
                <a href="/documents" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('documents', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="folder" class="w-5 h-5 mr-3 stroke-current"></i>
                  Documents
                </a>
              </div>
            </div>

            <!-- Reports -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Reports</h3>
              <div class="space-y-1">
                <a href="/reports/personal" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('reports-personal', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="bar-chart-2" class="w-5 h-5 mr-3 stroke-current"></i>
                  Personal Reports
                </a>
                <a href="/reports/team" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('reports-team', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="users" class="w-5 h-5 mr-3 stroke-current"></i>
                  Team Reports
                </a>
              </div>
            </div>

            <!-- Settings -->
            <div>
              <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Settings</h3>
              <div class="space-y-1">
                <a href="/settings" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('settings', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="settings" class="w-5 h-5 mr-3 stroke-current"></i>
                  Preferences
                </a>
                <a href="/help" class="flex items-center px-4 py-3 text-sm font-medium <?php echo isUserMenuActive('help', $activeMenu); ?> rounded-lg transition">
                  <i data-feather="help-circle" class="w-5 h-5 mr-3 stroke-current"></i>
                  Help & Support
                </a>
              </div>
            </div>
          </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1">
          <div class="px-4 sm:px-6 lg:px-8 py-8">
            <?php echo $content; ?>
          </div>         
        </main>
      </div>
    <?php else: ?>
      <!-- No sidebar for non-logged-in users -->
      <main class="min-h-screen">
        <?php echo $content; ?>
      </main>
    <?php endif; ?>
  </div>

  <!-- Comprehensive Footer -->
  <footer class="bg-gradient-to-br from-gray-50 to-gray-100 border-t border-gray-200">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
        <!-- Logo & Description -->
        <div class="lg:col-span-2">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-primary-600 rounded-full border-2 border-blue-600 flex items-center justify-center mr-3">
              <i data-feather="zap" class="w-7 h-7 text-white stroke-current"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">PEANECH ERP</h2>
          </div>
          <p class="text-sm text-gray-600 mb-6 max-w-sm">
            Streamline your business operations with our comprehensive Enterprise Resource Planning solution. 
            Manage HR, inventory, sales, and accounting all in one place.
          </p>
          
          <!-- Social Media Links -->
          <div class="flex items-center space-x-4">
            <a href="#" class="w-10 h-10 bg-white rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-600 hover:text-white hover:border-primary-600 transition" title="Facebook">
              <i data-feather="facebook" class="w-5 h-5 stroke-current"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-600 hover:text-white hover:border-primary-600 transition" title="Twitter">
              <i data-feather="twitter" class="w-5 h-5 stroke-current"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-600 hover:text-white hover:border-primary-600 transition" title="LinkedIn">
              <i data-feather="linkedin" class="w-5 h-5 stroke-current"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-white rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-600 hover:text-white hover:border-primary-600 transition" title="GitHub">
              <i data-feather="github" class="w-5 h-5 stroke-current"></i>
            </a>
          </div>
        </div>

        <!-- Product Links -->
        <div>
          <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Product</h3>
          <ul class="space-y-3">
            <li>
              <a href="/features" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Features
              </a>
            </li>
            <li>
              <a href="/pricing" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Pricing
              </a>
            </li>
            <li>
              <a href="/demo" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Request Demo
              </a>
            </li>
            <li>
              <a href="/integrations" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Integrations
              </a>
            </li>
          </ul>
        </div>

        <!-- Company Links -->
        <div>
          <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Company</h3>
          <ul class="space-y-3">
            <li>
              <a href="/about" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                About Us
              </a>
            </li>
            <li>
              <a href="/careers" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Careers
              </a>
            </li>
            <li>
              <a href="/blog" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Blog
              </a>
            </li>
            <li>
              <a href="/contact" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Contact
              </a>
            </li>
          </ul>
        </div>

        <!-- Support & Legal -->
        <div>
          <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Support</h3>
          <ul class="space-y-3">
            <li>
              <a href="/help" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Help Center
              </a>
            </li>
            <li>
              <a href="/documentation" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                Documentation
              </a>
            </li>
            <li>
              <a href="/api" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                API Reference
              </a>
            </li>
            <li>
              <a href="/status" class="text-sm text-gray-600 hover:text-primary-600 transition flex items-center">
                <i data-feather="chevron-right" class="w-4 h-4 mr-1 stroke-current"></i>
                System Status
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Newsletter Section -->
      <div class="mt-12 pt-8 border-t border-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Stay updated with our newsletter</h3>
            <p class="text-sm text-gray-600">Get the latest updates, tips, and exclusive offers delivered to your inbox.</p>
          </div>
          <div>
            <form class="flex flex-col sm:flex-row gap-3">
              <div class="flex-1">
                <input 
                  type="email" 
                  placeholder="Enter your email" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                  required
                >
              </div>
              <button 
                type="submit" 
                class="px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-md hover:shadow-lg flex items-center justify-center"
              >
                <i data-feather="send" class="w-4 h-4 mr-2 stroke-current"></i>
                Subscribe
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bg-gray-900 text-gray-400">
      <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
          <div class="text-sm">
            &copy; <?php echo date('Y'); ?> <span class="font-semibold text-white">PEANECH ERP by <a href="https://peanech.online">PEANECH TEAM</a></span>. All rights reserved.
          </div>
          <div class="flex items-center space-x-6 text-sm">
            <a href="/terms" class="hover:text-white transition">Terms of Service</a>
            <span class="text-gray-600">•</span>
            <a href="/privacy" class="hover:text-white transition">Privacy Policy</a>
            <span class="text-gray-600">•</span>
            <a href="/cookies" class="hover:text-white transition">Cookie Policy</a>
            <span class="text-gray-600">•</span>
            <a href="/sitemap" class="hover:text-white transition">Sitemap</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Initialize Feather icons
    feather.replace({ 
      stroke: 'currentColor',
      'stroke-width': 2 
    });

    // Mobile menu toggle (authenticated users)
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebarMobile = document.getElementById('sidebar-mobile');
    const mobileOverlay = document.getElementById('mobile-overlay');

    if (mobileMenuBtn && sidebarMobile && mobileOverlay) {
      mobileMenuBtn.addEventListener('click', () => {
        sidebarMobile.classList.toggle('-translate-x-full');
        mobileOverlay.classList.toggle('hidden');
      });

      mobileOverlay.addEventListener('click', () => {
        sidebarMobile.classList.add('-translate-x-full');
        mobileOverlay.classList.add('hidden');
      });
    }

    // Mobile navigation toggle (guest users)
    const mobileMenuBtnGuest = document.getElementById('mobile-menu-btn-guest');
    const mobileNavGuest = document.getElementById('mobile-nav-guest');

    if (mobileMenuBtnGuest && mobileNavGuest) {
      mobileMenuBtnGuest.addEventListener('click', () => {
        mobileNavGuest.classList.toggle('hidden');
      });
    }
  </script>
</body>
</html>
