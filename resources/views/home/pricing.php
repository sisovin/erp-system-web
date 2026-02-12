<?php
/**
 * Pricing Page
 * Comprehensive pricing plans and features for PEANECH ERP
 */
$pageTitle = 'Pricing - Choose Your Plan';
$activeMenu = 'pricing';

ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -top-48 -left-48 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -bottom-48 -right-48 animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i data-feather="tag" class="w-5 h-5 mr-2 stroke-current"></i>
                <span class="text-sm font-semibold">Transparent Pricing</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Simple Pricing,
                <span class="block bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                    Powerful Results
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-8 leading-relaxed">
                Choose the perfect plan for your business. All plans include a 30-day free trial with no credit card required.
            </p>
            
            <!-- Billing Toggle -->
            <div class="flex items-center justify-center gap-4 mb-8">
                <span class="text-sm font-medium" id="monthly-label">Monthly</span>
                <button 
                    id="billing-toggle" 
                    class="relative w-14 h-7 bg-white/30 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-white/50"
                    onclick="toggleBilling()"
                >
                    <span id="toggle-slider" class="absolute left-1 top-1 w-5 h-5 bg-white rounded-full shadow-md transition-transform"></span>
                </button>
                <span class="text-sm font-medium flex items-center gap-2" id="annual-label">
                    Annual 
                    <span class="px-2 py-1 bg-green-500 text-white text-xs font-bold rounded-full">Save 20%</span>
                </span>
            </div>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="rgb(249, 250, 251)"/>
        </svg>
    </div>
</section>

