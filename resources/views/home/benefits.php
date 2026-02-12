<?php
/**
 * Benefits Page
 * Showcases the key benefits and value propositions of PEANECH ERP
 */
$pageTitle = 'Benefits - Transform Your Business';
$activeMenu = 'benefits';

ob_start();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -top-48 -left-48 animate-pulse"></div>
        <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl -bottom-48 -right-48 animate-pulse delay-1000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-8">
                <i data-feather="trending-up" class="w-5 h-5 mr-2 stroke-current"></i>
                <span class="text-sm font-semibold">Measurable Business Impact</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Real Benefits That Drive
                <span class="block bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                    Real Results
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-12 leading-relaxed">
                Discover how PEANECH ERP transforms businesses with proven ROI, increased efficiency, and sustainable growth
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/register" class="w-full sm:w-auto px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all flex items-center justify-center">
                    <i data-feather="rocket" class="w-5 h-5 mr-2 stroke-current"></i>
                    Start Free Trial
                </a>
                <a href="#calculator" class="w-full sm:w-auto px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/30 transition-all flex items-center justify-center">
                    <i data-feather="calculator" class="w-5 h-5 mr-2 stroke-current"></i>
                    Calculate Your ROI
                </a>
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

<!-- Key Statistics -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i data-feather="trending-up" class="w-8 h-8 text-green-600 stroke-current"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">45%</div>
                <div class="text-sm text-gray-600">Productivity Increase</div>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i data-feather="dollar-sign" class="w-8 h-8 text-blue-600 stroke-current"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">35%</div>
                <div class="text-sm text-gray-600">Cost Reduction</div>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <i data-feather="clock" class="w-8 h-8 text-purple-600 stroke-current"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">60%</div>
                <div class="text-sm text-gray-600">Time Saved</div>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-100 rounded-full mb-4">
                    <i data-feather="award" class="w-8 h-8 text-pink-600 stroke-current"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">98%</div>
                <div class="text-sm text-gray-600">Client Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- Core Benefits -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Core Benefits of PEANECH ERP
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Experience transformative advantages that propel your business forward
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Benefit 1: Operational Efficiency -->
            <div class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="zap" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Operational Efficiency</h3>
                <p class="text-gray-700 mb-6">
                    Streamline workflows and eliminate redundant tasks with intelligent automation. Reduce manual errors by 85% and complete tasks 3x faster.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Automated workflow management</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Real-time process monitoring</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Smart task prioritization</span>
                    </li>
                </ul>
            </div>
            
            <!-- Benefit 2: Cost Savings -->
            <div class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="dollar-sign" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Significant Cost Savings</h3>
                <p class="text-gray-700 mb-6">
                    Reduce operational costs by up to 35% through optimized resource allocation, reduced waste, and improved budget control.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Lower software licensing costs</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Reduced manual labor expenses</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Optimized inventory management</span>
                    </li>
                </ul>
            </div>
            
            <!-- Benefit 3: Data-Driven Decisions -->
            <div class="group bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="bar-chart-2" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Data-Driven Insights</h3>
                <p class="text-gray-700 mb-6">
                    Make informed decisions with comprehensive analytics and real-time reporting. Access actionable insights from every corner of your business.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Advanced analytics dashboards</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Predictive forecasting tools</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Custom report generation</span>
                    </li>
                </ul>
            </div>
            
            <!-- Benefit 4: Scalability -->
            <div class="group bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="trending-up" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Unlimited Scalability</h3>
                <p class="text-gray-700 mb-6">
                    Grow your business without limitations. Our ERP scales seamlessly from small teams to enterprise operations without performance loss.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Flexible user scaling</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Modular feature expansion</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Cloud infrastructure support</span>
                    </li>
                </ul>
            </div>
            
            <!-- Benefit 5: Enhanced Collaboration -->
            <div class="group bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="users" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Enhanced Collaboration</h3>
                <p class="text-gray-700 mb-6">
                    Connect teams across departments and locations with unified communication tools and shared workflows. Break down silos effortlessly.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Real-time team collaboration</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Cross-department visibility</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Integrated communication tools</span>
                    </li>
                </ul>
            </div>
            
            <!-- Benefit 6: Security & Compliance -->
            <div class="group bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8 hover:shadow-2xl transition-all hover:scale-105">
                <div class="w-14 h-14 bg-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-feather="shield" class="w-7 h-7 text-white stroke-current"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Security & Compliance</h3>
                <p class="text-gray-700 mb-6">
                    Protect your business with enterprise-grade security and automated compliance. Meet industry standards without additional overhead.
                </p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>End-to-end encryption</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Automated compliance reporting</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 stroke-current"></i>
                        <span>Role-based access control</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Before vs After Comparison -->
