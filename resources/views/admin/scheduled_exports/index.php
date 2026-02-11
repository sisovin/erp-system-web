<?php
$pageTitle = 'Scheduled Exports';
$activeMenu = 'scheduled-exports';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8 flex items-center justify-between">
  <div>
    <h2 class="text-3xl font-bold text-gray-900">Scheduled Exports</h2>
    <p class="mt-2 text-sm text-gray-600">Manage automated data export schedules</p>
  </div>
  <div class="flex gap-3">
    <a href="/admin/scheduled-exports/generate-timers" class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
      <i data-feather="clock" class="w-4 h-4 mr-2 stroke-current"></i>
      Generate Timers
    </a>
    <a href="/admin/scheduled-exports/create" class="btn btn-primary text-sm">
      <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
      Create Export
    </a>
  </div>
</div>

<?php $msg = flash_get('message'); if ($msg): ?>
  <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start">
    <i data-feather="check-circle" class="w-5 h-5 text-green-600 mr-3 mt-0.5 stroke-current"></i>
    <div class="flex-1">
      <p class="text-sm text-green-800 whitespace-pre-wrap"><?= htmlspecialchars($msg) ?></p>
    </div>
  </div>
<?php endif; ?>

<!-- Exports Table -->
<div class="card">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Format</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Retention</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S3 Upload</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Run</th>
          <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($items as $it): ?>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                  <i data-feather="file-text" class="w-5 h-5 text-primary-600"></i>
                </div>
                <div>
                  <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($it->name) ?></div>
                  <div class="text-xs text-gray-500">ID: <?= htmlspecialchars($it->id) ?></div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              <?php if (($it->schedule_type ?? 'daily') === 'daily'): ?>
                <div class="flex items-center">
                  <i data-feather="sun" class="w-4 h-4 mr-2 text-gray-400 stroke-current"></i>
                  Daily at <?= htmlspecialchars(substr($it->schedule_time ?? '', 0, 5)) ?>
                </div>
              <?php else: ?>
                <div class="flex items-center">
                  <i data-feather="terminal" class="w-4 h-4 mr-2 text-gray-400 stroke-current"></i>
                  <?= htmlspecialchars($it->schedule_cron ?? '') ?>
                </div>
              <?php endif; ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                <?= htmlspecialchars(strtoupper($it->format)) ?>
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <?= htmlspecialchars($it->retention_days) ?> days
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <?= $it->upload_to_s3 ? '<span class="text-green-600">✓ Enabled</span>' : '<span class="text-gray-400">✗ Disabled</span>' ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <?= $it->enabled ? '<span class="badge badge-success">Active</span>' : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>' ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <?= $it->last_run_at ? htmlspecialchars($it->last_run_at) : '<span class="text-gray-400">Never</span>' ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="/admin/scheduled-exports/<?= $it->id ?>/edit" class="text-primary-600 hover:text-primary-900 mr-3" title="Edit">
                <i data-feather="edit-2" class="w-4 h-4 inline stroke-current"></i>
              </a>
              <a href="/admin/scheduled-exports/<?= $it->id ?>/delete" onclick="return confirm('Are you sure you want to delete this export?')" class="text-red-600 hover:text-red-900" title="Delete">
                <i data-feather="trash-2" class="w-4 h-4 inline stroke-current"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  
  <?php if (empty($items)): ?>
    <div class="text-center py-12">
      <i data-feather="inbox" class="w-16 h-16 mx-auto text-gray-300 stroke-current mb-4"></i>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No scheduled exports yet</h3>
      <p class="text-gray-500 mb-4">Get started by creating your first automated export</p>
      <a href="/admin/scheduled-exports/create" class="btn btn-primary inline-flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2 stroke-current"></i>
        Create Export
      </a>
    </div>
  <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layout/admin_layout.php';
