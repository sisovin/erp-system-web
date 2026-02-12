<?php
namespace app\Controllers\Admin;

require_once __DIR__ . '/../../Repositories/ScheduledExportRepository.php';
require_once __DIR__ . '/../../Models/ScheduledExport.php';

use app\Repositories\ScheduledExportRepository;
use app\Models\ScheduledExport;

class ScheduledExportController
{
    public static function index()
    {
        $items = ScheduledExportRepository::allEnabled();
        require __DIR__ . '/../../../resources/views/admin/scheduled_exports/index.php';
    }

    public static function createForm()
    {
        $item = new ScheduledExport();
        require __DIR__ . '/../../../resources/views/admin/scheduled_exports/form.php';
    }

    public static function editForm($id)
    {
        $item = ScheduledExportRepository::findById($id);
        if (!$item) {
            header('Location: /admin/scheduled-exports');
            exit;
        }
        require __DIR__ . '/../../../resources/views/admin/scheduled_exports/form.php';
    }

    public static function store()
    {
        $s = new ScheduledExport();
        $s->name = $_POST['name'] ?? '';
        $s->description = $_POST['description'] ?? null;
        $s->columns = $_POST['columns'] ?? null;
        $s->format = $_POST['format'] ?? 'csv';
        $s->schedule_type = $_POST['schedule_type'] ?? 'daily';
        $s->schedule_time = $_POST['schedule_time'] ?? null; // HH:MM
        $s->schedule_cron = $_POST['schedule_cron'] ?? null;
        $s->retention_days = (int)($_POST['retention_days'] ?? 30);
        $s->upload_to_s3 = isset($_POST['upload_to_s3']) ? 1 : 0;
        $s->enabled = isset($_POST['enabled']) ? 1 : 0;
        $s->created_by = $_SESSION['user_id'] ?? null;
        $s = ScheduledExportRepository::save($s);
        header('Location: /admin/scheduled-exports');
        exit;
    }

    public static function update($id)
    {
        $s = ScheduledExportRepository::findById($id);
        if (!$s) {
            header('Location: /admin/scheduled-exports');
            exit;
        }
        $s->name = $_POST['name'] ?? $s->name;
        $s->description = $_POST['description'] ?? $s->description;
        $s->columns = $_POST['columns'] ?? $s->columns;
        $s->format = $_POST['format'] ?? $s->format;
        $s->schedule_type = $_POST['schedule_type'] ?? $s->schedule_type;
        $s->schedule_time = $_POST['schedule_time'] ?? $s->schedule_time;
        $s->schedule_cron = $_POST['schedule_cron'] ?? $s->schedule_cron;
        $s->retention_days = (int)($_POST['retention_days'] ?? $s->retention_days);
        $s->upload_to_s3 = isset($_POST['upload_to_s3']) ? 1 : 0;
        $s->enabled = isset($_POST['enabled']) ? 1 : 0;
        $s = ScheduledExportRepository::save($s);
        header('Location: /admin/scheduled-exports');
        exit;
    }

    public static function delete($id)
    {
        ScheduledExportRepository::delete($id);
        header('Location: /admin/scheduled-exports');
        exit;
    }

    public static function generateTimers()
    {
        // Run generator script and show output
        $cmd = PHP_BINARY . ' ' . __DIR__ . '/../../../cli/generate_systemd_timers.php';
        $out = [];
        $code = 0;
        exec($cmd, $out, $code);
        flash_set('message', implode("\n", $out));
        header('Location: /admin/scheduled-exports');
        exit;
    }
}