<section class="py-20 bg-gradient-to-br from-gray-900 to-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                The Transformation Journey
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                See how businesses evolve after implementing PEANECH ERP
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Before -->
            <div class="bg-red-900/30 backdrop-blur-sm border-2 border-red-500/50 rounded-2xl p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                        <i data-feather="x-circle" class="w-6 h-6 text-white stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Before PEANECH ERP</h3>
                </div>
                
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Multiple disconnected software tools causing data silos</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Manual data entry leading to frequent errors and delays</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Limited visibility into real-time business performance</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Time-consuming reporting processes taking days</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Difficulty scaling operations as business grows</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="minus-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>High operational costs with limited ROI tracking</span>
                    </li>
                </ul>
            </div>
            
            <!-- After -->
            <div class="bg-green-900/30 backdrop-blur-sm border-2 border-green-500/50 rounded-2xl p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                        <i data-feather="check-circle" class="w-6 h-6 text-white stroke-current"></i>
                    </div>
                    <h3 class="text-2xl font-bold">After PEANECH ERP</h3>
                </div>
                
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Unified platform integrating all business processes seamlessly</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Automated workflows reducing errors by 85% and saving hours daily</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Real-time dashboards providing instant business insights</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>One-click reporting with customizable templates and filters</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>Scalable infrastructure growing effortlessly with your business</span>
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check-circle" class="w-5 h-5 text-green-400 mr-3 flex-shrink-0 mt-1 stroke-current"></i>
                        <span>35% cost reduction with comprehensive ROI analytics</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ROI Calculator Preview -->
