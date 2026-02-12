<?php
/**
 * Admin Documentation Page
 * Comprehensive documentation management with CRUD operations
 */

$pageTitle = 'Documentation';
$activeMenu = 'documentation';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Documentation</h1>
      <p class="mt-2 text-sm text-gray-600">Create and manage system documentation</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export All
      </button>
      <button id="create-doc-btn" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        New Document
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Total Documents</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">47</p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="book-open" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Across 8 categories</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Published</p>
        <p class="text-3xl font-bold text-green-600 mt-2">42</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="check-circle" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Live documents</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Drafts</p>
        <p class="text-3xl font-bold text-yellow-600 mt-2">5</p>
      </div>
      <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
        <i data-feather="edit" class="w-6 h-6 text-yellow-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Work in progress</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Last Updated</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">2h</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="clock" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">API Integration Guide</p>
  </div>
</div>

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
  <!-- Sidebar - Categories -->
  <div class="lg:col-span-1">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Categories</h3>
        <button class="text-blue-600 hover:text-blue-700">
          <i data-feather="plus" class="w-4 h-4 stroke-current"></i>
        </button>
      </div>
      <div class="space-y-2">
        <a href="#" class="flex items-center justify-between px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="folder" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">All Documents</span>
          </div>
          <span class="text-xs bg-blue-200 px-2 py-1 rounded-full">47</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="code" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">API Guides</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">12</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="user" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">User Guides</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">8</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="tool" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">Admin Guides</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">10</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="package" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">Deployment</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">5</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="shield" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">Security</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">7</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="database" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">Database</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">3</span>
        </a>
        <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          <div class="flex items-center space-x-2">
            <i data-feather="help-circle" class="w-4 h-4 stroke-current"></i>
            <span class="text-sm font-medium">FAQ</span>
          </div>
          <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">2</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="lg:col-span-3">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <!-- Search and Filters -->
      <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
          <div class="flex-1 max-w-lg">
            <div class="relative">
              <i data-feather="search" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 stroke-current"></i>
              <input type="text" placeholder="Search documentation..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
              <option>All Status</option>
              <option>Published</option>
              <option>Draft</option>
              <option>Archived</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
              <option>Sort by: Latest</option>
              <option>Sort by: Title A-Z</option>
              <option>Sort by: Most Viewed</option>
              <option>Sort by: Oldest</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Documents List -->
      <div class="divide-y divide-gray-200">
        <!-- Document Item 1 -->
        <div class="p-6 hover:bg-gray-50 transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">Getting Started Guide</h3>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Published</span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">User Guides</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Complete guide for new users to get started with the ERP system. Covers initial setup, basic navigation, and essential features.</p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                  John Smith
                </span>
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                  Updated Feb 10, 2026
                </span>
                <span class="flex items-center">
                  <i data-feather="eye" class="w-3 h-3 mr-1 stroke-current"></i>
                  1,247 views
                </span>
                <span class="flex items-center">
                  <i data-feather="git-branch" class="w-3 h-3 mr-1 stroke-current"></i>
                  v3.2
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2 ml-4">
              <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="View">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="Duplicate">
                <i data-feather="copy" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Document Item 2 -->
        <div class="p-6 hover:bg-gray-50 transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">API Authentication Guide</h3>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Published</span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">API Guides</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Comprehensive guide on implementing JWT authentication and refresh tokens for API access. Includes code examples in multiple languages.</p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                  Sarah Johnson
                </span>
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                  Updated Feb 12, 2026
                </span>
                <span class="flex items-center">
                  <i data-feather="eye" class="w-3 h-3 mr-1 stroke-current"></i>
                  2,845 views
                </span>
                <span class="flex items-center">
                  <i data-feather="git-branch" class="w-3 h-3 mr-1 stroke-current"></i>
                  v4.0
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2 ml-4">
              <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="View">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="Duplicate">
                <i data-feather="copy" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Document Item 3 -->
        <div class="p-6 hover:bg-gray-50 transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">Database Backup Procedures</h3>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Published</span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Admin Guides</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Step-by-step guide for performing database backups, restoration procedures, and disaster recovery planning.</p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                  Michael Chen
                </span>
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                  Updated Feb 8, 2026
                </span>
                <span class="flex items-center">
                  <i data-feather="eye" class="w-3 h-3 mr-1 stroke-current"></i>
                  892 views
                </span>
                <span class="flex items-center">
                  <i data-feather="git-branch" class="w-3 h-3 mr-1 stroke-current"></i>
                  v2.1
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2 ml-4">
              <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="View">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="Duplicate">
                <i data-feather="copy" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Document Item 4 - Draft -->
        <div class="p-6 hover:bg-gray-50 transition bg-yellow-50">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">Security Best Practices</h3>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Draft</span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Security</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Comprehensive security guidelines for administrators including password policies, access control, and audit logging.</p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                  Emily Davis
                </span>
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                  Created Feb 11, 2026
                </span>
                <span class="flex items-center">
                  <i data-feather="eye" class="w-3 h-3 mr-1 stroke-current"></i>
                  45 views
                </span>
                <span class="flex items-center">
                  <i data-feather="git-branch" class="w-3 h-3 mr-1 stroke-current"></i>
                  v1.0-draft
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2 ml-4">
              <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="View">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="Duplicate">
                <i data-feather="copy" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Document Item 5 -->
        <div class="p-6 hover:bg-gray-50 transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">REST API Endpoints</h3>
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Published</span>
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">API Guides</span>
              </div>
              <p class="text-sm text-gray-600 mb-3">Complete reference of all available REST API endpoints with request/response examples and error handling.</p>
              <div class="flex items-center space-x-4 text-xs text-gray-500">
                <span class="flex items-center">
                  <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                  Alex Turner
                </span>
                <span class="flex items-center">
                  <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                  Updated Feb 9, 2026
                </span>
                <span class="flex items-center">
                  <i data-feather="eye" class="w-3 h-3 mr-1 stroke-current"></i>
                  3,421 views
                </span>
                <span class="flex items-center">
                  <i data-feather="git-branch" class="w-3 h-3 mr-1 stroke-current"></i>
                  v5.3
                </span>
              </div>
            </div>
            <div class="flex items-center space-x-2 ml-4">
              <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="View">
                <i data-feather="eye" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="Duplicate">
                <i data-feather="copy" class="w-4 h-4 stroke-current"></i>
              </button>
              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="p-6 border-t border-gray-200 flex items-center justify-between">
        <p class="text-sm text-gray-600">Showing 5 of 47 documents</p>
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
</div>

