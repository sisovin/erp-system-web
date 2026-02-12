<?php
$pageTitle = 'Businesses';
$activeMenu = 'businesses';
ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 overflow-hidden">
  <!-- Decorative Elements -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
    <div class="absolute top-1/3 left-1/3 w-80 h-80 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 0.5s;"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="text-center text-white space-y-6">
      <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-4">
        <i data-feather="briefcase" class="w-4 h-4 mr-2 stroke-current"></i>
        <span class="text-sm font-medium">Solutions for Every Business</span>
      </div>
      
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
        Trusted by Businesses
        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-orange-200">
          Across All Industries
        </span>
      </h1>
      
      <p class="text-lg md:text-xl text-purple-100 max-w-3xl mx-auto">
        From startups to enterprises, PEANECH ERP adapts to your business needs. 
        Discover how companies like yours achieve operational excellence with our platform.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
        <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-white text-purple-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl transform hover:scale-105">
          <i data-feather="rocket" class="w-5 h-5 mr-2 stroke-current"></i>
          Start Free Trial
        </a>
        <a href="/demo" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/20 transition">
          <i data-feather="phone" class="w-5 h-5 mr-2 stroke-current"></i>
          Schedule Consultation
        </a>
      </div>
    </div>
  </div>

  <!-- Wave Separator -->
  <div class="absolute bottom-0 left-0 right-0">
    <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
      <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Business Size Categories -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Designed for Businesses of All Sizes</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Our flexible ERP solution scales with your business, from day one to enterprise-level operations.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Startups & Solopreneurs -->
      <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 border border-blue-100 hover:shadow-xl transition-all transform hover:scale-105">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="zap" class="w-8 h-8 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Startups</h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
          Launch fast with essential tools. Perfect for 1-10 employees getting their business off the ground.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Quick setup in minutes
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Affordable pricing
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Room to grow
          </li>
        </ul>
        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-2 stroke-current"></i>
        </a>
      </div>

      <!-- Small Business -->
      <div class="group bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 border border-green-100 hover:shadow-xl transition-all transform hover:scale-105">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="users" class="w-8 h-8 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Small Business</h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
          Streamline operations for growing teams. Ideal for 10-50 employees scaling their processes.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Team collaboration
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Advanced reporting
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Multi-location support
          </li>
        </ul>
        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-2 stroke-current"></i>
        </a>
      </div>

      <!-- Medium Enterprise -->
      <div class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 border border-purple-100 hover:shadow-xl transition-all transform hover:scale-105">
        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="trending-up" class="w-8 h-8 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Medium Enterprise</h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
          Enterprise features at mid-market pricing. Built for 50-250 employees with complex needs.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Custom workflows
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            API integrations
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Priority support
          </li>
        </ul>
        <a href="#" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-2 stroke-current"></i>
        </a>
      </div>

      <!-- Large Corporation -->
      <div class="group bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-8 border border-orange-100 hover:shadow-xl transition-all transform hover:scale-105">
        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-feather="globe" class="w-8 h-8 text-white stroke-current"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Large Corporation</h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
          Enterprise-grade at scale. Perfect for 250+ employees with global operations.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Unlimited users
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            Dedicated support
          </li>
          <li class="flex items-center text-sm text-gray-700">
            <i data-feather="check" class="w-4 h-4 mr-2 text-green-600 stroke-current"></i>
            SLA guarantee
          </li>
        </ul>
        <a href="#" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium">
          Learn more
          <i data-feather="arrow-right" class="w-4 h-4 ml-2 stroke-current"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Industry Solutions -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 rounded-full mb-4">
        <i data-feather="layers" class="w-4 h-4 mr-2 stroke-current"></i>
        <span class="text-sm font-semibold">Industry-Specific Solutions</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tailored for Your Industry</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        We understand that every industry has unique challenges. Our ERP adapts to your specific needs.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Retail & E-commerce -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="shopping-cart" class="w-6 h-6 text-blue-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Retail & E-commerce</h3>
            <p class="text-sm text-gray-600 mb-3">
              Manage inventory, sales, and customer experiences across online and offline channels.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                POS integration
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Multi-channel inventory
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Manufacturing -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="settings" class="w-6 h-6 text-purple-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Manufacturing</h3>
            <p class="text-sm text-gray-600 mb-3">
              Optimize production planning, supply chain, and quality control processes.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Production scheduling
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Quality management
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Professional Services -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="briefcase" class="w-6 h-6 text-green-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Professional Services</h3>
            <p class="text-sm text-gray-600 mb-3">
              Track projects, billable hours, and client relationships all in one place.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Time tracking
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Project management
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Healthcare -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="heart" class="w-6 h-6 text-red-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Healthcare</h3>
            <p class="text-sm text-gray-600 mb-3">
              HIPAA-compliant systems for patient records, billing, and regulatory compliance.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Patient management
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Compliance tracking
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Hospitality -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="coffee" class="w-6 h-6 text-yellow-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hospitality</h3>
            <p class="text-sm text-gray-600 mb-3">
              Manage bookings, guest experiences, and operations for hotels and restaurants.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Reservation system
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Guest management
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Education -->
      <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100">
        <div class="flex items-start space-x-4">
          <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <i data-feather="book-open" class="w-6 h-6 text-indigo-600 stroke-current"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Education</h3>
            <p class="text-sm text-gray-600 mb-3">
              Streamline admissions, student records, and administrative operations.
            </p>
            <ul class="space-y-1 text-xs text-gray-600">
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Student information system
              </li>
              <li class="flex items-center">
                <i data-feather="check-circle" class="w-3 h-3 mr-2 text-green-600 stroke-current"></i>
                Course management
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <p class="text-gray-600 mb-4">Don't see your industry? We work with businesses across all sectors.</p>
      <a href="/contact" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-md hover:shadow-lg">
        <i data-feather="message-circle" class="w-5 h-5 mr-2 stroke-current"></i>
        Discuss Your Industry Needs
      </a>
    </div>
  </div>
