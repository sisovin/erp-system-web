<?php
$pageTitle = 'Home';
$activeMenu = '';
ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-600 via-blue-600 to-indigo-700 overflow-hidden">
  <!-- Decorative Elements -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Hero Content -->
      <div class="text-white space-y-8">
        <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
          <i data-feather="zap" class="w-4 h-4 mr-2 stroke-current"></i>
          <span class="text-sm font-medium">Enterprise Resource Planning</span>
        </div>
        
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
          Streamline Your Business with 
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-orange-200">
            PEANECH ERP
          </span>
        </h1>
        
        <p class="text-lg md:text-xl text-blue-100 max-w-xl">
          All-in-one solution to manage HR, inventory, sales, and accounting. 
          Boost productivity, reduce costs, and grow your business faster.
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
          <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl transform hover:scale-105">
            <i data-feather="user-plus" class="w-5 h-5 mr-2 stroke-current"></i>
            Get Started Free
          </a>
          <a href="/demo" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/20 transition">
            <i data-feather="play-circle" class="w-5 h-5 mr-2 stroke-current"></i>
            Watch Demo
          </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
          <div>
            <div class="text-3xl font-bold">10K+</div>
            <div class="text-sm text-blue-100">Active Users</div>
          </div>
          <div>
            <div class="text-3xl font-bold">99.9%</div>
            <div class="text-sm text-blue-100">Uptime</div>
          </div>
          <div>
            <div class="text-3xl font-bold">24/7</div>
            <div class="text-sm text-blue-100">Support</div>
          </div>
        </div>
      </div>

      <!-- Hero Image/Illustration -->
      <div class="relative hidden lg:block">
        <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 p-8 shadow-2xl">
          <div class="space-y-4">
            <!-- Dashboard Preview -->
            <div class="bg-white rounded-lg p-6 shadow-lg">
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                  <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                </div>
                <span class="text-xs text-gray-500 font-medium">Dashboard Preview</span>
              </div>
              <div class="space-y-3">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center">
                      <i data-feather="users" class="w-4 h-4 text-blue-600 stroke-current"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Total Users</span>
                  </div>
                  <span class="text-lg font-bold text-gray-900">2,543</span>
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                      <i data-feather="shopping-cart" class="w-4 h-4 text-green-600 stroke-current"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Sales Orders</span>
                  </div>
                  <span class="text-lg font-bold text-gray-900">1,234</span>
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-100 rounded flex items-center justify-center">
                      <i data-feather="package" class="w-4 h-4 text-purple-600 stroke-current"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Inventory Items</span>
                  </div>
                  <span class="text-lg font-bold text-gray-900">5,678</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Trusted By Section -->
