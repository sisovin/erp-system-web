<?php
$pageTitle = 'Audit Logs';
$activeMenu = 'audits';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8">
  <h2 class="text-3xl font-bold text-gray-900">Audit Logs</h2>
  <p class="mt-2 text-sm text-gray-600">Track all system activities and security events</p>
</div>

<!-- Filters Card -->
<div class="card mb-6">
  <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
  <form method="get" action="/admin/audits">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <div>
        <label for="action" class="block text-sm font-medium text-gray-700 mb-2">Action</label>
        <input 
          type="text" 
          id="action" 
          name="action" 
          value="<?php echo htmlentities($action ?? ''); ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="e.g. login, refresh_token"
        />
      </div>

      <div>
        <label for="start" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
        <input 
          type="date" 
          id="start" 
          name="start" 
          value="<?php echo htmlentities($start ?? ''); ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
        />
      </div>

      <div>
        <label for="end" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
        <input 
          type="date" 
          id="end" 
          name="end" 
          value="<?php echo htmlentities($end ?? ''); ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
        />
      </div>

      <div>
        <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
        <select 
          id="severity" 
          name="severity" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
        >
          <option value=""<?php echo (empty($_GET['severity']) ? ' selected' : ''); ?>>All Levels</option>
          <option value="info"<?php echo (($_GET['severity'] ?? '') === 'info') ? ' selected' : ''; ?>>Info</option>
          <option value="warning"<?php echo (($_GET['severity'] ?? '') === 'warning') ? ' selected' : ''; ?>>Warning</option>
          <option value="critical"<?php echo (($_GET['severity'] ?? '') === 'critical') ? ' selected' : ''; ?>>Critical</option>
        </select>
      </div>
    </div>

    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
      <div class="flex items-center gap-4">
        <label class="flex items-center">
          <input 
            type="checkbox" 
            name="export_all" 
            value="1" 
            <?php echo (isset($_GET['export_all']) && $_GET['export_all'] === '1') ? 'checked' : ''; ?>
            class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
          />
          <span class="ml-2 text-sm text-gray-700">Export all records</span>
        </label>
      </div>
      <div class="flex gap-2">
        <button type="submit" class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
          <i data-feather="filter" class="w-4 h-4 inline mr-1 stroke-current"></i>
          Apply Filters
        </button>
        <button type="submit" name="format" value="csv" class="px-4 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
          <i data-feather="download" class="w-4 h-4 inline mr-1 stroke-current"></i>
          Export CSV
        </button>
        <button type="submit" name="format" value="json" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
          <i data-feather="file-text" class="w-4 h-4 inline mr-1 stroke-current"></i>
          Export JSON
        </button>
      </div>
    </div>
  </form>
</div>

<!-- Audit Logs Table -->
<div class="card">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
          <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
          <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach ($entries as $e): ?>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlentities($e['id']); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <?php 
                $severityClass = 'badge badge-info';
                if (($e['severity'] ?? 'info') === 'critical') $severityClass = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
                elseif (($e['severity'] ?? 'info') === 'warning') $severityClass = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
                else $severityClass = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
              ?>
              <span class="<?php echo $severityClass; ?>"><?php echo htmlentities(strtoupper($e['severity'] ?? 'INFO')); ?></span>
            </td>
            <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlentities($e['action']); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlentities($e['user_id'] ?? '-'); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlentities($e['model'] ?? '-'); ?> <?php echo $e['model_id'] ? '#' . htmlentities($e['model_id']) : ''; ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlentities($e['ip'] ?? '-'); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlentities($e['created_at']); ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button 
                onclick="viewAudit(<?php echo htmlentities(json_encode($e)); ?>)" 
                class="text-primary-600 hover:text-primary-900" 
                title="View Details"
              >
                <i data-feather="eye" class="w-4 h-4 inline stroke-current"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
    <p class="text-sm text-gray-700">
      Showing <span class="font-medium"><?php echo count($entries); ?></span> entries
      <?php if (!empty($start) || !empty($end)): ?>
        from <span class="font-medium"><?php echo htmlentities($start ?: 'beginning'); ?></span> 
        to <span class="font-medium"><?php echo htmlentities($end ?: 'now'); ?></span>
      <?php endif; ?>
    </p>
  </div>
</div>

<!-- Audit Detail Modal -->
<div id="audit-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeAuditModal()"></div>
    
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-gray-900" id="modal-title">Audit Details</h3>
          <button onclick="closeAuditModal()" class="text-gray-400 hover:text-gray-500">
            <i data-feather="x" class="w-6 h-6 stroke-current"></i>
          </button>
        </div>
        <div id="modal-content" class="space-y-4">
          <!-- Content dynamically loaded -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function viewAudit(entry) {
  const modal = document.getElementById('audit-modal');
  const content = document.getElementById('modal-content');
  
  content.innerHTML = `
    <div class="grid grid-cols-2 gap-4">
      <div>
        <p class="text-sm font-medium text-gray-500">Action</p>
        <p class="mt-1 text-sm text-gray-900">${entry.action}</p>
      </div>
      <div>
        <p class="text-sm font-medium text-gray-500">User ID</p>
        <p class="mt-1 text-sm text-gray-900">${entry.user_id || '-'}</p>
      </div>
      <div>
        <p class="text-sm font-medium text-gray-500">IP Address</p>
        <p class="mt-1 text-sm text-gray-900">${entry.ip || '-'}</p>
      </div>
      <div>
        <p class="text-sm font-medium text-gray-500">Timestamp</p>
        <p class="mt-1 text-sm text-gray-900">${entry.created_at}</p>
      </div>
    </div>
    ${entry.before_data ? `
      <div>
        <p class="text-sm font-medium text-gray-500 mb-2">Before Data</p>
        <pre class="bg-gray-100 p-3 rounded-lg text-xs overflow-x-auto">${entry.before_data}</pre>
      </div>
    ` : ''}
    ${entry.after_data ? `
      <div>
        <p class="text-sm font-medium text-gray-500 mb-2">After Data</p>
        <pre class="bg-gray-100 p-3 rounded-lg text-xs overflow-x-auto">${entry.after_data}</pre>
      </div>
    ` : ''}
  `;
  
  modal.classList.remove('hidden');
  feather.replace();
}

function closeAuditModal() {
  document.getElementById('audit-modal').classList.add('hidden');
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