<!-- Pricing Cards -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Starter Plan -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all p-8 border-2 border-gray-200">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl mb-4">
                        <i data-feather="box" class="w-6 h-6 text-gray-600 stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                    <p class="text-gray-600 text-sm">Perfect for small businesses</p>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-baseline">
                        <span class="text-4xl font-bold text-gray-900">$</span>
                        <span class="text-5xl font-bold text-gray-900" data-monthly="0" data-annual="0">0</span>
                        <span class="text-gray-600 ml-2">/month</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Free forever</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Up to 5 users</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Basic inventory management</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Simple invoicing</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Email support</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">1GB storage</span>
                    </li>
                </ul>
                
                <a href="/register" class="block w-full px-6 py-3 bg-gray-100 text-gray-900 font-semibold rounded-lg hover:bg-gray-200 transition text-center">
                    Get Started Free
                </a>
            </div>
            
            <!-- Professional Plan -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all p-8 border-2 border-blue-600 relative">
                <!-- Popular Badge -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="px-4 py-1 bg-blue-600 text-white text-xs font-bold rounded-full shadow-lg">
                        MOST POPULAR
                    </span>
                </div>
                
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-xl mb-4">
                        <i data-feather="briefcase" class="w-6 h-6 text-blue-600 stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Professional</h3>
                    <p class="text-gray-600 text-sm">For growing businesses</p>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-baseline">
                        <span class="text-4xl font-bold text-gray-900">$</span>
                        <span class="text-5xl font-bold text-gray-900 price-value" data-monthly="49" data-annual="39">49</span>
                        <span class="text-gray-600 ml-2">/month</span>
                    </div>
                    <p class="text-sm text-blue-600 mt-2 billing-note">Billed monthly</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Up to 25 users</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Advanced inventory & tracking</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Custom invoicing & quotes</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Priority support (24/7)</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">50GB storage</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">API access</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Advanced reporting</span>
                    </li>
                </ul>
                
                <a href="/register" class="block w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-center shadow-lg">
                    Start Free Trial
                </a>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all p-8 border-2 border-purple-600">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-xl mb-4">
                        <i data-feather="award" class="w-6 h-6 text-purple-600 stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                    <p class="text-gray-600 text-sm">For large organizations</p>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-baseline">
                        <span class="text-4xl font-bold text-gray-900">$</span>
                        <span class="text-5xl font-bold text-gray-900 price-value" data-monthly="149" data-annual="119">149</span>
                        <span class="text-gray-600 ml-2">/month</span>
                    </div>
                    <p class="text-sm text-purple-600 mt-2 billing-note">Billed monthly</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Unlimited users</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Full ERP suite</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Multi-location support</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Dedicated account manager</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">500GB storage</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Advanced API & integrations</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">Custom workflows</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-700">SLA guarantee</span>
                    </li>
                </ul>
                
                <a href="/register" class="block w-full px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition text-center shadow-lg">
                    Start Free Trial
                </a>
            </div>
            
            <!-- Custom Plan -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all p-8 text-white">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/10 rounded-xl mb-4">
                        <i data-feather="settings" class="w-6 h-6 text-white stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Custom</h3>
                    <p class="text-gray-300 text-sm">Tailored to your needs</p>
                </div>
                
                <div class="mb-6">
                    <div class="text-4xl font-bold mb-2">Let's Talk</div>
                    <p class="text-sm text-gray-300">Custom pricing for unique requirements</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">Everything in Enterprise</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">White-label options</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">Custom integrations</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">On-premise deployment</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">Dedicated infrastructure</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 stroke-current"></i>
                        <span class="text-sm text-gray-200">Custom training & onboarding</span>
                    </li>
                </ul>
                
                <a href="/contact" class="block w-full px-6 py-3 bg-white text-gray-900 font-semibold rounded-lg hover:bg-gray-100 transition text-center">
                    Contact Sales
                </a>
            </div>
        </div>
        
        <!-- Trust Badges -->
        <div class="mt-16 text-center">
            <p class="text-sm text-gray-600 mb-6">Trusted by over 10,000+ businesses worldwide</p>
            <div class="flex flex-wrap items-center justify-center gap-8 opacity-50">
                <div class="text-gray-400 font-bold text-lg">TechCorp</div>
                <div class="text-gray-400 font-bold text-lg">GlobalRetail</div>
                <div class="text-gray-400 font-bold text-lg">HealthPlus</div>
                <div class="text-gray-400 font-bold text-lg">Manufacturing Co</div>
                <div class="text-gray-400 font-bold text-lg">EduSystems</div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Comparison Table -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Compare Plans & Features
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Find the perfect fit for your business needs
            </p>
        </div>
        
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left py-4 px-6 font-semibold text-gray-900">Features</th>
                        <th class="text-center py-4 px-6 font-semibold text-gray-900">Starter</th>
                        <th class="text-center py-4 px-6 font-semibold text-blue-600">Professional</th>
                        <th class="text-center py-4 px-6 font-semibold text-purple-600">Enterprise</th>
                        <th class="text-center py-4 px-6 font-semibold text-gray-900">Custom</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-4 px-6 font-medium text-gray-900">Users</td>
                        <td class="py-4 px-6 text-center text-gray-600">Up to 5</td>
                        <td class="py-4 px-6 text-center text-gray-600">Up to 25</td>
                        <td class="py-4 px-6 text-center text-gray-600">Unlimited</td>
                        <td class="py-4 px-6 text-center text-gray-600">Unlimited</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">Storage</td>
                        <td class="py-4 px-6 text-center text-gray-600">1GB</td>
                        <td class="py-4 px-6 text-center text-gray-600">50GB</td>
                        <td class="py-4 px-6 text-center text-gray-600">500GB</td>
                        <td class="py-4 px-6 text-center text-gray-600">Custom</td>
                    </tr>
                    <tr>
                        <td class="py-4 px-6 font-medium text-gray-900">Inventory Management</td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">Invoicing & Quotes</td>
                        <td class="py-4 px-6 text-center text-gray-400">Basic</td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr>
                        <td class="py-4 px-6 font-medium text-gray-900">Advanced Reporting</td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">API Access</td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr>
                        <td class="py-4 px-6 font-medium text-gray-900">Multi-Location</td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">Custom Workflows</td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                    <tr>
                        <td class="py-4 px-6 font-medium text-gray-900">Support</td>
                        <td class="py-4 px-6 text-center text-gray-600">Email</td>
                        <td class="py-4 px-6 text-center text-gray-600">24/7 Priority</td>
                        <td class="py-4 px-6 text-center text-gray-600">Dedicated Manager</td>
                        <td class="py-4 px-6 text-center text-gray-600">Premium Support</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">SLA Guarantee</td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="x" class="w-5 h-5 text-gray-400 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                        <td class="py-4 px-6 text-center"><i data-feather="check" class="w-5 h-5 text-green-600 inline stroke-current"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Comparison -->
        <div class="lg:hidden space-y-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Starter Plan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Users:</span>
                        <span class="font-medium">Up to 5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Storage:</span>
                        <span class="font-medium">1GB</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">API Access:</span>
                        <i data-feather="x" class="w-5 h-5 text-gray-400 stroke-current"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 rounded-xl p-6 border-2 border-blue-600">
                <h3 class="text-lg font-bold text-blue-900 mb-4">Professional Plan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Users:</span>
                        <span class="font-medium">Up to 25</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Storage:</span>
                        <span class="font-medium">50GB</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">API Access:</span>
                        <i data-feather="check" class="w-5 h-5 text-green-600 stroke-current"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-purple-50 rounded-xl p-6 border-2 border-purple-600">
                <h3 class="text-lg font-bold text-purple-900 mb-4">Enterprise Plan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Users:</span>
                        <span class="font-medium">Unlimited</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Storage:</span>
                        <span class="font-medium">500GB</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">API Access:</span>
                        <i data-feather="check" class="w-5 h-5 text-green-600 stroke-current"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Frequently Asked Questions
            </h2>
            <p class="text-xl text-gray-600">
                Everything you need to know about pricing
            </p>
        </div>
        
        <div class="space-y-6">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Can I change my plan at any time?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Yes! You can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle, and we'll prorate any differences.
                </div>
            </div>
            
            <!-- FAQ 2 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Is there a free trial available?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Absolutely! All paid plans come with a 30-day free trial. No credit card required to start. Experience the full power of PEANECH ERP risk-free.
                </div>
            </div>
            
            <!-- FAQ 3 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        What payment methods do you accept?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for annual subscriptions. Enterprise customers can also arrange invoice-based billing.
                </div>
            </div>
            
            <!-- FAQ 4 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Can I cancel my subscription?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Yes, you can cancel anytime with no penalties or fees. Your account will remain active until the end of your current billing period. You can export all your data before canceling.
                </div>
            </div>
            
            <!-- FAQ 5 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        Do you offer discounts for nonprofits or educational institutions?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Yes! We offer special pricing for qualified nonprofits and educational institutions. Contact our sales team at sales@peanech.com for more information.
                </div>
            </div>
            
            <!-- FAQ 6 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <button class="w-full flex items-start justify-between text-left" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900 pr-8">
                        What happens to my data if I downgrade or cancel?
                    </h3>
                    <i data-feather="chevron-down" class="w-6 h-6 text-gray-400 flex-shrink-0 transition-transform stroke-current"></i>
                </button>
                <div class="faq-answer mt-4 text-gray-600 hidden">
                    Your data is always yours. When you downgrade, features are limited but your data remains intact. If you cancel, you'll have 90 days to export your data. After that, your data is permanently deleted for security.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Money-Back Guarantee -->
