<?php
/**
 * Admin Integrations Page
 * Manage third-party integrations and API connections
 */

$pageTitle = 'Integrations';
$activeMenu = 'integrations';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Integrations</h1>
      <p class="mt-2 text-sm text-gray-600">Connect and manage third-party services and APIs</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="refresh-cw" class="w-4 h-4 mr-2 stroke-current"></i>
        Refresh Status
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Add Integration
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Integrations</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">18</p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="grid" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Available services</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Active Connections</p>
        <p class="text-3xl font-bold text-green-600 mt-2">12</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="link" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Currently connected</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">API Calls Today</p>
        <p class="text-3xl font-bold text-purple-600 mt-2">8.4K</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="activity" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-green-600 mt-4">↑ 12% from yesterday</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Sync Status</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">98.7%</p>
      </div>
      <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
        <i data-feather="check-circle" class="w-6 h-6 text-yellow-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Last sync: 2 min ago</p>
  </div>
</div>

<!-- Tabs -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
  <div class="border-b border-gray-200">
    <nav class="flex -mb-px">
      <button class="tab-button active px-6 py-4 text-sm font-medium border-b-2 border-blue-600 text-blue-600" data-tab="all">
        All Integrations
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="connected">
        Connected (12)
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="available">
        Available (6)
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="webhooks">
        Webhooks
      </button>
      <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="logs">
        Activity Logs
      </button>
    </nav>
  </div>

  <!-- Tab Content: All Integrations -->
  <div class="tab-content active p-6" id="all">
    <!-- Search and Filter -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
      <div class="flex-1 max-w-lg">
        <div class="relative">
          <i data-feather="search" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 stroke-current"></i>
          <input type="text" placeholder="Search integrations..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option>All Categories</option>
          <option>Communication</option>
          <option>Storage</option>
          <option>Development</option>
          <option>Analytics</option>
          <option>CRM</option>
        </select>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option>All Status</option>
          <option>Connected</option>
          <option>Available</option>
          <option>Error</option>
        </select>
      </div>
    </div>

    <!-- Integrations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Integration Card: Slack -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <i data-feather="slack" class="w-7 h-7 text-purple-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Slack</h3>
        <p class="text-sm text-gray-600 mb-4">Team communication and notifications</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 5 min ago</span>
          <span>547 messages</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: AWS S3 -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
            <i data-feather="database" class="w-7 h-7 text-orange-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">AWS S3</h3>
        <p class="text-sm text-gray-600 mb-4">Cloud storage for files and backups</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 1 min ago</span>
          <span>2.4 GB stored</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: GitHub -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
            <i data-feather="github" class="w-7 h-7 text-white stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">GitHub</h3>
        <p class="text-sm text-gray-600 mb-4">Version control and code management</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 10 min ago</span>
          <span>24 repositories</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: Google Analytics -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-feather="bar-chart-2" class="w-7 h-7 text-blue-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Google Analytics</h3>
        <p class="text-sm text-gray-600 mb-4">Website and application analytics</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 15 min ago</span>
          <span>1.2K views today</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: Microsoft Teams -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
            <i data-feather="message-square" class="w-7 h-7 text-indigo-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Microsoft Teams</h3>
        <p class="text-sm text-gray-600 mb-4">Team collaboration and meetings</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 3 min ago</span>
          <span>8 channels</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: Salesforce -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
            <i data-feather="users" class="w-7 h-7 text-cyan-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Connected
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Salesforce</h3>
        <p class="text-sm text-gray-600 mb-4">Customer relationship management</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Last sync: 20 min ago</span>
          <span>342 contacts</span>
        </div>
        <div class="flex items-center space-x-2">
          <button class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
            Configure
          </button>
          <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
            Disconnect
          </button>
        </div>
      </div>

      <!-- Integration Card: Stripe (Available) -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition opacity-75">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <i data-feather="credit-card" class="w-7 h-7 text-purple-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">
            Available
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Stripe</h3>
        <p class="text-sm text-gray-600 mb-4">Payment processing and billing</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Not connected</span>
          <span>-</span>
        </div>
        <button class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition text-sm font-medium">
          Connect
        </button>
      </div>

      <!-- Integration Card: SendGrid (Available) -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition opacity-75">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-feather="mail" class="w-7 h-7 text-blue-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">
            Available
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">SendGrid</h3>
        <p class="text-sm text-gray-600 mb-4">Email delivery and marketing</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Not connected</span>
          <span>-</span>
        </div>
        <button class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition text-sm font-medium">
          Connect
        </button>
      </div>

      <!-- Integration Card: Twilio (Available) -->
      <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition opacity-75">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
            <i data-feather="phone" class="w-7 h-7 text-red-600 stroke-current"></i>
          </div>
          <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">
            Available
          </span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Twilio</h3>
        <p class="text-sm text-gray-600 mb-4">SMS and voice communications</p>
        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
          <span>Not connected</span>
          <span>-</span>
        </div>
        <button class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition text-sm font-medium">
          Connect
        </button>
      </div>
    </div>
  </div>

  <!-- Tab Content: Connected -->
  <div class="tab-content hidden p-6" id="connected">
    <p class="text-gray-600">Showing only connected integrations (12 active connections)</p>
  </div>

  <!-- Tab Content: Available -->
  <div class="tab-content hidden p-6" id="available">
    <p class="text-gray-600">Showing available integrations ready to connect (6 available)</p>
  </div>

  <!-- Tab Content: Webhooks -->
  <div class="tab-content hidden p-6" id="webhooks">
    <div class="mb-6">
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Add Webhook
      </button>
    </div>

    <!-- Webhooks List -->
    <div class="space-y-4">
      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <h3 class="text-lg font-semibold text-gray-900">User Registration Webhook</h3>
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Active</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">https://api.example.com/webhooks/user-registration</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span>Events: user.created, user.updated</span>
              <span>Last triggered: 2h ago</span>
              <span>Success rate: 99.8%</span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <h3 class="text-lg font-semibold text-gray-900">Order Processing Webhook</h3>
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Active</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">https://api.example.com/webhooks/order-processing</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span>Events: order.created, order.completed</span>
              <span>Last triggered: 15m ago</span>
              <span>Success rate: 100%</span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="bg-white border border-gray-200 rounded-lg p-4">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <h3 class="text-lg font-semibold text-gray-900">Payment Notification</h3>
              <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Paused</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">https://api.example.com/webhooks/payment-notification</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span>Events: payment.success, payment.failed</span>
              <span>Last triggered: 5d ago</span>
              <span>Success rate: 97.2%</span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Activity Logs -->
  <div class="tab-content hidden p-6" id="logs">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Integration</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-02-12 14:23:15</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-purple-100 rounded flex items-center justify-center mr-3">
                  <i data-feather="slack" class="w-4 h-4 text-purple-600 stroke-current"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">Slack</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Message Sent</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Success</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Notification sent to #general</td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-02-12 14:18:42</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-orange-100 rounded flex items-center justify-center mr-3">
                  <i data-feather="database" class="w-4 h-4 text-orange-600 stroke-current"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">AWS S3</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">File Upload</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Success</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">backup_2026-02-12.zip (245 MB)</td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-02-12 14:12:08</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-900 rounded flex items-center justify-center mr-3">
                  <i data-feather="github" class="w-4 h-4 text-white stroke-current"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">GitHub</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Repository Sync</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Success</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">24 repositories synced</td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-02-12 13:55:33</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center mr-3">
                  <i data-feather="bar-chart-2" class="w-4 h-4 text-blue-600 stroke-current"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">Google Analytics</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Data Fetch</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Success</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Daily metrics retrieved</td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2026-02-12 13:42:19</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-cyan-100 rounded flex items-center justify-center mr-3">
                  <i data-feather="users" class="w-4 h-4 text-cyan-600 stroke-current"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">Salesforce</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Contact Sync</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Failed</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">API rate limit exceeded</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
      <p class="text-sm text-gray-600">Showing 1-5 of 247 activity logs</p>
      <div class="flex items-center space-x-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Tab switching
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      const tabName = button.dataset.tab;
      
      // Update button states
      document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'border-blue-600', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
      });
      button.classList.add('active', 'border-blue-600', 'text-blue-600');
      button.classList.remove('border-transparent', 'text-gray-500');
      
      // Update content visibility
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.classList.remove('active');
      });
      const activeContent = document.getElementById(tabName);
      if (activeContent) {
        activeContent.classList.remove('hidden');
        activeContent.classList.add('active');
      }
      
      // Re-initialize Feather icons for newly displayed content
      feather.replace();
    });
  });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
