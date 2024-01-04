<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';

class AdminHomeController
{
    public function index()
    {
        return view("secure/admin/home", ['administrator' => true]);
    }
}
