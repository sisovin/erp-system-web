<?php
$pageTitle = 'System Settings';
$activeMenu = 'settings';
ob_start();
?>
<!-- Page Header -->
<div class="mb-8">
  <h2 class="text-3xl font-bold text-gray-900">System Settings</h2>
  <p class="mt-2 text-sm text-gray-600">Configure system-wide settings including notifications, SMTP, and integrations.</p>
</div>

<form method="post" action="/admin/settings/update">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Slack Configuration -->
    <div class="card">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
          <i data-feather="slack" class="w-6 h-6 text-purple-600"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Slack Integration</h3>
          <p class="text-sm text-gray-500">Configure Slack webhook for notifications</p>
        </div>
      </div>
      
      <div class="space-y-4">
        <div>
          <label for="slack_webhook_url" class="block text-sm font-medium text-gray-700 mb-2">
            Slack Webhook URL
          </label>
          <input 
            type="url" 
            id="slack_webhook_url" 
            name="slack_webhook_url" 
            value="<?= htmlspecialchars($data['slack_webhook_url'] ?? '') ?>" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            placeholder="https://hooks.slack.com/services/..."
          >
          <p class="mt-1 text-xs text-gray-500">Enter your Slack incoming webhook URL</p>
        </div>
      </div>
    </div>

    <!-- Email Notifications -->
    <div class="card">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
          <i data-feather="mail" class="w-6 h-6 text-blue-600"></i>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Email Notifications</h3>
          <p class="text-sm text-gray-500">Configure notification recipients</p>
        </div>
      </div>
      
      <div class="space-y-4">
        <div>
          <label for="notify_emails" class="block text-sm font-medium text-gray-700 mb-2">
            Notification Emails
          </label>
          <input 
            type="text" 
            id="notify_emails" 
            name="notify_emails" 
            value="<?= htmlspecialchars($data['notify_emails'] ?? '') ?>" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            placeholder="admin@example.com, alerts@example.com"
          >
          <p class="mt-1 text-xs text-gray-500">Comma-separated list of email addresses</p>
        </div>
      </div>
    </div>
  </div>

  <!-- SMTP Configuration -->
  <div class="card mt-6">
    <div class="flex items-center mb-6">
      <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
        <i data-feather="server" class="w-6 h-6 text-green-600"></i>
      </div>
      <div>
        <h3 class="text-lg font-semibold text-gray-900">SMTP Configuration</h3>
        <p class="text-sm text-gray-500">Configure SMTP server for sending emails</p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div>
        <label for="smtp_host" class="block text-sm font-medium text-gray-700 mb-2">
          SMTP Host <span class="text-red-500">*</span>
        </label>
        <input 
          type="text" 
          id="smtp_host" 
          name="smtp_host" 
          value="<?= htmlspecialchars($data['smtp_host'] ?? '') ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="smtp.example.com"
        >
      </div>

      <div>
        <label for="smtp_port" class="block text-sm font-medium text-gray-700 mb-2">
          SMTP Port <span class="text-red-500">*</span>
        </label>
        <input 
          type="number" 
          id="smtp_port" 
          name="smtp_port" 
          value="<?= htmlspecialchars($data['smtp_port'] ?? '587') ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="587"
        >
      </div>

      <div>
        <label for="smtp_secure" class="block text-sm font-medium text-gray-700 mb-2">
          Security <span class="text-red-500">*</span>
        </label>
        <select 
          id="smtp_secure" 
          name="smtp_secure" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
        >
          <option value="tls" <?= ($data['smtp_secure'] ?? 'tls') === 'tls' ? 'selected' : '' ?>>TLS</option>
          <option value="ssl" <?= ($data['smtp_secure'] ?? '') === 'ssl' ? 'selected' : '' ?>>SSL</option>
          <option value="none" <?= ($data['smtp_secure'] ?? '') === 'none' ? 'selected' : '' ?>>None</option>
        </select>
      </div>

      <div>
        <label for="smtp_username" class="block text-sm font-medium text-gray-700 mb-2">
          SMTP Username
        </label>
        <input 
          type="text" 
          id="smtp_username" 
          name="smtp_username" 
          value="<?= htmlspecialchars($data['smtp_username'] ?? '') ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="username@example.com"
        >
      </div>

      <div>
        <label for="smtp_password" class="block text-sm font-medium text-gray-700 mb-2">
          SMTP Password
        </label>
        <input 
          type="password" 
          id="smtp_password" 
          name="smtp_password" 
          value="" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="Leave blank to keep current"
        >
      </div>

      <div>
        <label for="smtp_from" class="block text-sm font-medium text-gray-700 mb-2">
          From Address <span class="text-red-500">*</span>
        </label>
        <input 
          type="email" 
          id="smtp_from" 
          name="smtp_from" 
          value="<?= htmlspecialchars($data['smtp_from'] ?? '') ?>" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
          placeholder="noreply@example.com"
        >
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="flex items-center justify-between mt-8">
    <a href="/admin" class="text-gray-600 hover:text-gray-900 flex items-center">
      <i data-feather="arrow-left" class="w-4 h-4 mr-2 stroke-current"></i>
      Back to Dashboard
    </a>
    <div class="flex gap-3">
      <button type="button" onclick="window.location.reload()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
        Reset
      </button>
      <button type="submit" class="btn btn-primary">
        <i data-feather="save" class="w-4 h-4 inline mr-2 stroke-current"></i>
        Save Settings
      </button>
    </div>
  </div>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/admin_layout.php';
