<?php
/**
 * Admin Support Page
 * Comprehensive support ticket management with CRUD operations
 */

$pageTitle = 'Support Center';
$activeMenu = 'support';

// Start output buffering
ob_start();
?>

<!-- Header -->
<div class="mb-8">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Support Center</h1>
      <p class="mt-2 text-sm text-gray-600">Manage support tickets and help requests</p>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
      <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
        <i data-feather="download" class="w-4 h-4 mr-2 stroke-current"></i>
        Export Tickets
      </button>
      <button id="create-ticket-btn" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        New Ticket
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Open Tickets</p>
        <p class="text-3xl font-bold text-orange-600 mt-2">23</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <i data-feather="alert-circle" class="w-6 h-6 text-orange-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">+5 from yesterday</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">In Progress</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">12</p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-feather="clock" class="w-6 h-6 text-blue-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Being worked on</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Resolved Today</p>
        <p class="text-3xl font-bold text-green-600 mt-2">18</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-feather="check-circle" class="w-6 h-6 text-green-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">Target: 15/day</p>
  </div>

  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Avg Response</p>
        <p class="text-3xl font-bold text-purple-600 mt-2">2.4h</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <i data-feather="zap" class="w-6 h-6 text-purple-600 stroke-current"></i>
      </div>
    </div>
    <p class="text-sm text-gray-500 mt-4">-0.3h improvement</p>
  </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
  <!-- Tabs -->
  <div class="border-b border-gray-200">
    <nav class="flex -mb-px overflow-x-auto">
      <button class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-blue-600 text-blue-600" data-tab="all">
        All Tickets
        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">53</span>
      </button>
      <button class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="open">
        Open
        <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">23</span>
      </button>
      <button class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="progress">
        In Progress
        <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">12</span>
      </button>
      <button class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="resolved">
        Resolved
        <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">18</span>
      </button>
    </nav>
  </div>

  <!-- Tab Content: All Tickets -->
  <div class="tab-content" data-tab="all">
    <!-- Search and Filters -->
    <div class="p-6 border-b border-gray-200">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
        <div class="flex-1 max-w-lg">
          <div class="relative">
            <i data-feather="search" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 stroke-current"></i>
            <input type="text" placeholder="Search tickets..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
        </div>
        <div class="flex items-center space-x-3">
          <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <option>All Categories</option>
            <option>Technical Support</option>
            <option>Billing</option>
            <option>General Inquiry</option>
            <option>Feature Request</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <option>All Priorities</option>
            <option>Critical</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <option>Sort by: Newest</option>
            <option>Sort by: Oldest</option>
            <option>Sort by: Priority</option>
            <option>Sort by: Last Updated</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Tickets List -->
    <div class="divide-y divide-gray-200">
      <!-- Ticket Item 1 - Critical -->
      <div class="p-6 hover:bg-gray-50 transition cursor-pointer" onclick="openTicketDetail(1)">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <span class="text-sm font-semibold text-gray-500">#TICKET-1001</span>
              <h3 class="text-lg font-semibold text-gray-900">Critical Database Connection Failure</h3>
              <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Critical</span>
              <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">Open</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Unable to connect to production database. Multiple users affected. Error: "Connection timeout after 30s"</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span class="flex items-center">
                <i data-feather="tag" class="w-3 h-3 mr-1 stroke-current"></i>
                Technical Support
              </span>
              <span class="flex items-center">
                <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                John Smith
              </span>
              <span class="flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                Feb 12, 2026 - 10:45 AM
              </span>
              <span class="flex items-center">
                <i data-feather="message-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                3 replies
              </span>
              <span class="flex items-center">
                <i data-feather="user-check" class="w-3 h-3 mr-1 stroke-current"></i>
                Assigned to: Michael Chen
              </span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button onclick="event.stopPropagation(); editTicket(1)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button onclick="event.stopPropagation(); deleteTicket(1)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Ticket Item 2 - High Priority -->
      <div class="p-6 hover:bg-gray-50 transition cursor-pointer" onclick="openTicketDetail(2)">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <span class="text-sm font-semibold text-gray-500">#TICKET-1002</span>
              <h3 class="text-lg font-semibold text-gray-900">Email Notifications Not Sending</h3>
              <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">High</span>
              <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">In Progress</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Users reporting they're not receiving password reset emails. SMTP configuration may need review.</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span class="flex items-center">
                <i data-feather="tag" class="w-3 h-3 mr-1 stroke-current"></i>
                Technical Support
              </span>
              <span class="flex items-center">
                <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                Sarah Johnson
              </span>
              <span class="flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                Feb 12, 2026 - 9:20 AM
              </span>
              <span class="flex items-center">
                <i data-feather="message-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                5 replies
              </span>
              <span class="flex items-center">
                <i data-feather="user-check" class="w-3 h-3 mr-1 stroke-current"></i>
                Assigned to: Emily Davis
              </span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button onclick="event.stopPropagation(); editTicket(2)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button onclick="event.stopPropagation(); deleteTicket(2)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Ticket Item 3 - Medium Priority -->
      <div class="p-6 hover:bg-gray-50 transition cursor-pointer" onclick="openTicketDetail(3)">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <span class="text-sm font-semibold text-gray-500">#TICKET-1003</span>
              <h3 class="text-lg font-semibold text-gray-900">Dashboard Loading Performance</h3>
              <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Medium</span>
              <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">In Progress</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Admin dashboard takes 8-10 seconds to load. Need to optimize database queries and consider caching.</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span class="flex items-center">
                <i data-feather="tag" class="w-3 h-3 mr-1 stroke-current"></i>
                Technical Support
              </span>
              <span class="flex items-center">
                <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                Alex Turner
              </span>
              <span class="flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                Feb 11, 2026 - 4:15 PM
              </span>
              <span class="flex items-center">
                <i data-feather="message-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                2 replies
              </span>
              <span class="flex items-center">
                <i data-feather="user-check" class="w-3 h-3 mr-1 stroke-current"></i>
                Assigned to: Michael Chen
              </span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button onclick="event.stopPropagation(); editTicket(3)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button onclick="event.stopPropagation(); deleteTicket(3)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Ticket Item 4 - Billing -->
      <div class="p-6 hover:bg-gray-50 transition cursor-pointer" onclick="openTicketDetail(4)">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <span class="text-sm font-semibold text-gray-500">#TICKET-1004</span>
              <h3 class="text-lg font-semibold text-gray-900">Invoice Discrepancy - February</h3>
              <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Medium</span>
              <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">Open</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">February invoice shows $2,500 but contract states $2,000. Please review and issue credit if applicable.</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span class="flex items-center">
                <i data-feather="tag" class="w-3 h-3 mr-1 stroke-current"></i>
                Billing
              </span>
              <span class="flex items-center">
                <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                Robert Lee
              </span>
              <span class="flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                Feb 11, 2026 - 2:30 PM
              </span>
              <span class="flex items-center">
                <i data-feather="message-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                1 reply
              </span>
              <span class="flex items-center">
                <i data-feather="user-check" class="w-3 h-3 mr-1 stroke-current"></i>
                Assigned to: Lisa Wang
              </span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button onclick="event.stopPropagation(); editTicket(4)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button onclick="event.stopPropagation(); deleteTicket(4)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Ticket Item 5 - Feature Request -->
      <div class="p-6 hover:bg-gray-50 transition cursor-pointer" onclick="openTicketDetail(5)">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center space-x-3 mb-2">
              <span class="text-sm font-semibold text-gray-500">#TICKET-1005</span>
              <h3 class="text-lg font-semibold text-gray-900">Add Export to PDF Feature</h3>
              <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Low</span>
              <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Resolved</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">Request to add PDF export functionality for all reports. Users prefer PDF format for archiving purposes.</p>
            <div class="flex items-center space-x-4 text-xs text-gray-500">
              <span class="flex items-center">
                <i data-feather="tag" class="w-3 h-3 mr-1 stroke-current"></i>
                Feature Request
              </span>
              <span class="flex items-center">
                <i data-feather="user" class="w-3 h-3 mr-1 stroke-current"></i>
                Jennifer Brown
              </span>
              <span class="flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1 stroke-current"></i>
                Feb 10, 2026 - 11:00 AM
              </span>
              <span class="flex items-center">
                <i data-feather="message-circle" class="w-3 h-3 mr-1 stroke-current"></i>
                7 replies
              </span>
              <span class="flex items-center">
                <i data-feather="user-check" class="w-3 h-3 mr-1 stroke-current"></i>
                Assigned to: Alex Turner
              </span>
            </div>
          </div>
          <div class="flex items-center space-x-2 ml-4">
            <button onclick="event.stopPropagation(); editTicket(5)" class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Edit">
              <i data-feather="edit-2" class="w-4 h-4 stroke-current"></i>
            </button>
            <button onclick="event.stopPropagation(); deleteTicket(5)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Delete">
              <i data-feather="trash-2" class="w-4 h-4 stroke-current"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="p-6 border-t border-gray-200 flex items-center justify-between">
      <p class="text-sm text-gray-600">Showing 5 of 53 tickets</p>
      <div class="flex items-center space-x-2">
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
      </div>
    </div>
  </div>

  <!-- Tab Content: Open, In Progress, Resolved (similar structure) -->
  <div class="tab-content hidden" data-tab="open">
    <div class="p-6 text-center">
      <p class="text-gray-600">23 open tickets. Use filters above to refine results.</p>
    </div>
  </div>

  <div class="tab-content hidden" data-tab="progress">
    <div class="p-6 text-center">
      <p class="text-gray-600">12 tickets in progress. Use filters above to refine results.</p>
    </div>
  </div>

  <div class="tab-content hidden" data-tab="resolved">
    <div class="p-6 text-center">
      <p class="text-gray-600">18 resolved tickets today. Use filters above to refine results.</p>
    </div>
  </div>
