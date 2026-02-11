<?php
namespace app\Controllers\Admin;

require_once __DIR__ . '/../../Repositories/SettingsRepository.php';

use app\Repositories\SettingsRepository;

class SettingsController
{
    public static function edit()
    {
        $data = [
            'slack_webhook_url' => SettingsRepository::get('slack_webhook_url', ''),
            'notify_emails' => SettingsRepository::get('notify_emails', ''),

            'smtp_host' => SettingsRepository::get('smtp_host', ''),
            'smtp_port' => SettingsRepository::get('smtp_port', ''),
            'smtp_username' => SettingsRepository::get('smtp_username', ''),
            'smtp_from' => SettingsRepository::get('smtp_from', ''),
            'smtp_secure' => SettingsRepository::get('smtp_secure', 'tls'),
        ];
        require __DIR__ . '/../../../../resources/views/admin/settings.php';
    }

    public static function update()
    {
        // CSRF should be enforced globally for POST
        SettingsRepository::set('slack_webhook_url', $_POST['slack_webhook_url'] ?? '', false);
        SettingsRepository::set('notify_emails', $_POST['notify_emails'] ?? '', false);

        SettingsRepository::set('smtp_host', $_POST['smtp_host'] ?? '', false);
        SettingsRepository::set('smtp_port', $_POST['smtp_port'] ?? '', false);
        SettingsRepository::set('smtp_username', $_POST['smtp_username'] ?? '', false);
        SettingsRepository::set('smtp_from', $_POST['smtp_from'] ?? '', false);
        SettingsRepository::set('smtp_secure', $_POST['smtp_secure'] ?? 'tls', false);

        // password is secret
        if (isset($_POST['smtp_password']) && $_POST['smtp_password'] !== '') {
            SettingsRepository::set('smtp_password', $_POST['smtp_password'], true);
        }

        header('Location: /admin/settings');
        exit;
    }
}
