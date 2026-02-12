<?php
$pageTitle = 'Jobs & Careers Management';
$activeMenu = 'jobs';

ob_start();
?>

<!-- Header with Actions -->
<div class="mb-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Jobs & Careers</h1>
      <p class="mt-2 text-sm text-gray-600">Manage job postings, applications, and recruitment pipeline</p>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="exportJobs()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="download" class="w-4 h-4 mr-2"></i>
        Export
      </button>
      <button onclick="openJobModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i>
        Post New Job
      </button>
    </div>
  </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Active Postings -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-blue-100 rounded-lg">
        <i data-feather="briefcase" class="w-6 h-6 text-blue-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Active</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">28</h3>
    <p class="text-sm text-gray-600 mt-1">Active Job Postings</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">+4 this week</span>
    </div>
  </div>

  <!-- Total Applications -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-purple-100 rounded-lg">
        <i data-feather="file-text" class="w-6 h-6 text-purple-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full">Total</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">1,247</h3>
    <p class="text-sm text-gray-600 mt-1">Total Applications</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">+89 this week</span>
    </div>
  </div>

  <!-- Pending Review -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-yellow-100 rounded-lg">
        <i data-feather="clock" class="w-6 h-6 text-yellow-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-yellow-100 text-yellow-800 rounded-full">Review</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">156</h3>
    <p class="text-sm text-gray-600 mt-1">Pending Review</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-red-600 font-medium">Needs attention</span>
    </div>
  </div>

  <!-- Hired This Month -->
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
    <div class="flex items-center justify-between mb-4">
      <div class="p-3 bg-green-100 rounded-lg">
        <i data-feather="user-check" class="w-6 h-6 text-green-600"></i>
      </div>
      <span class="text-xs font-semibold px-2.5 py-1 bg-purple-100 text-purple-800 rounded-full">Success</span>
    </div>
    <h3 class="text-2xl font-bold text-gray-900">12</h3>
    <p class="text-sm text-gray-600 mt-1">Hired This Month</p>
    <div class="mt-4 flex items-center text-sm">
      <span class="text-green-600 font-medium">92% fill rate</span>
    </div>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
      <button onclick="switchTab('active')" id="tab-active" class="tab-button border-b-2 border-blue-600 text-blue-600 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Active Postings (28)
      </button>
      <button onclick="switchTab('applications')" id="tab-applications" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Applications (1,247)
      </button>
      <button onclick="switchTab('candidates')" id="tab-candidates" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Candidates (892)
      </button>
      <button onclick="switchTab('pipeline')" id="tab-pipeline" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
        Pipeline
      </button>
    </nav>
  </div>
</div>

