<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';
require_once __DIR__ . '../../mappers/gender-mapper.php';

class AdminCreateUserController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $title = "Criar Utilizador";
        $submit_action = "createUser";
        return view("secure/admin/user", ['administrator' => true, 'errors' =>  $errors, 'title' => $title, 'action' => $submit_action, 'genders' => toGenderModel(getAllGenders()),]);
    }
}
