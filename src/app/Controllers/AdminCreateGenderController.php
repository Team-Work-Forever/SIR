<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';

class AdminCreateGenderController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $title = "Criar Género";
        $submit_action = "createGender";
        $variableName = "gender";
        return view("secure/admin/variable", ['administrator' => true, 'errors' =>  $errors, 'variableName' => $variableName, 'title' => $title, 'action' => $submit_action,]);
    }
}
