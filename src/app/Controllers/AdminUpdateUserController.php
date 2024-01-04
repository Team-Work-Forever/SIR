<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../mappers/gender-mapper.php';
require_once __DIR__ . '../../mappers/user-mapper.php';

class AdminUpdateUserController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = toUserModel(getById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Utilizador";
            $submit_action = "updateUserAdmin";
            return view("secure/admin/user", ['administrator' => true, 'errors' =>  $errors, 'user' => $user, 'title' => $title, 'action' => $submit_action, 'genders' => toGenderModel(getAllGenders()),]);
        } else {
            return header('location: /admin/users');
        }
    }
}
