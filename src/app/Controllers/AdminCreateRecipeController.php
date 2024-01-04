<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/user-mapper.php';
require_once __DIR__ . '../../mappers/category-mapper.php';

class AdminCreateRecipeController
{
    public function index()
    {
        if (isset($_GET['id']) && isset($_GET['is_private'])) {
            $id = $_GET['id'];
            $isPrivate = $_GET['is_private'];
            $user = toUserModel(getById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Criar Receita";
            $submit = "Continuar";
            $submit_action = "createRecipe";

            return view("secure/admin/recipe", [
                'administrator' => true,
                'errors' =>  $errors,
                'title' => $title,
                'submit' => $submit,
                'action' => $submit_action,
                'categories' => toCategoryModelList(getAllCategories()),
                'profile' => $user,
                'privacy' => $isPrivate
            ]);
        } else {
            return header('location: /admin/recipes');
        }
    }
}
