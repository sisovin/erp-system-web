<?php
$pageTitle = (empty($item->id) ? 'Create' : 'Edit') . ' Scheduled Export';
$activeMenu = 'scheduled-exports';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8">
  <h2 class="text-3xl font-bold text-gray-900"><?= empty($item->id) ? 'Create' : 'Edit' ?> Scheduled Export</h2>
  <p class="mt-2 text-sm text-gray-600">Configure automated export settings and schedule</p>
</div>

<form method="post" action="<?= empty($item->id) ? '/admin/scheduled-exports/store' : '/admin/scheduled-exports/' . $item->id . '/update' ?>">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Configuration -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Basic Information -->
      <div class="card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
        <div class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
              Name <span class="text-red-500">*</span>
            </label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              value="<?= htmlspecialchars($item->name ?? '') ?>" 
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              placeholder="e.g., Daily User Export"
            >
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
              Description
            </label>
            <textarea 
              id="description" 
              name="description" 
              rows="3"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              placeholder="Describe the purpose of this export..."
            ><?= htmlspecialchars($item->description ?? '') ?></textarea>
          </div>

          <div>
            <label for="columns" class="block text-sm font-medium text-gray-700 mb-2">
              Columns
            </label>
            <input 
              type="text" 
              id="columns" 
              name="columns" 
              value="<?= htmlspecialchars($item->columns ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              placeholder="id, name, email (comma-separated)"
            >
            <p class="mt-1 text-xs text-gray-500">Leave blank to export all columns</p>
          </div>
        </div>
      </div>

      <!-- Schedule Configuration -->
      <div class="card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Schedule</h3>
        <div class="space-y-4">
          <div>
            <label for="schedule_type" class="block text-sm font-medium text-gray-700 mb-2">
              Schedule Type
            </label>
            <select 
              id="schedule_type" 
              name="schedule_type" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              onchange="toggleScheduleType()"
            >
              <option value="daily" <?= ($item->schedule_type ?? 'daily') === 'daily' ? 'selected' : '' ?>>Daily at specific time</option>
              <option value="cron" <?= ($item->schedule_type ?? '') === 'cron' ? 'selected' : '' ?>>Cron expression</option>
            </select>
          </div>

          <div id="schedule_daily" style="display: <?= ($item->schedule_type ?? 'daily') === 'daily' ? 'block' : 'none' ?>">
            <label for="schedule_time" class="block text-sm font-medium text-gray-700 mb-2">
              Daily Time (HH:MM)
            </label>
            <input 
              type="time" 
              id="schedule_time" 
              name="schedule_time" 
              value="<?= htmlspecialchars(substr($item->schedule_time ?? '', 0, 5)) ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            >
          </div>

          <div id="schedule_cron" style="display: <?= ($item->schedule_type ?? 'daily') === 'cron' ? 'block' : 'none' ?>">
            <label for="schedule_cron_input" class="block text-sm font-medium text-gray-700 mb-2">
              Cron Expression
            </label>
            <input 
              type="text" 
              id="schedule_cron_input" 
              name="schedule_cron" 
              value="<?= htmlspecialchars($item->schedule_cron ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              placeholder="0 4 * * *"
            >
            <p class="mt-1 text-xs text-gray-500">
              Example: "0 4 * * *" runs at 4:00 AM daily
              <a href="https://crontab.guru/" target="_blank" class="text-primary-600 hover:text-primary-700 ml-1">Learn more</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar Options -->
    <div class="space-y-6">
      <!-- Export Options -->
      <div class="card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Export Options</h3>
        <div class="space-y-4">
          <div>
            <label for="format" class="block text-sm font-medium text-gray-700 mb-2">
              Format
            </label>
            <select 
              id="format" 
              name="format" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            >
              <option value="csv" <?= ($item->format ?? 'csv') === 'csv' ? 'selected' : '' ?>>CSV</option>
              <option value="json" <?= ($item->format ?? '') === 'json' ? 'selected' : '' ?>>JSON</option>
              <option value="ndjson" <?= ($item->format ?? '') === 'ndjson' ? 'selected' : '' ?>>NDJSON</option>
            </select>
          </div>

          <div>
            <label for="retention_days" class="block text-sm font-medium text-gray-700 mb-2">
              Retention (days)
            </label>
            <input 
              type="number" 
              id="retention_days" 
              name="retention_days" 
              value="<?= htmlspecialchars($item->retention_days ?? 30) ?>" 
              min="1"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            >
            <p class="mt-1 text-xs text-gray-500">Files older than this will be deleted</p>
          </div>

          <div class="pt-4 border-t border-gray-200">
            <label class="flex items-center">
              <input 
                type="checkbox" 
                name="upload_to_s3" 
                <?= ($item->upload_to_s3 ?? false) ? 'checked' : '' ?>
                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
              >
              <span class="ml-2 text-sm text-gray-700">Upload to S3</span>
            </label>
          </div>

          <div>
            <label class="flex items-center">
              <input 
                type="checkbox" 
                name="enabled" 
                <?= ($item->enabled ?? true) ? 'checked' : '' ?>
                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
              >
              <span class="ml-2 text-sm text-gray-700">Enabled</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Help Card -->
      <div class="card bg-blue-50 border border-blue-100">
        <div class="flex items-start">
          <i data-feather="info" class="w-5 h-5 text-blue-600 mr-3 mt-0.5 stroke-current flex-shrink-0"></i>
          <div>
            <h4 class="text-sm font-semibold text-blue-900 mb-2">Quick Tips</h4>
            <ul class="text-xs text-blue-800 space-y-1">
              <li>• Daily schedules run at the specified time each day</li>
              <li>• Cron expressions offer more flexibility</li>
              <li>• S3 uploads require AWS credentials in settings</li>
              <li>• Retention automatically cleans old exports</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
    <a href="/admin/scheduled-exports" class="text-gray-600 hover:text-gray-900 flex items-center">
      <i data-feather="arrow-left" class="w-4 h-4 mr-2 stroke-current"></i>
      Back to Exports
    </a>
    <div class="flex gap-3">
      <button type="button" onclick="window.location.href='/admin/scheduled-exports'" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
        Cancel
      </button>
      <button type="submit" class="btn btn-primary">
        <i data-feather="save" class="w-4 h-4 inline mr-2 stroke-current"></i>
        <?= empty($item->id) ? 'Create Export' : 'Update Export' ?>
      </button>
    </div>
  </div>
</form>

<script>
function toggleScheduleType() {
  const scheduleType = document.getElementById('schedule_type').value;
  document.getElementById('schedule_daily').style.display = scheduleType === 'daily' ? 'block' : 'none';
  document.getElementById('schedule_cron').style.display = scheduleType === 'cron' ? 'block' : 'none';
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layout/admin_layout.php';
