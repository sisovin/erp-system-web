<?php
/**
 * Admin - Departments Management
 */
$pageTitle = 'Departments';
$activeMenu = 'departments';

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
  <div class="flex items-center justify-between flex-wrap gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Departments</h1>
      <p class="text-gray-600">Manage organizational departments and structure</p>
    </div>
    <div class="flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export
      </button>
      <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Add Department
      </button>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Departments -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="briefcase" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Active</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">8</h3>
    <p class="text-sm text-gray-600">Total Departments</p>
  </div>

  <!-- Total Employees -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="users" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Assigned</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">142</h3>
    <p class="text-sm text-gray-600">Total Employees</p>
  </div>

  <!-- Department Heads -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="award" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Leaders</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">8</h3>
    <p class="text-sm text-gray-600">Department Heads</p>
  </div>

  <!-- Average Team Size -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <i data-feather="trending-up" class="w-6 h-6 text-orange-600 stroke-current"></i>
      </div>
      <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">Average</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-1">17.8</h3>
    <p class="text-sm text-gray-600">Avg Team Size</p>
  </div>
</div>

<!-- Departments List -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
  <div class="p-6 border-b border-gray-200">
    <div class="flex items-center justify-between flex-wrap gap-4">
      <h2 class="text-lg font-semibold text-gray-900">All Departments</h2>
      <div class="flex items-center space-x-3">
        <div class="relative">
          <i data-feather="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 stroke-current"></i>
          <input type="text" placeholder="Search departments..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option>All Statuses</option>
          <option>Active</option>
          <option>Inactive</option>
        </select>
      </div>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department Head</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employees</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <!-- IT Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="cpu" class="w-5 h-5 text-blue-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">IT Department</div>
                <div class="text-xs text-gray-500">Technology & Systems</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                JD
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">John Doe</div>
                <div class="text-xs text-gray-500">johnd@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">24 employees</div>
            <div class="text-xs text-gray-500">2 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$420,000</div>
            <div class="text-xs text-green-600">+8.5% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- HR Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="users" class="w-5 h-5 text-green-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Human Resources</div>
                <div class="text-xs text-gray-500">People & Culture</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                SM
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Sarah Miller</div>
                <div class="text-xs text-gray-500">sarah.m@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">12 employees</div>
            <div class="text-xs text-gray-500">1 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$280,000</div>
            <div class="text-xs text-green-600">+5.2% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- Finance Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="dollar-sign" class="w-5 h-5 text-yellow-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Finance</div>
                <div class="text-xs text-gray-500">Accounting & Treasury</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                RJ
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Robert Johnson</div>
                <div class="text-xs text-gray-500">robert.j@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">18 employees</div>
            <div class="text-xs text-gray-500">No changes</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$360,000</div>
            <div class="text-xs text-green-600">+6.1% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- Sales Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="trending-up" class="w-5 h-5 text-purple-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Sales</div>
                <div class="text-xs text-gray-500">Revenue & Growth</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                EB
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Emily Brown</div>
                <div class="text-xs text-gray-500">emily.b@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">32 employees</div>
            <div class="text-xs text-gray-500">5 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$540,000</div>
            <div class="text-xs text-green-600">+12.3% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- Marketing Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="megaphone" class="w-5 h-5 text-pink-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Marketing</div>
                <div class="text-xs text-gray-500">Branding & Communications</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-pink-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                MW
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Mike Wilson</div>
                <div class="text-xs text-gray-500">mike.w@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">16 employees</div>
            <div class="text-xs text-gray-500">3 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$320,000</div>
            <div class="text-xs text-green-600">+9.7% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- Operations Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="settings" class="w-5 h-5 text-indigo-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Operations</div>
                <div class="text-xs text-gray-500">Process & Efficiency</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                LC
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Lisa Chen</div>
                <div class="text-xs text-gray-500">lisa.c@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">28 employees</div>
            <div class="text-xs text-gray-500">1 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$460,000</div>
            <div class="text-xs text-green-600">+7.8% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- Customer Support Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="headphones" class="w-5 h-5 text-teal-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Customer Support</div>
                <div class="text-xs text-gray-500">Service & Relations</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                DT
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">David Taylor</div>
                <div class="text-xs text-gray-500">david.t@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">22 employees</div>
            <div class="text-xs text-gray-500">4 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$340,000</div>
            <div class="text-xs text-green-600">+10.2% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>

        <!-- R&D Department -->
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                <i data-feather="zap" class="w-5 h-5 text-red-600 stroke-current"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-gray-900">Research & Development</div>
                <div class="text-xs text-gray-500">Innovation Lab</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                AK
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900">Anna Kim</div>
                <div class="text-xs text-gray-500">anna.k@example.com</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">14 employees</div>
            <div class="text-xs text-gray-500">1 new this month</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">$380,000</div>
            <div class="text-xs text-green-600">+11.5% vs last year</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-gray-400 hover:text-gray-600 mr-3" title="View Details">
              <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
            </button>
            <button class="text-red-400 hover:text-red-600" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
    <div class="flex items-center justify-between">
      <div class="text-sm text-gray-700">
        Showing <span class="font-semibold">1</span> to <span class="font-semibold">8</span> of <span class="font-semibold">8</span> departments
      </div>
      <div class="flex space-x-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
          Previous
        </button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
          Next
        </button>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
?>
