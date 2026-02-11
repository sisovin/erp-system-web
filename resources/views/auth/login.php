<?php
$pageTitle = 'Login';
$activeMenu = '';
ob_start();
?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 via-white to-blue-50 px-4 sm:px-6 lg:px-8 py-12">
  <div class="max-w-6xl w-full space-y-8">
    <!-- Logo and Header -->
    <div class="text-center">
      <div class="mx-auto h-16 w-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary-600/20">
        <i data-feather="zap" class="w-8 h-8 text-white stroke-current"></i>
      </div>
      <h2 class="text-4xl font-bold text-gray-900 mb-2">PEANECH ERP</h2>
      <p class="text-sm text-gray-600">Connect. Manage. Grow.</p>
    </div>

    <!-- Error Messages -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start max-w-4xl mx-auto">
        <i data-feather="alert-circle" class="w-5 h-5 text-red-600 mr-3 mt-0.5 stroke-current"></i>
        <p class="text-sm text-red-800"><?php echo htmlentities($error); ?></p>
      </div>
    <?php endif; ?>

    <?php // flash messages (other keys)
          $flashes = flash_pop_all();
          foreach ($flashes as $k => $m): ?>
      <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start max-w-4xl mx-auto">
        <i data-feather="alert-circle" class="w-5 h-5 text-red-600 mr-3 mt-0.5 stroke-current"></i>
        <p class="text-sm text-red-800"><?php echo htmlentities($m); ?></p>
      </div>
    <?php endforeach; ?>

    <!-- Two Column Login Card -->
    <div class="card max-w-4xl mx-auto">
      <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Sign in to your account</h3>
      
      <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
        <!-- Desktop Divider (absolute positioned in gap) -->
        <div class="hidden md:block absolute left-1/2 top-0 bottom-0 -ml-px">
          <div class="h-full w-px bg-gray-200"></div>
          <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-3 py-1.5">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">OR</span>
          </div>
        </div>
        
        <!-- Left Column: Social Media Sign-in -->
        <div class="space-y-4">
          <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Social Sign-in</h4>
            <p class="text-sm text-gray-600">Choose your preferred platform</p>
          </div>
          
          <div class="space-y-3">
            <!-- Google -->
            <button type="button" onclick="socialLogin('google')" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md group">
              <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
              </svg>
              <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Continue with Google</span>
            </button>

            <!-- Microsoft -->
            <button type="button" onclick="socialLogin('microsoft')" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md group">
              <svg class="w-5 h-5 mr-3" viewBox="0 0 23 23">
                <path fill="#f35325" d="M0 0h11v11H0z"/>
                <path fill="#81bc06" d="M12 0h11v11H12z"/>
                <path fill="#05a6f0" d="M0 12h11v11H0z"/>
                <path fill="#ffba08" d="M12 12h11v11H12z"/>
              </svg>
              <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Continue with Microsoft</span>
            </button>

            <!-- GitHub -->
            <button type="button" onclick="socialLogin('github')" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md group">
              <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"/>
              </svg>
              <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Continue with GitHub</span>
            </button>

            <!-- LinkedIn -->
            <button type="button" onclick="socialLogin('linkedin')" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md group">
              <svg class="w-5 h-5 mr-3" fill="#0077B5" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
              <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Continue with LinkedIn</span>
            </button>
          </div>

          <!-- Benefits -->
          <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 mb-3">Why use social sign-in?</p>
            <ul class="space-y-2 text-xs text-gray-600">
              <li class="flex items-start">
                <i data-feather="check" class="w-4 h-4 text-green-600 mr-2 mt-0.5 stroke-current flex-shrink-0"></i>
                <span>One-click authentication</span>
              </li>
              <li class="flex items-start">
                <i data-feather="check" class="w-4 h-4 text-green-600 mr-2 mt-0.5 stroke-current flex-shrink-0"></i>
                <span>No need to remember passwords</span>
              </li>
              <li class="flex items-start">
                <i data-feather="check" class="w-4 h-4 text-green-600 mr-2 mt-0.5 stroke-current flex-shrink-0"></i>
                <span>Secure & encrypted connection</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mobile Divider (shows between columns on mobile only) -->
        <div class="md:hidden relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-gray-400 uppercase text-xs font-medium">OR</span>
          </div>
        </div>

        <!-- Right Column: Email Sign-in -->
        <div class="md:col-start-2 space-y-4">
          <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Email Sign-in</h4>
            <p class="text-sm text-gray-600">Use your email and password</p>
          </div>

          <form method="post" action="/login" class="space-y-4">
            <?php include __DIR__ . '/../partials/csrf.php'; ?>
            
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email address
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-feather="mail" class="w-5 h-5 text-gray-400 stroke-current"></i>
                </div>
                <input 
                  type="email" 
                  id="email" 
                  name="email" 
                  required
                  autofocus
                  class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                  placeholder="you@example.com"
                >
              </div>
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Password
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-feather="lock" class="w-5 h-5 text-gray-400 stroke-current"></i>
                </div>
                <input 
                  type="password" 
                  id="password" 
                  name="password" 
                  required
                  class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                  placeholder="••••••••"
                >
              </div>
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center">
                <input 
                  type="checkbox" 
                  name="remember" 
                  class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                >
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
              </label>
              <a href="/forgot-password" class="text-sm font-medium text-primary-600 hover:text-primary-700">
                Forgot password?
              </a>
            </div>

            <button type="submit" class="w-full btn btn-primary justify-center py-3 text-base">
              <i data-feather="log-in" class="w-5 h-5 mr-2 stroke-current"></i>
              Sign in
            </button>
          </form>

          <!-- Sign Up Link -->
          <div class="mt-6 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-600">
              Don't have an account?
              <a href="/register" class="font-medium text-primary-600 hover:text-primary-700">
                Sign up for free
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Features -->
    <div class="max-w-4xl mx-auto mt-12">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="text-center">
          <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 transition hover:shadow-md">
            <i data-feather="shield" class="w-7 h-7 text-primary-600 stroke-current"></i>
          </div>
          <h5 class="text-sm font-semibold text-gray-900 mb-1">Bank-level Security</h5>
          <p class="text-xs text-gray-600">256-bit encryption protects your data</p>
        </div>
        <div class="text-center">
          <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 transition hover:shadow-md">
            <i data-feather="zap" class="w-7 h-7 text-primary-600 stroke-current"></i>
          </div>
          <h5 class="text-sm font-semibold text-gray-900 mb-1">Lightning Fast</h5>
          <p class="text-xs text-gray-600">Optimized for peak performance</p>
        </div>
        <div class="text-center">
          <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mx-auto mb-3 transition hover:shadow-md">
            <i data-feather="globe" class="w-7 h-7 text-primary-600 stroke-current"></i>
          </div>
          <h5 class="text-sm font-semibold text-gray-900 mb-1">99.9% Uptime</h5>
          <p class="text-xs text-gray-600">Reliable access anytime, anywhere</p>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="max-w-4xl mx-auto mt-12 pt-8 border-t border-gray-200 text-center">
      <p class="text-sm text-gray-600 mb-3">
        &copy; <?php echo date('Y'); ?> <span class="font-semibold text-gray-900">Nexus ERP</span>. All rights reserved.
      </p>
      <div class="flex items-center justify-center space-x-6 text-sm">
        <a href="/privacy" class="text-gray-600 hover:text-primary-600 transition">Privacy Policy</a>
        <span class="text-gray-400">•</span>
        <a href="/terms" class="text-gray-600 hover:text-primary-600 transition">Terms of Service</a>
        <span class="text-gray-400">•</span>
        <a href="/help" class="text-gray-600 hover:text-primary-600 transition">Help Center</a>
      </div>
    </div>
  </div>
</div>

<script>
function socialLogin(provider) {
  // Placeholder for social login implementation
  alert(`Social login with ${provider} will be implemented here.\n\nThis would typically redirect to:\n/auth/${provider}`);
  
  // In production, this would be:
  // window.location.href = `/auth/${provider}`;
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
