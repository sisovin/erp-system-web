<?php
namespace app\Services;

use app\Repositories\SettingsRepository;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;
use Cron\CronExpression;

class NotificationService
{
    public static function sendSlack(string $webhookUrl, string $message, array $attachments = []): bool
    {
        if (empty($webhookUrl)) {
            return false;
        }

        $payload = ['text' => $message];
        if (!empty($attachments)) {
            $payload['attachments'] = $attachments;
        }

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($response === 'ok' || $response === "ok\n" ) {
            return true;
        }

        // If webhook returns something else, consider it a success if no curl error
        return empty($err);
    }

    public static function sendEmail(array $to, string $subject, string $body, bool $isHtml = true): bool
    {
        // read SMTP settings from DB
        $host = SettingsRepository::get('smtp_host', env('MAIL_HOST', null));
        $port = SettingsRepository::get('smtp_port', env('MAIL_PORT', 587));
        $username = SettingsRepository::get('smtp_username', env('MAIL_USERNAME', null));
        $password = SettingsRepository::get('smtp_password', env('MAIL_PASSWORD', null));
        $from = SettingsRepository::get('smtp_from', env('MAIL_FROM', 'no-reply@example.com'));
        $smtp_secure = SettingsRepository::get('smtp_secure', env('MAIL_SECURE', 'tls'));

        if (empty($host)) return false;

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->Port = (int)$port;
            $mail->SMTPAuth = !empty($username);
            if (!empty($username)) {
                $mail->Username = $username;
                $mail->Password = $password;
            }
            if ($smtp_secure === 'ssl') $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; else $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom($from);
            foreach ($to as $recipient) { $mail->addAddress($recipient); }
            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (MailException $e) {
            // log if audit service available
            try { AuditService::log(null, 'notification_failed', 'notifications', null, null, ['error' => $e->getMessage()], null, 'error'); } catch (\Exception $xx) {}
            return false;
        }
    }

    public static function notifyExportCreated(array $exportRecord, bool $uploaded = false): bool
    {
        $success = false;
        $webhook = SettingsRepository::get('slack_webhook_url', env('SLACK_WEBHOOK_URL', null));

        $filename = $exportRecord['filename'] ?? 'export';
        $size = isset($exportRecord['size']) ? self::humanFilesize($exportRecord['size']) : null;
        $path = $exportRecord['public_url'] ?? ($exportRecord['path'] ?? null);
        $uploadedText = $uploaded ? "(uploaded to S3)" : "";

        $message = "Export created: *{$filename}* {$uploadedText}";
        if ($size) $message .= " — {$size}";
        if ($path) $message .= "\n{$path}";

        if ($webhook) $success = self::sendSlack($webhook, $message) || $success;

        // optional email recipients
        $emails = SettingsRepository::get('notify_emails', null);
        if ($emails) {
            $list = array_filter(array_map('trim', explode(',', $emails)));
            if ($list) {
                $subject = "Export created: {$filename}";
                $body = nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE));
                $success = self::sendEmail($list, $subject, $body) || $success;
            }
        }

        return $success;
    }

    private static function humanFilesize($bytes, $decimals = 2)
    {
        $size = ['B','KB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    }
}
