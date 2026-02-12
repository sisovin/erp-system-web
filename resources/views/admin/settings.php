<?php
$pageTitle = 'System Settings';
$activeMenu = 'settings';
ob_start();
?>

<!-- Header with Actions -->
<div class="mb-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">System Settings</h1>
      <p class="mt-2 text-sm text-gray-600">Configure system preferences, integrations, and security settings</p>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="exportSettings()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="download" class="w-4 h-4 mr-2"></i>
        Export
      </button>
      <button onclick="resetDefaults()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
        <i data-feather="rotate-ccw" class="w-4 h-4 mr-2"></i>
        Reset
      </button>
    </div>
  </div>
</div>

<!-- Tabs -->
<div class="mb-6">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8 overflow-x-auto">
      <button onclick="switchTab('general')" id="tab-general" class="tab-button border-b-2 border-blue-600 text-blue-600 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="settings" class="w-4 h-4 mr-2"></i>
        General
      </button>
      <button onclick="switchTab('email')" id="tab-email" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="mail" class="w-4 h-4 mr-2"></i>
        Email & SMTP
      </button>
      <button onclick="switchTab('integrations')" id="tab-integrations" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="link" class="w-4 h-4 mr-2"></i>
        Integrations
      </button>
      <button onclick="switchTab('security')" id="tab-security" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="shield" class="w-4 h-4 mr-2"></i>
        Security
      </button>
      <button onclick="switchTab('system')" id="tab-system" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="server" class="w-4 h-4 mr-2"></i>
        System
      </button>
      <button onclick="switchTab('appearance')" id="tab-appearance" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium flex items-center">
        <i data-feather="eye" class="w-4 h-4 mr-2"></i>
        Appearance
      </button>
    </nav>
  </div>
</div>