</div>

<!-- Create/Edit Ticket Modal -->
<div id="ticket-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeTicketModal()"></div>

    <!-- Modal panel -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
      <div class="bg-white px-6 pt-6 pb-4">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-900" id="ticket-modal-title">Create New Ticket</h3>
          <button onclick="closeTicketModal()" class="text-gray-400 hover:text-gray-600">
            <i data-feather="x" class="w-6 h-6 stroke-current"></i>
          </button>
        </div>

        <form id="ticket-form" class="space-y-6">
          <!-- Subject -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
            <input type="text" id="ticket-subject" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Brief description of the issue">
          </div>

          <!-- Category and Priority -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
              <select id="ticket-category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Select category</option>
                <option value="technical">Technical Support</option>
                <option value="billing">Billing</option>
                <option value="general">General Inquiry</option>
                <option value="feature">Feature Request</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
              <select id="ticket-priority" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
                <option value="critical">Critical</option>
              </select>
            </div>
          </div>

          <!-- Status and Assignee -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
              <select id="ticket-status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="open" selected>Open</option>
                <option value="progress">In Progress</option>
                <option value="resolved">Resolved</option>
                <option value="closed">Closed</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Assign To</label>
              <select id="ticket-assignee" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Unassigned</option>
                <option value="michael">Michael Chen</option>
                <option value="emily">Emily Davis</option>
                <option value="alex">Alex Turner</option>
                <option value="lisa">Lisa Wang</option>
              </select>
            </div>
          </div>

          <!-- Description -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
            <textarea id="ticket-description" required rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Provide detailed information about the issue or request..."></textarea>
          </div>

          <!-- Attachments -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Attachments</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer">
              <i data-feather="upload" class="w-8 h-8 mx-auto text-gray-400 stroke-current mb-2"></i>
              <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
              <p class="text-xs text-gray-500 mt-1">PNG, JPG, PDF up to 10MB</p>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
        <button onclick="closeTicketModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
          Cancel
        </button>
        <button onclick="saveTicket()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
          Create Ticket
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Ticket Detail Modal -->
<div id="ticket-detail-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeTicketDetailModal()"></div>

    <!-- Modal panel -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
      <div class="bg-white">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h3 class="text-xl font-bold text-gray-900">Ticket #TICKET-1001</h3>
            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Critical</span>
            <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">Open</span>
          </div>
          <button onclick="closeTicketDetailModal()" class="text-gray-400 hover:text-gray-600">
            <i data-feather="x" class="w-6 h-6 stroke-current"></i>
          </button>
        </div>

        <!-- Ticket Info -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
              <p class="text-xs font-medium text-gray-500">Reporter</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">John Smith</p>
            </div>
            <div>
              <p class="text-xs font-medium text-gray-500">Assignee</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">Michael Chen</p>
            </div>
            <div>
              <p class="text-xs font-medium text-gray-500">Category</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">Technical Support</p>
            </div>
            <div>
              <p class="text-xs font-medium text-gray-500">Created</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">Feb 12, 2026 10:45 AM</p>
            </div>
          </div>
        </div>

        <!-- Ticket Content -->
        <div class="px-6 py-4 max-h-96 overflow-y-auto">
          <h4 class="text-lg font-semibold text-gray-900 mb-3">Critical Database Connection Failure</h4>
          <p class="text-sm text-gray-700 mb-4">
            Unable to connect to production database. Multiple users affected. Error: "Connection timeout after 30s"
          </p>
          <p class="text-sm text-gray-700 mb-4">
            This issue started occurring around 10:30 AM today. All users attempting to access the system are seeing connection timeout errors. 
            The application logs show repeated attempts to connect to the database server at <code class="bg-gray-100 px-2 py-1 rounded">db.example.com:5432</code> but all attempts time out after 30 seconds.
          </p>

          <!-- Conversation Thread -->
          <div class="mt-6 border-t border-gray-200 pt-4">
            <h5 class="text-sm font-semibold text-gray-900 mb-4">Conversation</h5>
            
            <!-- Reply 1 -->
            <div class="mb-4 pl-4 border-l-2 border-blue-200">
              <div class="flex items-center space-x-2 mb-2">
                <span class="text-sm font-semibold text-gray-900">Michael Chen</span>
                <span class="text-xs text-gray-500">10:50 AM</span>
              </div>
              <p class="text-sm text-gray-700">I'm looking into this now. Checking database server status and network connectivity.</p>
            </div>

            <!-- Reply 2 -->
            <div class="mb-4 pl-4 border-l-2 border-blue-200">
              <div class="flex items-center space-x-2 mb-2">
                <span class="text-sm font-semibold text-gray-900">Michael Chen</span>
                <span class="text-xs text-gray-500">10:55 AM</span>
              </div>
              <p class="text-sm text-gray-700">Database server is running but CPU usage is at 98%. Investigating which queries are causing the load.</p>
            </div>

            <!-- Reply 3 -->
            <div class="mb-4 pl-4 border-l-2 border-blue-200">
              <div class="flex items-center space-x-2 mb-2">
                <span class="text-sm font-semibold text-gray-900">John Smith</span>
                <span class="text-xs text-gray-500">11:00 AM</span>
              </div>
              <p class="text-sm text-gray-700">Thanks for the quick response. Users are getting frustrated. Any ETA on resolution?</p>
            </div>
          </div>

          <!-- Reply Form -->
          <div class="mt-6 border-t border-gray-200 pt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Add Reply</label>
            <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Type your reply..."></textarea>
            <div class="mt-3 flex justify-end">
              <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
                Send Reply
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Tab switching
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const tabName = btn.dataset.tab;
      
      // Update button styles
      document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('border-blue-600', 'text-blue-600');
        b.classList.add('border-transparent', 'text-gray-500');
      });
      btn.classList.remove('border-transparent', 'text-gray-500');
      btn.classList.add('border-blue-600', 'text-blue-600');
      
      // Show/hide content
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
      });
      document.querySelector(`.tab-content[data-tab="${tabName}"]`).classList.remove('hidden');
      
      feather.replace();
    });
  });

  // Open create ticket modal
  document.getElementById('create-ticket-btn').addEventListener('click', () => {
    document.getElementById('ticket-modal-title').textContent = 'Create New Ticket';
    document.getElementById('ticket-form').reset();
    document.getElementById('ticket-modal').classList.remove('hidden');
    feather.replace();
  });

  // Close ticket modal
  function closeTicketModal() {
    document.getElementById('ticket-modal').classList.add('hidden');
  }

  // Edit ticket (placeholder function)
  function editTicket(ticketId) {
    document.getElementById('ticket-modal-title').textContent = `Edit Ticket #TICKET-100${ticketId}`;
    // Load ticket data here
    document.getElementById('ticket-modal').classList.remove('hidden');
    feather.replace();
  }

  // Delete ticket (placeholder function)
  function deleteTicket(ticketId) {
    if (confirm(`Are you sure you want to delete ticket #TICKET-100${ticketId}?`)) {
      console.log('Deleting ticket:', ticketId);
      alert('Ticket deleted successfully!');
      // In a real application, you would send a DELETE request to the server
    }
  }

  // Save ticket (placeholder function)
  function saveTicket() {
    const subject = document.getElementById('ticket-subject').value;
    const category = document.getElementById('ticket-category').value;
    const priority = document.getElementById('ticket-priority').value;
    const status = document.getElementById('ticket-status').value;
    const assignee = document.getElementById('ticket-assignee').value;
    const description = document.getElementById('ticket-description').value;

    // Validate required fields
    if (!subject || !category || !priority || !status || !description) {
      alert('Please fill in all required fields');
      return;
    }

    // Here you would normally send this data to the server
    console.log('Saving ticket:', {
      subject, category, priority, status, assignee, description
    });

    alert('Ticket created successfully!');
    closeTicketModal();
    
    // In a real application, you would refresh the tickets list here
  }

  // Open ticket detail modal
  function openTicketDetail(ticketId) {
    document.getElementById('ticket-detail-modal').classList.remove('hidden');
    feather.replace();
  }

  // Close ticket detail modal
  function closeTicketDetailModal() {
    document.getElementById('ticket-detail-modal').classList.add('hidden');
  }

  // Initialize Feather icons
  feather.replace();
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