</section>

<!-- Success Stories -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Success Stories</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        See how businesses like yours transformed their operations with PEANECH ERP.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Testimonial 1 -->
      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 border border-blue-100">
        <div class="flex items-center mb-6">
          <div class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
            TM
          </div>
          <div>
            <h4 class="font-bold text-gray-900">TechMart Solutions</h4>
            <p class="text-sm text-gray-600">E-commerce Retailer</p>
          </div>
        </div>
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 leading-relaxed mb-6">
          "PEANECH ERP helped us reduce inventory costs by 35% and streamline our order fulfillment. 
          The multi-channel integration is a game-changer!"
        </p>
        <div class="flex items-center space-x-6 text-sm">
          <div>
            <div class="font-bold text-blue-600 text-2xl">35%</div>
            <div class="text-gray-600">Cost Reduction</div>
          </div>
          <div>
            <div class="font-bold text-blue-600 text-2xl">50%</div>
            <div class="text-gray-600">Faster Processing</div>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 border border-green-100">
        <div class="flex items-center mb-6">
          <div class="w-14 h-14 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
            GM
          </div>
          <div>
            <h4 class="font-bold text-gray-900">GreenLeaf Manufacturing</h4>
            <p class="text-sm text-gray-600">Production Company</p>
          </div>
        </div>
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 leading-relaxed mb-6">
          "Production planning is now automated and error-free. We increased our output by 40% 
          while maintaining quality standards. Excellent ROI!"
        </p>
        <div class="flex items-center space-x-6 text-sm">
          <div>
            <div class="font-bold text-green-600 text-2xl">40%</div>
            <div class="text-gray-600">Output Increase</div>
          </div>
          <div>
            <div class="font-bold text-green-600 text-2xl">60%</div>
            <div class="text-gray-600">Less Errors</div>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 border border-purple-100">
        <div class="flex items-center mb-6">
          <div class="w-14 h-14 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
            BC
          </div>
          <div>
            <h4 class="font-bold text-gray-900">BrightConsult Partners</h4>
            <p class="text-sm text-gray-600">Consulting Firm</p>
          </div>
        </div>
        <div class="flex items-center mb-4">
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current mr-1"></i>
          <i data-feather="star" class="w-5 h-5 text-yellow-500 fill-current stroke-current"></i>
        </div>
        <p class="text-gray-700 leading-relaxed mb-6">
          "Time tracking and project management features are intuitive. Our billable hours increased by 25% 
          with better client visibility and reporting."
        </p>
        <div class="flex items-center space-x-6 text-sm">
          <div>
            <div class="font-bold text-purple-600 text-2xl">25%</div>
            <div class="text-gray-600">More Revenue</div>
          </div>
          <div>
            <div class="font-bold text-purple-600 text-2xl">90%</div>
            <div class="text-gray-600">Client Satisfaction</div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <a href="/case-studies" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
        View All Case Studies
        <i data-feather="arrow-right" class="w-5 h-5 ml-2 stroke-current"></i>
      </a>
    </div>
  </div>
