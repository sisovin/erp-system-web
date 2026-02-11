<?php
namespace app\Models;

class ScheduledExport
{
    public $id;
    public $name;
    public $description;
    public $columns; // comma separated
    public $format;
    public $retention_days;
    public $upload_to_s3;
    public $enabled;
    public $created_by;
    public $last_run_at;
    public $created_at;
    public $updated_at;

    public static function fromRow(array $row): self
    {
        $s = new self();
        foreach ($row as $k => $v) {
            $s->$k = $v;
        }
        return $s;
    }
}