<section class="py-12 bg-white border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-center text-sm font-semibold text-gray-500 uppercase tracking-wide mb-8">
      Trusted by leading companies worldwide
    </p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center opacity-60">
      <div class="flex items-center justify-center">
        <div class="text-2xl font-bold text-gray-400">COMPANY A</div>
      </div>
      <div class="flex items-center justify-center">
        <div class="text-2xl font-bold text-gray-400">COMPANY B</div>
      </div>
      <div class="flex items-center justify-center">
        <div class="text-2xl font-bold text-gray-400">COMPANY C</div>
      </div>
      <div class="flex items-center justify-center">
        <div class="text-2xl font-bold text-gray-400">COMPANY D</div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        Everything you need to run your business
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Powerful features designed to help you manage every aspect of your enterprise efficiently
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Feature 1: HR Management -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition border border-gray-100">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="users" class="w-6 h-6 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">HR Management</h3>
        <p class="text-gray-600 mb-4">
          Streamline employee records, attendance tracking, and payroll processing in one place.
        </p>
        <a href="/features/hr" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-1 stroke-current"></i>
        </a>
      </div>

      <!-- Feature 2: Inventory Control -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition border border-gray-100">
        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="package" class="w-6 h-6 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Inventory Control</h3>
        <p class="text-gray-600 mb-4">
          Real-time stock tracking, automated reordering, and comprehensive supplier management.
        </p>
        <a href="/features/inventory" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-1 stroke-current"></i>
        </a>
      </div>

      <!-- Feature 3: Sales Management -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition border border-gray-100">
        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="shopping-cart" class="w-6 h-6 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Sales Management</h3>
        <p class="text-gray-600 mb-4">
          Track orders, manage customers, and generate invoices with our powerful sales tools.
        </p>
        <a href="/features/sales" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-1 stroke-current"></i>
        </a>
      </div>

      <!-- Feature 4: Accounting -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-xl transition border border-gray-100">
        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="dollar-sign" class="w-6 h-6 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Accounting</h3>
        <p class="text-gray-600 mb-4">
          Complete financial management with ledger entries, expense tracking, and reporting.
        </p>
        <a href="/features/accounting" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-1 stroke-current"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Benefits Content -->
      <div class="space-y-8">
        <div>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Why choose PEANECH ERP?
          </h2>
          <p class="text-lg text-gray-600">
            Our platform is designed to simplify complex business operations and drive growth
          </p>
        </div>

        <div class="space-y-6">
          <div class="flex items-start">
            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
              <i data-feather="check" class="w-6 h-6 text-green-600 stroke-current"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-1">Easy to Use</h3>
              <p class="text-gray-600">Intuitive interface designed for users of all skill levels. Get started in minutes, not weeks.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
              <i data-feather="shield" class="w-6 h-6 text-blue-600 stroke-current"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-1">Secure & Reliable</h3>
              <p class="text-gray-600">Bank-level security with 256-bit encryption and 99.9% uptime guarantee.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
              <i data-feather="trending-up" class="w-6 h-6 text-purple-600 stroke-current"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-1">Scalable Solution</h3>
              <p class="text-gray-600">Grows with your business from startup to enterprise level seamlessly.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
              <i data-feather="headphones" class="w-6 h-6 text-orange-600 stroke-current"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-1">24/7 Support</h3>
              <p class="text-gray-600">Expert support team available around the clock to help with any issues.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Benefits Image -->
      <div class="relative">
        <div class="bg-gradient-to-br from-primary-50 to-blue-100 rounded-2xl p-8">
          <div class="bg-white rounded-xl shadow-xl p-6 space-y-4">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
              <h4 class="font-semibold text-gray-900">Performance Metrics</h4>
              <span class="text-xs text-gray-500">Last 30 days</span>
            </div>
            <div class="space-y-4">
              <div>
                <div class="flex justify-between text-sm mb-1">
                  <span class="text-gray-700">Revenue Growth</span>
                  <span class="font-semibold text-green-600">+24%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full" style="width: 75%;"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-1">
                  <span class="text-gray-700">Efficiency Increase</span>
                  <span class="font-semibold text-blue-600">+18%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full" style="width: 60%;"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-1">
                  <span class="text-gray-700">Cost Reduction</span>
                  <span class="font-semibold text-purple-600">+32%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full" style="width: 85%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        Loved by businesses worldwide
      </h2>
      <p class="text-lg text-gray-600">
        See what our customers have to say about PEANECH ERP
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Testimonial 1 -->
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 mb-6">
          "PEANECH ERP transformed our operations. We've seen a 40% increase in productivity and reduced costs significantly."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
            JD
          </div>
          <div>
            <div class="font-semibold text-gray-900">John Doe</div>
            <div class="text-sm text-gray-600">CEO, Tech Corp</div>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 mb-6">
          "The best ERP solution we've used. Support team is amazing and the platform is incredibly intuitive."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
            SM
          </div>
          <div>
            <div class="font-semibold text-gray-900">Sarah Miller</div>
            <div class="text-sm text-gray-600">Operations Manager, Retail Co</div>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-400 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 mb-6">
          "Seamless integration and powerful features. PEANECH ERP helped us scale from 10 to 100 employees effortlessly."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
            MC
          </div>
          <div>
            <div class="font-semibold text-gray-900">Mike Chen</div>
            <div class="text-sm text-gray-600">Founder, StartupXYZ</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary-600 to-blue-600">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
      Ready to transform your business?
    </h2>
    <p class="text-xl text-blue-100 mb-8">
      Join thousands of companies already using PEANECH ERP to streamline their operations
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl">
        <i data-feather="user-plus" class="w-5 h-5 mr-2 stroke-current"></i>
        Start Free Trial
      </a>
      <a href="/contact" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/20 transition">
        <i data-feather="message-circle" class="w-5 h-5 mr-2 stroke-current"></i>
        Contact Sales
      </a>
    </div>
    <p class="text-sm text-blue-100 mt-6">
      No credit card required • Free 14-day trial • Cancel anytime
    </p>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