</section>

<!-- Key Business Benefits -->
<section class="py-20 bg-gradient-to-br from-primary-600 via-blue-600 to-indigo-700 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Business Benefits You Can Measure</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Our customers typically see these improvements within the first 6 months.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">45%</div>
        <div class="text-xl font-semibold mb-2">Operational Cost Reduction</div>
        <p class="text-blue-100 text-sm">
          Automate repetitive tasks and eliminate manual data entry errors.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">3x</div>
        <div class="text-xl font-semibold mb-2">Faster Decision Making</div>
        <p class="text-blue-100 text-sm">
          Real-time dashboards provide instant insights into business performance.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">60%</div>
        <div class="text-xl font-semibold mb-2">Less Time on Admin</div>
        <p class="text-blue-100 text-sm">
          Free up your team to focus on strategic growth initiatives.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">99.9%</div>
        <div class="text-xl font-semibold mb-2">Data Accuracy</div>
        <p class="text-blue-100 text-sm">
          Single source of truth eliminates discrepancies across departments.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">30%</div>
        <div class="text-xl font-semibold mb-2">Revenue Growth</div>
        <p class="text-blue-100 text-sm">
          Better customer insights and streamlined sales processes drive results.
        </p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <div class="text-5xl font-bold mb-2">24/7</div>
        <div class="text-xl font-semibold mb-2">Business Visibility</div>
        <p class="text-blue-100 text-sm">
          Access critical data anytime, anywhere with cloud-based platform.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 md:p-12 border border-indigo-100">
      <div class="inline-flex items-center px-4 py-2 bg-white rounded-full shadow-sm mb-6">
        <i data-feather="award" class="w-4 h-4 mr-2 text-indigo-600 stroke-current"></i>
        <span class="text-sm font-semibold text-indigo-700">Join 10,000+ Successful Businesses</span>
      </div>
      
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        Ready to Transform Your Business?
      </h2>
      
      <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        See how PEANECH ERP can help your business achieve operational excellence. 
        Start your free 30-day trial today—no credit card required.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
          <i data-feather="rocket" class="w-5 h-5 mr-2 stroke-current"></i>
          Start Your Free Trial
        </a>
        <a href="/demo" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg border-2 border-primary-200 hover:border-primary-300 hover:bg-primary-50 transition">
          <i data-feather="video" class="w-5 h-5 mr-2 stroke-current"></i>
          Watch Live Demo
        </a>
      </div>

      <div class="mt-8 flex items-center justify-center space-x-8 text-sm text-gray-500">
        <div class="flex items-center space-x-2">
          <i data-feather="shield" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>Enterprise-grade security</span>
        </div>
        <div class="flex items-center space-x-2">
          <i data-feather="clock" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>Setup in under 30 minutes</span>
        </div>
        <div class="flex items-center space-x-2">
          <i data-feather="users" class="w-4 h-4 text-green-600 stroke-current"></i>
          <span>Dedicated support team</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
?>
