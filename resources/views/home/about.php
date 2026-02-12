<?php
$pageTitle = 'About Us';
$activeMenu = 'about';
ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-600 via-blue-600 to-indigo-700 overflow-hidden">
  <!-- Decorative Elements -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
    <div class="absolute top-1/2 right-1/4 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="text-center text-white space-y-6">
      <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-4">
        <i data-feather="info" class="w-4 h-4 mr-2 stroke-current"></i>
        <span class="text-sm font-medium">About PEANECH ERP</span>
      </div>
      
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
        Empowering Businesses Through 
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-orange-200">
          Innovation
        </span>
      </h1>
      
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
        We're on a mission to revolutionize enterprise resource planning with cutting-edge technology, 
        intuitive design, and unparalleled support for businesses of all sizes.
      </p>
    </div>
  </div>

  <!-- Wave Separator -->
  <div class="absolute bottom-0 left-0 right-0">
    <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
      <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      <div class="text-center">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4">
          <i data-feather="users" class="w-8 h-8 text-blue-600 stroke-current"></i>
        </div>
        <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">10K+</div>
        <div class="text-sm md:text-base text-gray-600">Active Users</div>
      </div>
      
      <div class="text-center">
        <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-4">
          <i data-feather="briefcase" class="w-8 h-8 text-green-600 stroke-current"></i>
        </div>
        <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">500+</div>
        <div class="text-sm md:text-base text-gray-600">Companies</div>
      </div>
      
      <div class="text-center">
        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mx-auto mb-4">
          <i data-feather="globe" class="w-8 h-8 text-purple-600 stroke-current"></i>
        </div>
        <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">50+</div>
        <div class="text-sm md:text-base text-gray-600">Countries</div>
      </div>
      
      <div class="text-center">
        <div class="flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mx-auto mb-4">
          <i data-feather="award" class="w-8 h-8 text-orange-600 stroke-current"></i>
        </div>
        <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">99.9%</div>
        <div class="text-sm md:text-base text-gray-600">Uptime SLA</div>
      </div>
    </div>
  </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Mission -->
      <div class="space-y-6">
        <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-full mb-2">
          <i data-feather="target" class="w-4 h-4 mr-2 stroke-current"></i>
          <span class="text-sm font-semibold">Our Mission</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
          Simplifying Business Operations Worldwide
        </h2>
        <p class="text-lg text-gray-600 leading-relaxed">
          Our mission is to provide businesses with powerful, intuitive tools that streamline operations, 
          reduce complexity, and drive sustainable growth. We believe that enterprise software should be 
          accessible, affordable, and adaptable to businesses of all sizes.
        </p>
        <div class="flex flex-wrap gap-4">
          <div class="flex items-center space-x-2">
            <i data-feather="check-circle" class="w-5 h-5 text-green-600 stroke-current"></i>
            <span class="text-gray-700">User-Centric Design</span>
          </div>
          <div class="flex items-center space-x-2">
            <i data-feather="check-circle" class="w-5 h-5 text-green-600 stroke-current"></i>
            <span class="text-gray-700">Continuous Innovation</span>
          </div>
          <div class="flex items-center space-x-2">
            <i data-feather="check-circle" class="w-5 h-5 text-green-600 stroke-current"></i>
            <span class="text-gray-700">Customer Success</span>
          </div>
        </div>
      </div>

      <!-- Vision -->
      <div class="space-y-6">
        <div class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-700 rounded-full mb-2">
          <i data-feather="eye" class="w-4 h-4 mr-2 stroke-current"></i>
          <span class="text-sm font-semibold">Our Vision</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
          Leading the Future of ERP Technology
        </h2>
        <p class="text-lg text-gray-600 leading-relaxed">
          We envision a future where every business, regardless of size or industry, has access to 
          world-class ERP solutions. Through cutting-edge technology, AI-driven insights, and seamless 
          integrations, we're building the next generation of business management software.
        </p>
        <div class="grid grid-cols-2 gap-4">
          <div class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
            <div class="text-2xl font-bold text-blue-700 mb-1">2020</div>
            <div class="text-sm text-gray-600">Founded</div>
          </div>
          <div class="p-4 bg-gradient-to-br from-green-50 to-teal-50 rounded-lg border border-green-100">
            <div class="text-2xl font-bold text-green-700 mb-1">$50M+</div>
            <div class="text-sm text-gray-600">Funding Raised</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Core Values Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Core Values</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        The principles that guide everything we do, from product development to customer support.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Innovation -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="zap" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
        <p class="text-gray-600 leading-relaxed">
          We constantly push boundaries, exploring new technologies and methodologies to deliver 
          cutting-edge solutions that keep our clients ahead of the curve.
        </p>
      </div>

      <!-- Integrity -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="shield" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Integrity</h3>
        <p class="text-gray-600 leading-relaxed">
          Transparency, honesty, and ethical practices are at the heart of our business. 
          We build trust through actions, not just words.
        </p>
      </div>

      <!-- Excellence -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="star" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence</h3>
        <p class="text-gray-600 leading-relaxed">
          We set high standards and consistently exceed them. Quality is non-negotiable 
          in every aspect of our product and service delivery.
        </p>
      </div>

      <!-- Collaboration -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="users" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Collaboration</h3>
        <p class="text-gray-600 leading-relaxed">
          We believe in the power of teamwork, both within our organization and with our clients. 
          Together, we achieve extraordinary results.
        </p>
      </div>

      <!-- Customer-Centric -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="heart" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Customer-Centric</h3>
        <p class="text-gray-600 leading-relaxed">
          Our customers are our priority. Every decision we make is guided by how it will 
          impact and improve their experience and success.
        </p>
      </div>

      <!-- Agility -->
      <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-xl transition-all transform hover:scale-105 group">
        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="trending-up" class="w-7 h-7 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Agility</h3>
        <p class="text-gray-600 leading-relaxed">
          We adapt quickly to changing market needs and customer feedback, ensuring our 
          solutions remain relevant and effective.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Technology Stack Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 rounded-full mb-4">
        <i data-feather="code" class="w-4 h-4 mr-2 stroke-current"></i>
        <span class="text-sm font-semibold">Technology Stack</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Built with Modern Technology</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        We leverage cutting-edge technologies to deliver fast, secure, and scalable solutions.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
      <!-- Backend Technologies -->
      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 border border-blue-100">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
            <i data-feather="server" class="w-6 h-6 text-white stroke-current"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Backend</h3>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">PHP 8.5+</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">MySQL 8.0+</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Redis Cache</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">JWT Auth</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">RESTful API</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">RBAC System</span>
          </div>
        </div>
      </div>

      <!-- Frontend Technologies -->
      <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 border border-purple-100">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
            <i data-feather="monitor" class="w-6 h-6 text-white stroke-current"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900">Frontend</h3>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Tailwind CSS 4.1</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Vanilla JavaScript</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Feather Icons</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Responsive Design</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">Mobile-First</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
            <span class="text-gray-700 font-medium">PWA Ready</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Key Features -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition">
        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
          <i data-feather="lock" class="w-5 h-5 text-green-600 stroke-current"></i>
        </div>
        <h4 class="font-semibold text-gray-900 mb-1">Secure by Design</h4>
        <p class="text-sm text-gray-600">Enterprise-grade security with encryption and RBAC</p>
      </div>

      <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
          <i data-feather="zap" class="w-5 h-5 text-blue-600 stroke-current"></i>
        </div>
        <h4 class="font-semibold text-gray-900 mb-1">Lightning Fast</h4>
        <p class="text-sm text-gray-600">Redis caching for optimal performance</p>
      </div>

      <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition">
        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
          <i data-feather="smartphone" class="w-5 h-5 text-purple-600 stroke-current"></i>
        </div>
        <h4 class="font-semibold text-gray-900 mb-1">Mobile Optimized</h4>
        <p class="text-sm text-gray-600">Fully responsive across all devices</p>
      </div>

      <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition">
        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
          <i data-feather="package" class="w-5 h-5 text-orange-600 stroke-current"></i>
        </div>
        <h4 class="font-semibold text-gray-900 mb-1">Modular Architecture</h4>
        <p class="text-sm text-gray-600">Scalable and maintainable codebase</p>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-20 bg-gradient-to-br from-primary-600 via-blue-600 to-indigo-700 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose PEANECH ERP?</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        We go beyond features to deliver real value to your business.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="dollar-sign" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Cost-Effective</h3>
        <p class="text-blue-100">
          Transparent pricing with no hidden fees. Get enterprise features at affordable rates with flexible plans.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="clock" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Quick Setup</h3>
        <p class="text-blue-100">
          Get started in minutes, not months. Our intuitive onboarding process gets you up and running fast.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="headphones" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">24/7 Support</h3>
        <p class="text-blue-100">
          Our dedicated support team is always available to help you succeed with live chat, email, and phone support.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="refresh-cw" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Regular Updates</h3>
        <p class="text-blue-100">
          Continuous improvements with weekly updates, new features, and security patches at no extra cost.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="book-open" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Comprehensive Training</h3>
        <p class="text-blue-100">
          Access extensive documentation, video tutorials, webinars, and certification programs for your team.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 hover:bg-white/20 transition">
        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
          <i data-feather="shield-off" class="w-6 h-6 stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">No Lock-In</h3>
        <p class="text-blue-100">
          Export your data anytime. We believe in earning your business every day, not locking you in.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="bg-gradient-to-br from-primary-50 to-blue-50 rounded-2xl p-8 md:p-12 border border-primary-100">
      <div class="inline-flex items-center px-4 py-2 bg-white rounded-full shadow-sm mb-6">
        <i data-feather="rocket" class="w-4 h-4 mr-2 text-primary-600 stroke-current"></i>
        <span class="text-sm font-semibold text-primary-700">Ready to Get Started?</span>
      </div>
      
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        Join Thousands of Businesses Growing with PEANECH ERP
      </h2>
      
      <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Start your free trial today and experience the difference. No credit card required, 
        full access to all features for 30 days.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
          <i data-feather="user-plus" class="w-5 h-5 mr-2 stroke-current"></i>
          Start Free Trial
        </a>
        <a href="/demo" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg border-2 border-primary-200 hover:border-primary-300 hover:bg-primary-50 transition">
          <i data-feather="play-circle" class="w-5 h-5 mr-2 stroke-current"></i>
          Schedule Demo
        </a>
      </div>

      <div class="mt-8 flex items-center justify-center space-x-8 text-sm text-gray-500">
        <div class="flex items-center space-x-2">
          <i data-feather="check" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>No credit card required</span>
        </div>
        <div class="flex items-center space-x-2">
          <i data-feather="check" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>30-day free trial</span>
        </div>
        <div class="flex items-center space-x-2">
          <i data-feather="check" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>Cancel anytime</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
?>
