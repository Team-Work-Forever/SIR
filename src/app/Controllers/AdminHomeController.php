<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class AdminHomeController
{
    public function index()
    {
        return view("secure/admin/home", ['administrator' => true]);
    }
}