<section id="calculator" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Calculate Your Potential ROI
            </h2>
            <p class="text-xl text-gray-600">
                See how much PEANECH ERP can save your business
            </p>
        </div>
        
        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 md:p-12">
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Employees</label>
                    <input 
                        type="number" 
                        id="employees" 
                        value="50" 
                        min="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Average Annual Revenue ($)</label>
                    <input 
                        type="number" 
                        id="revenue" 
                        value="1000000" 
                        min="0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
            </div>
            
            <button onclick="calculateROI()" class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-2xl transition-all flex items-center justify-center mx-auto">
                <i data-feather="calculator" class="w-5 h-5 mr-2 stroke-current"></i>
                Calculate My Savings
            </button>
            
            <!-- Results -->
            <div id="roi-results" class="mt-8 hidden">
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Your Estimated Annual Savings</h3>
                    
                    <div class="grid sm:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">
                                $<span id="time-saved">0</span>
                            </div>
                            <div class="text-sm text-gray-600">Time Savings</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">
                                $<span id="efficiency-gain">0</span>
                            </div>
                            <div class="text-sm text-gray-600">Efficiency Gains</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">
                                $<span id="total-roi">0</span>
                            </div>
                            <div class="text-sm text-gray-600">Total Annual ROI</div>
                        </div>
                    </div>
                    
                    <p class="text-center text-gray-600 mt-6 text-sm">
                        * Based on industry averages and client testimonials
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Highlights -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Powerful Features, Tangible Benefits
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Every feature is designed to deliver measurable value
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-shadow">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i data-feather="database" class="w-6 h-6 text-blue-600 stroke-current"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Centralized Data Management</h3>
                        <p class="text-gray-600 mb-4">
                            Single source of truth eliminating data discrepancies and reducing search time by 70%.
                        </p>
                        <div class="inline-flex items-center text-blue-600 font-semibold">
                            <span class="text-2xl mr-2">70%</span>
                            <span class="text-sm">faster data access</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-shadow">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i data-feather="repeat" class="w-6 h-6 text-purple-600 stroke-current"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Workflow Automation</h3>
                        <p class="text-gray-600 mb-4">
                            Automate repetitive tasks and approvals, freeing up your team for strategic work.
                        </p>
                        <div class="inline-flex items-center text-purple-600 font-semibold">
                            <span class="text-2xl mr-2">15hrs</span>
                            <span class="text-sm">saved per employee/week</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-shadow">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i data-feather="smartphone" class="w-6 h-6 text-green-600 stroke-current"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile Access Anywhere</h3>
                        <p class="text-gray-600 mb-4">
                            Access critical business data and approvals from any device, improving response times.
                        </p>
                        <div class="inline-flex items-center text-green-600 font-semibold">
                            <span class="text-2xl mr-2">50%</span>
                            <span class="text-sm">faster decision making</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-shadow">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i data-feather="pie-chart" class="w-6 h-6 text-orange-600 stroke-current"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Advanced Analytics</h3>
                        <p class="text-gray-600 mb-4">
                            Transform raw data into actionable insights with AI-powered analytics and forecasting.
                        </p>
                        <div class="inline-flex items-center text-orange-600 font-semibold">
                            <span class="text-2xl mr-2">40%</span>
                            <span class="text-sm">better forecasting accuracy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories Testimonials -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                What Our Clients Say
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Real results from real businesses
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-500">
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6 italic">
                    "PEANECH ERP reduced our operational costs by 40% in the first year. The automation features alone saved us countless hours of manual work."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
                        S
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Sarah Johnson</div>
                        <div class="text-sm text-gray-600">CFO, TechStart Inc.</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-blue-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-blue-600">40%</div>
                            <div class="text-xs text-gray-600">Cost Reduction</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-blue-600">$180K</div>
                            <div class="text-xs text-gray-600">Annual Savings</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-500">
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6 italic">
                    "The real-time reporting has transformed how we make decisions. We now have insights we never had before, leading to 55% revenue growth."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
                        M
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Michael Chen</div>
                        <div class="text-sm text-gray-600">CEO, GrowthCo</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-purple-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-purple-600">55%</div>
                            <div class="text-xs text-gray-600">Revenue Growth</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-purple-600">3x</div>
                            <div class="text-xs text-gray-600">Faster Reporting</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-500">
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current stroke-current"></i>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6 italic">
                    "Our team collaboration improved dramatically. The unified platform eliminated communication gaps and boosted productivity by 45%."
                </p>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
                        E
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Emily Rodriguez</div>
                        <div class="text-sm text-gray-600">COO, Innovate Ltd.</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-green-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-green-600">45%</div>
                            <div class="text-xs text-gray-600">Productivity Boost</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-600">90%</div>
                            <div class="text-xs text-gray-600">User Adoption</div>
                        </div>
                    </div>
                </div>
            </div>
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
            Join thousands of successful businesses already benefiting from PEANECH ERP
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/register" class="w-full sm:w-auto px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all flex items-center justify-center">
                <i data-feather="rocket" class="w-5 h-5 mr-2 stroke-current"></i>
                Start Your Free Trial
            </a>
            <a href="/contact" class="w-full sm:w-auto px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg border-2 border-white/30 hover:bg-white/30 transition-all flex items-center justify-center">
                <i data-feather="phone" class="w-5 h-5 mr-2 stroke-current"></i>
                Schedule a Demo
            </a>
        </div>
        
        <p class="mt-8 text-sm text-blue-200">
            No credit card required • 30-day free trial • Cancel anytime
        </p>
    </div>
</section>

<script>
function calculateROI() {
    const employees = parseInt(document.getElementById('employees').value) || 0;
    const revenue = parseInt(document.getElementById('revenue').value) || 0;
    
    // Conservative estimates based on industry averages
    const avgHourlyCost = 35; // Average employee hourly cost
    const hoursSavedPerEmployee = 15; // Hours saved per week per employee
    const weeksPerYear = 50;
    
    // Calculate savings
    const timeSaved = Math.round(employees * avgHourlyCost * hoursSavedPerEmployee * weeksPerYear);
    const efficiencyGain = Math.round(revenue * 0.05); // 5% efficiency improvement on revenue
    const totalROI = timeSaved + efficiencyGain;
    
    // Display results
    document.getElementById('time-saved').textContent = timeSaved.toLocaleString();
    document.getElementById('efficiency-gain').textContent = efficiencyGain.toLocaleString();
    document.getElementById('total-roi').textContent = totalROI.toLocaleString();
    document.getElementById('roi-results').classList.remove('hidden');
    
    // Smooth scroll to results
    document.getElementById('roi-results').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/user_layout.php';
?>
