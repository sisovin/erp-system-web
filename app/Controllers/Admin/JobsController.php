<?php

namespace app\Controllers\Admin;

class JobsController
{
    public static function index()
    {
        require __DIR__ . '/../../../resources/views/admin/jobs.php';
    }
}