<!-- Active Postings Tab -->
<div id="content-active" class="tab-content">
  <!-- Filters -->
  <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
        <input type="text" placeholder="Search jobs..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option value="">All Departments</option>
          <option value="engineering">Engineering</option>
          <option value="sales">Sales</option>
          <option value="marketing">Marketing</option>
          <option value="hr">Human Resources</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option value="">All Locations</option>
          <option value="remote">Remote</option>
          <option value="new-york">New York</option>
          <option value="san-francisco">San Francisco</option>
          <option value="london">London</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option value="">All Types</option>
          <option value="full-time">Full-time</option>
          <option value="part-time">Part-time</option>
          <option value="contract">Contract</option>
          <option value="internship">Internship</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Job Listings -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <?php
    $jobs = [
      [
        'id' => 1,
        'title' => 'Senior Software Engineer',
        'department' => 'Engineering',
        'location' => 'San Francisco, CA',
        'type' => 'Full-time',
        'posted' => '2 days ago',
        'applications' => 47,
        'status' => 'Active',
        'salary' => '$140k - $180k',
        'urgency' => 'high'
      ],
      [
        'id' => 2,
        'title' => 'Product Manager',
        'department' => 'Product',
        'location' => 'Remote',
        'type' => 'Full-time',
        'posted' => '5 days ago',
        'applications' => 89,
        'status' => 'Active',
        'salary' => '$120k - $150k',
        'urgency' => 'high'
      ],
      [
        'id' => 3,
        'title' => 'UX/UI Designer',
        'department' => 'Design',
        'location' => 'New York, NY',
        'type' => 'Full-time',
        'posted' => '1 week ago',
        'applications' => 124,
        'status' => 'Active',
        'salary' => '$90k - $120k',
        'urgency' => 'medium'
      ],
      [
        'id' => 4,
        'title' => 'Sales Account Executive',
        'department' => 'Sales',
        'location' => 'Chicago, IL',
        'type' => 'Full-time',
        'posted' => '3 days ago',
        'applications' => 56,
        'status' => 'Active',
        'salary' => '$80k - $100k + Commission',
        'urgency' => 'high'
      ],
      [
        'id' => 5,
        'title' => 'Marketing Specialist',
        'department' => 'Marketing',
        'location' => 'Remote',
        'type' => 'Full-time',
        'posted' => '1 week ago',
        'applications' => 78,
        'status' => 'Active',
        'salary' => '$70k - $90k',
        'urgency' => 'medium'
      ],
      [
        'id' => 6,
        'title' => 'DevOps Engineer',
        'department' => 'Engineering',
        'location' => 'Austin, TX',
        'type' => 'Full-time',
        'posted' => '4 days ago',
        'applications' => 42,
        'status' => 'Active',
        'salary' => '$130k - $160k',
        'urgency' => 'high'
      ],
      [
        'id' => 7,
        'title' => 'HR Coordinator',
        'department' => 'Human Resources',
        'location' => 'Boston, MA',
        'type' => 'Full-time',
        'posted' => '2 weeks ago',
        'applications' => 91,
        'status' => 'Active',
        'salary' => '$55k - $70k',
        'urgency' => 'low'
      ],
      [
        'id' => 8,
        'title' => 'Data Scientist',
        'department' => 'Analytics',
        'location' => 'San Francisco, CA',
        'type' => 'Full-time',
        'posted' => '6 days ago',
        'applications' => 103,
        'status' => 'Active',
        'salary' => '$150k - $190k',
        'urgency' => 'high'
      ]
    ];

    foreach ($jobs as $job):
      $urgencyColor = $job['urgency'] === 'high' ? 'red' : ($job['urgency'] === 'medium' ? 'yellow' : 'green');
    ?>
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition">
        <!-- Header -->
        <div class="flex items-start justify-between mb-4">
          <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
              <h3 class="text-lg font-bold text-gray-900"><?php echo htmlspecialchars($job['title']); ?></h3>
              <?php if ($job['urgency'] === 'high'): ?>
                <span class="text-xs font-semibold px-2 py-1 bg-<?php echo $urgencyColor; ?>-100 text-<?php echo $urgencyColor; ?>-800 rounded-full">Urgent</span>
              <?php endif; ?>
            </div>
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
              <span class="flex items-center">
                <i data-feather="briefcase" class="w-4 h-4 mr-1"></i>
                <?php echo htmlspecialchars($job['department']); ?>
              </span>
              <span class="flex items-center">
                <i data-feather="map-pin" class="w-4 h-4 mr-1"></i>
                <?php echo htmlspecialchars($job['location']); ?>
              </span>
              <span class="flex items-center">
                <i data-feather="clock" class="w-4 h-4 mr-1"></i>
                <?php echo htmlspecialchars($job['type']); ?>
              </span>
            </div>
          </div>
          <div class="ml-4">
            <button class="p-2 text-gray-400 hover:text-gray-600 transition">
              <i data-feather="more-vertical" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

        <!-- Salary -->
        <div class="mb-4">
          <span class="inline-flex items-center text-sm font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-lg">
            <i data-feather="dollar-sign" class="w-4 h-4 mr-1"></i>
            <?php echo htmlspecialchars($job['salary']); ?>
          </span>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 gap-4 mb-4 p-4 bg-gray-50 rounded-lg">
          <div>
            <p class="text-sm text-gray-600">Applications</p>
            <p class="text-xl font-bold text-gray-900"><?php echo $job['applications']; ?></p>
          </div>
          <div>
            <p class="text-sm text-gray-600">Posted</p>
            <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($job['posted']); ?></p>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2">
          <button onclick="viewApplications(<?php echo $job['id']; ?>)" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
            View Applications
          </button>
          <button onclick="editJob(<?php echo $job['id']; ?>)" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="edit-2" class="w-4 h-4"></i>
          </button>
          <button onclick="shareJob(<?php echo $job['id']; ?>)" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="share-2" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Applications Tab -->
