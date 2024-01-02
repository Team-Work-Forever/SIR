<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/category-mapper.php';

class CreateRecipeController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $title = "Criar Receita";
        $submit = "Continuar";
        $submit_action = "createRecipe";
        return view("secure/user/recipe", ['errors' =>  $errors, 'title' => $title, 'submit' => $submit, 'action' => $submit_action, 'categories' => toCategoryModel(getAllCategories()), 'profile' => $_SESSION['id']]);
    }
}