<form method="post" action="/admin/settings/update" id="settingsForm">
  
  <!-- General Settings Tab -->
  <div id="content-general" class="tab-content">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Company Information -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-blue-100 rounded-lg mr-4">
            <i data-feather="briefcase" class="w-6 h-6 text-blue-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Company Information</h3>
            <p class="text-sm text-gray-500">Basic company details</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
            <input type="text" name="company_name" value="Nexus ERP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
            <input type="url" name="company_website" value="https://nexuserp.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
            <select name="timezone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="UTC">UTC</option>
              <option value="America/New_York" selected>Eastern Time (ET)</option>
              <option value="America/Chicago">Central Time (CT)</option>
              <option value="America/Denver">Mountain Time (MT)</option>
              <option value="America/Los_Angeles">Pacific Time (PT)</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Regional Settings -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-purple-100 rounded-lg mr-4">
            <i data-feather="globe" class="w-6 h-6 text-purple-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Regional Settings</h3>
            <p class="text-sm text-gray-500">Localization preferences</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
            <select name="language" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="en" selected>English</option>
              <option value="es">Spanish</option>
              <option value="fr">French</option>
              <option value="de">German</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
            <select name="date_format" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
              <option value="DD/MM/YYYY">DD/MM/YYYY</option>
              <option value="YYYY-MM-DD">YYYY-MM-DD</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
            <select name="currency" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="USD" selected>USD ($)</option>
              <option value="EUR">EUR (€)</option>
              <option value="GBP">GBP (£)</option>
              <option value="JPY">JPY (¥)</option>
            </select>
          </div>
        </div>
      </div>

      <!-- System Preferences -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-green-100 rounded-lg mr-4">
            <i data-feather="sliders" class="w-6 h-6 text-green-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">System Preferences</h3>
            <p class="text-sm text-gray-500">General system behavior</p>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Maintenance Mode</p>
              <p class="text-sm text-gray-500">Disable public access</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="maintenance_mode" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Debug Mode</p>
              <p class="text-sm text-gray-500">Show detailed errors</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="debug_mode" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">User Registration</p>
              <p class="text-sm text-gray-500">Allow new sign-ups</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="allow_registration" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Email Verification</p>
              <p class="text-sm text-gray-500">Require email confirmation</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="require_email_verification" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Email & SMTP Settings Tab -->
  <div id="content-email" class="tab-content hidden">
    <div class="grid grid-cols-1 gap-6">
      <!-- SMTP Configuration -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg mr-4">
              <i data-feather="server" class="w-6 h-6 text-green-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">SMTP Configuration</h3>
              <p class="text-sm text-gray-500">Configure outgoing email server</p>
            </div>
          </div>
          <button type="button" onclick="testSMTP()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
            <i data-feather="send" class="w-4 h-4 mr-2"></i>
            Test Connection
          </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              SMTP Host <span class="text-red-500">*</span>
            </label>
            <input type="text" name="smtp_host" value="<?= htmlspecialchars($data['smtp_host'] ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="smtp.example.com">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              SMTP Port <span class="text-red-500">*</span>
            </label>
            <input type="number" name="smtp_port" value="<?= htmlspecialchars($data['smtp_port'] ?? '587') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="587">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Encryption <span class="text-red-500">*</span>
            </label>
            <select name="smtp_secure" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="tls" <?= ($data['smtp_secure'] ?? 'tls') === 'tls' ? 'selected' : '' ?>>TLS</option>
              <option value="ssl" <?= ($data['smtp_secure'] ?? '') === 'ssl' ? 'selected' : '' ?>>SSL</option>
              <option value="none" <?= ($data['smtp_secure'] ?? '') === 'none' ? 'selected' : '' ?>>None</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Username</label>
            <input type="text" name="smtp_username" value="<?= htmlspecialchars($data['smtp_username'] ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="username@example.com">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Password</label>
            <input type="password" name="smtp_password" autocomplete="new-password"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="••••••••">
            <p class="mt-1 text-xs text-gray-500">Leave blank to keep current</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              From Address <span class="text-red-500">*</span>
            </label>
            <input type="email" name="smtp_from" value="<?= htmlspecialchars($data['smtp_from'] ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="noreply@example.com">
          </div>
        </div>
      </div>

      <!-- Email Notifications -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-blue-100 rounded-lg mr-4">
            <i data-feather="bell" class="w-6 h-6 text-blue-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Email Notifications</h3>
            <p class="text-sm text-gray-500">Configure notification recipients and preferences</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Notification Emails</label>
            <input type="text" name="notify_emails" value="<?= htmlspecialchars($data['notify_emails'] ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="admin@example.com, alerts@example.com">
            <p class="mt-1 text-xs text-gray-500">Comma-separated list of email addresses</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium text-gray-900">System Alerts</p>
                <p class="text-sm text-gray-500">Critical system notifications</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="email_system_alerts" checked class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium text-gray-900">New User Registration</p>
                <p class="text-sm text-gray-500">When users sign up</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="email_new_users" checked class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium text-gray-900">Failed Logins</p>
                <p class="text-sm text-gray-500">Security alerts</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="email_failed_logins" checked class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium text-gray-900">Daily Digest</p>
                <p class="text-sm text-gray-500">Summary reports</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="email_daily_digest" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Integrations Tab -->
  <div id="content-integrations" class="tab-content hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Slack Integration -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg mr-4">
              <i data-feather="slack" class="w-6 h-6 text-purple-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Slack</h3>
              <p class="text-sm text-gray-500">Team collaboration integration</p>
            </div>
          </div>
          <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Connected</span>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Webhook URL</label>
            <input type="url" name="slack_webhook_url" value="<?= htmlspecialchars($data['slack_webhook_url'] ?? '') ?>" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="https://hooks.slack.com/services/...">
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Enable Notifications</p>
              <p class="text-sm text-gray-500">Send alerts to Slack</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="slack_enabled" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
          <button type="button" onclick="testSlack()" class="w-full px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
            <i data-feather="send" class="w-4 h-4 inline mr-2"></i>
            Send Test Message
          </button>
        </div>
      </div>

      <!-- AWS Integration -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg mr-4">
              <i data-feather="cloud" class="w-6 h-6 text-orange-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Amazon S3</h3>
              <p class="text-sm text-gray-500">Cloud storage for exports</p>
            </div>
          </div>
          <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-800 rounded-full">Active</span>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bucket Name</label>
            <input type="text" name="s3_bucket" value="nexus-erp-exports" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">AWS Region</label>
            <select name="s3_region" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="us-east-1" selected>US East (N. Virginia)</option>
              <option value="us-west-2">US West (Oregon)</option>
              <option value="eu-west-1">EU (Ireland)</option>
              <option value="ap-southeast-1">Asia Pacific (Singapore)</option>
            </select>
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Auto Upload Exports</p>
              <p class="text-sm text-gray-500">Upload reports to S3</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="s3_auto_upload" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>

      <!-- GitHub Integration -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-gray-100 rounded-lg mr-4">
              <i data-feather="github" class="w-6 h-6 text-gray-800"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">GitHub</h3>
              <p class="text-sm text-gray-500">Code repository integration</p>
            </div>
          </div>
          <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 text-gray-800 rounded-full">Not Configured</span>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Access Token</label>
            <input type="password" name="github_token" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="ghp_...">
          </div>
          <button type="button" class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
            <i data-feather="link" class="w-4 h-4 inline mr-2"></i>
            Connect GitHub
          </button>
        </div>
      </div>

      <!-- Google Analytics -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-lg mr-4">
              <i data-feather="bar-chart-2" class="w-6 h-6 text-red-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Google Analytics</h3>
              <p class="text-sm text-gray-500">Website analytics tracking</p>
            </div>
          </div>
          <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 text-gray-800 rounded-full">Not Configured</span>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tracking ID</label>
            <input type="text" name="ga_tracking_id" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="G-XXXXXXXXXX">
          </div>
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Enable Tracking</p>
              <p class="text-sm text-gray-500">Track page views</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="ga_enabled" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Security Tab -->
  <div id="content-security" class="tab-content hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Authentication Settings -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-blue-100 rounded-lg mr-4">
            <i data-feather="lock" class="w-6 h-6 text-blue-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Authentication</h3>
            <p class="text-sm text-gray-500">Login and password policies</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
            <input type="number" name="session_timeout" value="60" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
            <input type="number" name="max_login_attempts" value="5" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Lockout Duration (minutes)</label>
            <input type="number" name="lockout_duration" value="30" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Two-Factor Authentication</p>
              <p class="text-sm text-gray-500">Require 2FA for admins</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="require_2fa" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Password Expiration</p>
              <p class="text-sm text-gray-500">Force password changes</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="password_expiration" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>

      <!-- Password Policy -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-purple-100 rounded-lg mr-4">
            <i data-feather="key" class="w-6 h-6 text-purple-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Password Policy</h3>
            <p class="text-sm text-gray-500">Password strength requirements</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Length</label>
            <input type="number" name="password_min_length" value="8" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Require Uppercase</p>
              <p class="text-sm text-gray-500">At least one capital letter</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="password_require_uppercase" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Require Numbers</p>
              <p class="text-sm text-gray-500">At least one digit</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="password_require_numbers" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Require Special Characters</p>
              <p class="text-sm text-gray-500">At least one symbol</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="password_require_special" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>

      <!-- IP & Access Control -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-red-100 rounded-lg mr-4">
            <i data-feather="shield" class="w-6 h-6 text-red-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">IP & Access Control</h3>
            <p class="text-sm text-gray-500">Restrict access by IP address</p>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Allowed IP Addresses</label>
            <textarea name="allowed_ips" rows="4" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="192.168.1.0/24&#10;10.0.0.0/8&#10;One per line"></textarea>
            <p class="mt-1 text-xs text-gray-500">Leave empty to allow all IPs</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Blocked IP Addresses</label>
            <textarea name="blocked_ips" rows="4" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="203.0.113.0/24&#10;One per line"></textarea>
            <p class="mt-1 text-xs text-gray-500">Explicitly deny these IPs</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Enable IP Whitelist</p>
              <p class="text-sm text-gray-500">Only allow listed IPs</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="enable_ip_whitelist" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">CSRF Protection</p>
              <p class="text-sm text-gray-500">Cross-site request forgery</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="csrf_protection" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- System Tab -->
  <div id="content-system" class="tab-content hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Cache Settings -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg mr-4">
              <i data-feather="database" class="w-6 h-6 text-green-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Cache Configuration</h3>
              <p class="text-sm text-gray-500">Performance optimization</p>
            </div>
          </div>
          <button type="button" onclick="clearCache()" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
            Clear Cache
          </button>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Cache Driver</label>
            <select name="cache_driver" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="redis" selected>Redis</option>
              <option value="memcached">Memcached</option>
              <option value="file">File</option>
              <option value="array">Array (No Cache)</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Cache TTL (seconds)</label>
            <input type="number" name="cache_ttl" value="3600" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Enable Query Cache</p>
              <p class="text-sm text-gray-500">Cache database queries</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="query_cache_enabled" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Enable View Cache</p>
              <p class="text-sm text-gray-500">Cache rendered views</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="view_cache_enabled" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>

      <!-- Backup Settings -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg mr-4">
              <i data-feather="hard-drive" class="w-6 h-6 text-blue-600"></i>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Backup Settings</h3>
              <p class="text-sm text-gray-500">Automated backup configuration</p>
            </div>
          </div>
          <button type="button" onclick="runBackup()" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-sm text-xs font-medium rounded hover:from-blue-700 hover:to-purple-700">
            Run Now
          </button>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Backup Frequency</label>
            <select name="backup_frequency" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="daily" selected>Daily</option>
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Retention Period (days)</label>
            <input type="number" name="backup_retention" value="30" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Auto Backup</p>
              <p class="text-sm text-gray-500">Enable scheduled backups</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="auto_backup" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Backup to S3</p>
              <p class="text-sm text-gray-500">Store backups in cloud</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="backup_to_s3" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>

      <!-- Logging -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-purple-100 rounded-lg mr-4">
            <i data-feather="file-text" class="w-6 h-6 text-purple-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Logging & Monitoring</h3>
            <p class="text-sm text-gray-500">System logs and error tracking</p>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Log Level</label>
            <select name="log_level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="debug">Debug</option>
              <option value="info" selected>Info</option>
              <option value="warning">Warning</option>
              <option value="error">Error</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Log Retention (days)</label>
            <input type="number" name="log_retention" value="90" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Max Log Size (MB)</label>
            <input type="number" name="max_log_size" value="100" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Audit Logging</p>
              <p class="text-sm text-gray-500">Track user actions</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="audit_logging" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Error Tracking</p>
              <p class="text-sm text-gray-500">Log exceptions</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="error_tracking" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Performance Metrics</p>
              <p class="text-sm text-gray-500">Track response times</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="performance_metrics" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Appearance Tab -->
  <div id="content-appearance" class="tab-content hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Theme Settings -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-purple-100 rounded-lg mr-4">
            <i data-feather="droplet" class="w-6 h-6 text-purple-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Theme & Colors</h3>
            <p class="text-sm text-gray-500">Customize visual appearance</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Theme Mode</label>
            <select name="theme_mode" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="light" selected>Light</option>
              <option value="dark">Dark</option>
              <option value="auto">Auto (System)</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
            <div class="flex gap-3">
              <input type="color" name="primary_color" value="#3B82F6" class="h-10 w-20 border border-gray-300 rounded">
              <input type="text" value="#3B82F6" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
            <div class="flex gap-3">
              <input type="color" name="secondary_color" value="#8B5CF6" class="h-10 w-20 border border-gray-300 rounded">
              <input type="text" value="#8B5CF6" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>
        </div>
      </div>

      <!-- Logo & Branding -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-blue-100 rounded-lg mr-4">
            <i data-feather="image" class="w-6 h-6 text-blue-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Logo & Branding</h3>
            <p class="text-sm text-gray-500">Upload company logos</p>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
            <div class="flex items-center gap-4">
              <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-2xl">
                NX
              </div>
              <div>
                <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                  Upload New Logo
                </button>
                <p class="mt-2 text-xs text-gray-500">PNG, JPG or SVG. Max 2MB.</p>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-blue-600 rounded flex items-center justify-center text-white font-bold">
                N
              </div>
              <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                Upload Favicon
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- UI Preferences -->
      <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
        <div class="flex items-center mb-6">
          <div class="p-3 bg-green-100 rounded-lg mr-4">
            <i data-feather="layout" class="w-6 h-6 text-green-600"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">UI Preferences</h3>
            <p class="text-sm text-gray-500">Interface customization options</p>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Sidebar Collapsed</p>
              <p class="text-sm text-gray-500">Default sidebar state</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="sidebar_collapsed" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Show Breadcrumbs</p>
              <p class="text-sm text-gray-500">Display navigation path</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="show_breadcrumbs" checked class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-900">Compact Tables</p>
              <p class="text-sm text-gray-500">Reduced row spacing</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="compact_tables" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
    <a href="/admin" class="text-gray-600 hover:text-gray-900 flex items-center transition">
      <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
      Back to Dashboard
    </a>
    <div class="flex gap-3">
      <button type="button" onclick="window.location.reload()" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
        <i data-feather="rotate-ccw" class="w-4 h-4 inline mr-2"></i>
        Cancel
      </button>
      <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition font-medium shadow-sm">
        <i data-feather="save" class="w-4 h-4 inline mr-2"></i>
        Save All Settings
      </button>
    </div>
  </div>
</form>

<script>
  // Tab switching
  function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-button').forEach(el => {
      el.classList.remove('border-blue-600', 'text-blue-600');
      el.classList.add('border-transparent', 'text-gray-500');
    });
    
    document.getElementById('content-' + tab).classList.remove('hidden');
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-600', 'text-blue-600');
  }

  // Action functions
  function exportSettings() {
    alert('Export settings configuration');
  }

  function resetDefaults() {
    if (confirm('Reset all settings to default values?')) {
      alert('Settings reset to defaults');
    }
  }

  function testSMTP() {
    alert('Sending test email...');
  }

  function testSlack() {
    alert('Sending test Slack message...');
  }

  function clearCache() {
    alert('Cache cleared successfully');
  }

  function runBackup() {
    alert('Starting backup process...');
  }

  // Initialize Feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/admin_layout.php';