<!-- Create/Edit Modal -->
<div id="doc-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeDocModal()"></div>

    <!-- Modal panel -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
      <div class="bg-white px-6 pt-6 pb-4">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-900" id="modal-title">Create New Document</h3>
          <button onclick="closeDocModal()" class="text-gray-400 hover:text-gray-600">
            <i data-feather="x" class="w-6 h-6 stroke-current"></i>
          </button>
        </div>

        <form id="doc-form" class="space-y-6">
          <!-- Title -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" id="doc-title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter document title">
          </div>

          <!-- Category and Status -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
              <select id="doc-category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Select category</option>
                <option value="api">API Guides</option>
                <option value="user">User Guides</option>
                <option value="admin">Admin Guides</option>
                <option value="deployment">Deployment</option>
                <option value="security">Security</option>
                <option value="database">Database</option>
                <option value="faq">FAQ</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
              <select id="doc-status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
          </div>

          <!-- Description -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
            <textarea id="doc-description" required rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Brief description of the document"></textarea>
          </div>

          <!-- Content Editor -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <div class="border border-gray-300 rounded-lg">
              <!-- Toolbar -->
              <div class="bg-gray-50 border-b border-gray-300 px-4 py-2 flex items-center space-x-2">
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Bold">
                  <i data-feather="bold" class="w-4 h-4 stroke-current"></i>
                </button>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Italic">
                  <i data-feather="italic" class="w-4 h-4 stroke-current"></i>
                </button>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Underline">
                  <i data-feather="underline" class="w-4 h-4 stroke-current"></i>
                </button>
                <div class="w-px h-6 bg-gray-300"></div>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Link">
                  <i data-feather="link" class="w-4 h-4 stroke-current"></i>
                </button>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Image">
                  <i data-feather="image" class="w-4 h-4 stroke-current"></i>
                </button>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Code">
                  <i data-feather="code" class="w-4 h-4 stroke-current"></i>
                </button>
                <div class="w-px h-6 bg-gray-300"></div>
                <button type="button" class="p-2 hover:bg-gray-200 rounded" title="List">
                  <i data-feather="list" class="w-4 h-4 stroke-current"></i>
                </button>
              </div>
              <!-- Editor Area -->
              <textarea id="doc-content" required rows="12" class="w-full px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Write your documentation content here...

Supports Markdown formatting:
# Heading 1
## Heading 2
**Bold text**
*Italic text*
- List item
[Link text](url)
`code`"></textarea>
            </div>
          </div>

          <!-- Version and Tags -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Version</label>
              <input type="text" id="doc-version" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., v1.0">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
              <input type="text" id="doc-tags" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Comma-separated tags">
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
        <button onclick="closeDocModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          Cancel
        </button>
        <button onclick="saveDocument()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
          Save Document
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Open create document modal
  document.getElementById('create-doc-btn').addEventListener('click', () => {
    document.getElementById('modal-title').textContent = 'Create New Document';
    document.getElementById('doc-form').reset();
    document.getElementById('doc-modal').classList.remove('hidden');
    feather.replace();
  });

  // Close modal
  function closeDocModal() {
    document.getElementById('doc-modal').classList.add('hidden');
  }

  // Save document (placeholder function)
  function saveDocument() {
    const title = document.getElementById('doc-title').value;
    const category = document.getElementById('doc-category').value;
    const status = document.getElementById('doc-status').value;
    const description = document.getElementById('doc-description').value;
    const content = document.getElementById('doc-content').value;
    const version = document.getElementById('doc-version').value;
    const tags = document.getElementById('doc-tags').value;

    // Validate required fields
    if (!title || !category || !status || !description || !content) {
      alert('Please fill in all required fields');
      return;
    }

    // Here you would normally send this data to the server
    console.log('Saving document:', {
      title, category, status, description, content, version, tags
    });

    alert('Document saved successfully!');
    closeDocModal();
    
    // In a real application, you would refresh the documents list here
  }

  // Initialize Feather icons
  feather.replace();
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
