<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';

class AdminCreateStepRecipeController
{
    public function index()
    {
        if (isset($_GET['recipe_id'])) {
            $recipe_id = $_GET['recipe_id'];
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Criar Ação";
            $submit_action = "addStep";

            return view("secure/admin/recipe_step", [
                'administrator' => true,
                'errors' =>  $errors,
                'title' => $title,
                'action' => $submit_action,
                'recipe_id' => $recipe_id,
            ]);
        } else {
            return header('location: /admin/users');
        }
    }
}