<section class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
            <i data-feather="shield-check" class="w-10 h-10 text-green-600 stroke-current"></i>
        </div>
        
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            30-Day Money-Back Guarantee
        </h2>
        
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Try PEANECH ERP risk-free. If you're not completely satisfied within 30 days, we'll refund your payment—no questions asked.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/register" class="px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition shadow-lg flex items-center">
                <i data-feather="check-circle" class="w-5 h-5 mr-2 stroke-current"></i>
                Start Your Free Trial
            </a>
            <a href="/contact" class="px-8 py-4 bg-white text-gray-900 font-semibold rounded-lg hover:bg-gray-50 transition border-2 border-gray-300 flex items-center">
                <i data-feather="phone" class="w-5 h-5 mr-2 stroke-current"></i>
                Talk to Sales
            </a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl top-0 left-1/4 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl bottom-0 right-1/4 animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
            Ready to Transform Your Business?
        </h2>
        <p class="text-xl md:text-2xl text-blue-100 mb-12">
            Join thousands of businesses already using PEANECH ERP
        </p>
        
        <a href="/register" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all">
            <i data-feather="zap" class="w-5 h-5 mr-2 stroke-current"></i>
            Get Started Free
        </a>
        
        <p class="mt-8 text-sm text-blue-200">
            No credit card required • 30-day free trial • Cancel anytime
        </p>
    </div>
</section>

<script>
// Billing toggle functionality
let isAnnual = false;

function toggleBilling() {
    isAnnual = !isAnnual;
    const slider = document.getElementById('toggle-slider');
    const priceElements = document.querySelectorAll('.price-value');
    const billingNotes = document.querySelectorAll('.billing-note');
    
    // Toggle slider position
    if (isAnnual) {
        slider.style.transform = 'translateX(28px)';
    } else {
        slider.style.transform = 'translateX(0)';
    }
    
    // Update prices
    priceElements.forEach(el => {
        const monthly = el.getAttribute('data-monthly');
        const annual = el.getAttribute('data-annual');
        el.textContent = isAnnual ? annual : monthly;
    });
    
    // Update billing notes
    billingNotes.forEach(note => {
        note.textContent = isAnnual ? 'Billed annually' : 'Billed monthly';
    });
}

// FAQ toggle functionality
function toggleFAQ(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('i[data-feather="chevron-down"]');
    
    // Close all other FAQs
    document.querySelectorAll('.faq-answer').forEach(a => {
        if (a !== answer) {
            a.classList.add('hidden');
            a.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle current FAQ
    answer.classList.toggle('hidden');
    if (answer.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
?>
