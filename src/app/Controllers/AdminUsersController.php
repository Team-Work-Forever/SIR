<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../mappers/user-mapper.php';

class AdminUsersController
{
    public function index()
    {
        $users = toUserModelList(getAllUsers());
        $removedUsers = toUserModelList(getAllRemovedUsers());

        return view("secure/admin/users", ['administrator' => true, 'users' => $users, 'removedUsers' => $removedUsers]);
    }
}
