<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';

class AdminCreateCategoryController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $title = "Criar Categoria";
        $submit_action = "createCategory";
        $variableName = "category";
        return view("secure/admin/variable", ['administrator' => true, 'errors' =>  $errors, 'variableName' => $variableName, 'title' => $title, 'action' => $submit_action,]);
    }
}