<div id="content-applications" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
          $applications = [
            ['name' => 'Sarah Johnson', 'email' => 'sarah.j@example.com', 'position' => 'Senior Software Engineer', 'applied' => '2 hours ago', 'status' => 'New', 'score' => 95, 'match' => 'excellent'],
            ['name' => 'Michael Chen', 'email' => 'mchen@example.com', 'position' => 'Product Manager', 'applied' => '5 hours ago', 'status' => 'Screening', 'score' => 88, 'match' => 'good'],
            ['name' => 'Emily Rodriguez', 'email' => 'emily.r@example.com', 'position' => 'UX/UI Designer', 'applied' => '1 day ago', 'status' => 'Interview', 'score' => 92, 'match' => 'excellent'],
            ['name' => 'David Kim', 'email' => 'dkim@example.com', 'position' => 'Data Scientist', 'applied' => '2 days ago', 'status' => 'Offer', 'score' => 97, 'match' => 'excellent'],
            ['name' => 'Jessica Williams', 'email' => 'jwilliams@example.com', 'position' => 'DevOps Engineer', 'applied' => '3 days ago', 'status' => 'Screening', 'score' => 85, 'match' => 'good'],
            ['name' => 'Robert Taylor', 'email' => 'rtaylor@example.com', 'position' => 'Sales Account Executive', 'applied' => '4 days ago', 'status' => 'New', 'score' => 78, 'match' => 'fair'],
            ['name' => 'Amanda Martinez', 'email' => 'amartinez@example.com', 'position' => 'Marketing Specialist', 'applied' => '5 days ago', 'status' => 'Interview', 'score' => 90, 'match' => 'excellent'],
            ['name' => 'James Anderson', 'email' => 'janderson@example.com', 'position' => 'HR Coordinator', 'applied' => '1 week ago', 'status' => 'Rejected', 'score' => 65, 'match' => 'poor']
          ];

          foreach ($applications as $app):
            $statusColors = [
              'New' => 'bg-blue-100 text-blue-800',
              'Screening' => 'bg-yellow-100 text-yellow-800',
              'Interview' => 'bg-purple-100 text-purple-800',
              'Offer' => 'bg-green-100 text-green-800',
              'Rejected' => 'bg-red-100 text-red-800'
            ];
          ?>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                    <?php echo strtoupper(substr($app['name'], 0, 1)); ?>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($app['name']); ?></div>
                    <div class="text-sm text-gray-500"><?php echo htmlspecialchars($app['email']); ?></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?php echo htmlspecialchars($app['position']); ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo htmlspecialchars($app['applied']); ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusColors[$app['status']]; ?>">
                  <?php echo htmlspecialchars($app['status']); ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <span class="text-sm font-semibold <?php echo $app['score'] >= 90 ? 'text-green-600' : ($app['score'] >= 80 ? 'text-yellow-600' : 'text-red-600'); ?>">
                    <?php echo $app['score']; ?>%
                  </span>
                  <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                    <div class="<?php echo $app['score'] >= 90 ? 'bg-green-600' : ($app['score'] >= 80 ? 'bg-yellow-600' : 'bg-red-600'); ?> h-2 rounded-full" style="width: <?php echo $app['score']; ?>%"></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                <button class="text-gray-600 hover:text-gray-900">More</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Candidates Tab -->
<div id="content-candidates" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Candidate Pool</h3>
    <p class="text-gray-600">Talent pool and candidate database management coming soon.</p>
  </div>
</div>

<!-- Pipeline Tab -->
<div id="content-pipeline" class="tab-content hidden">
  <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Recruitment Pipeline</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
      <!-- Applied -->
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-900">Applied</h4>
          <span class="text-xs font-semibold px-2 py-1 bg-blue-100 text-blue-800 rounded-full">247</span>
        </div>
        <div class="space-y-2">
          <div class="bg-white p-3 rounded border border-gray-200 cursor-move hover:shadow-sm transition">
            <p class="font-medium text-sm">Sarah Johnson</p>
            <p class="text-xs text-gray-500">Sr. Software Eng.</p>
          </div>
          <div class="bg-white p-3 rounded border border-gray-200 cursor-move hover:shadow-sm transition">
            <p class="font-medium text-sm">Michael Chen</p>
            <p class="text-xs text-gray-500">Product Manager</p>
          </div>
        </div>
      </div>

      <!-- Screening -->
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-900">Screening</h4>
          <span class="text-xs font-semibold px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">98</span>
        </div>
        <div class="space-y-2">
          <div class="bg-white p-3 rounded border border-gray-200 cursor-move hover:shadow-sm transition">
            <p class="font-medium text-sm">Emily Rodriguez</p>
            <p class="text-xs text-gray-500">UX Designer</p>
          </div>
        </div>
      </div>

      <!-- Interview -->
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-900">Interview</h4>
          <span class="text-xs font-semibold px-2 py-1 bg-purple-100 text-purple-800 rounded-full">45</span>
        </div>
        <div class="space-y-2">
          <div class="bg-white p-3 rounded border border-gray-200 cursor-move hover:shadow-sm transition">
            <p class="font-medium text-sm">David Kim</p>
            <p class="text-xs text-gray-500">Data Scientist</p>
          </div>
        </div>
      </div>

      <!-- Offer -->
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-900">Offer</h4>
          <span class="text-xs font-semibold px-2 py-1 bg-green-100 text-green-800 rounded-full">12</span>
        </div>
        <div class="space-y-2">
          <div class="bg-white p-3 rounded border border-gray-200 cursor-move hover:shadow-sm transition">
            <p class="font-medium text-sm">Jessica Williams</p>
            <p class="text-xs text-gray-500">DevOps Eng.</p>
          </div>
        </div>
      </div>

      <!-- Hired -->
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-900">Hired</h4>
          <span class="text-xs font-semibold px-2 py-1 bg-green-100 text-green-800 rounded-full">8</span>
        </div>
        <div class="space-y-2">
          <div class="bg-white p-3 rounded border border-gray-200">
            <p class="font-medium text-sm">Robert Taylor</p>
            <p class="text-xs text-gray-500">Sales Exec.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Tab switching
  function switchTab(tab) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(el => {
      el.classList.remove('border-blue-600', 'text-blue-600');
      el.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Activate selected tab
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-600', 'text-blue-600');
  }

  // Job actions
  function openJobModal() {
    alert('Open new job posting form');
  }

  function viewApplications(jobId) {
    alert('View applications for job #' + jobId);
  }

  function editJob(jobId) {
    alert('Edit job #' + jobId);
  }

  function shareJob(jobId) {
    alert('Share job #' + jobId);
  }

  function exportJobs() {
    alert('Export jobs data');
  }

  // Initialize Feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
?>
