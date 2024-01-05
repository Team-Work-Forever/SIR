<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/recipes-steps-repository.php';
require_once __DIR__ . '../../mappers/recipe-step-mapper.php';

class AdminUpdateStepRecipeController
{
    public function index()
    {
        if (isset($_GET['id']) && isset($_GET['recipe_id'])) {
            $id = $_GET['id'];
            $recipe_id = $_GET['recipe_id'];
            $step = toRecipeStepModel(getRecipeStepById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Ação";
            $submit_action = "editStep";

            return view("secure/admin/recipe_step", [
                'administrator' => true,
                'errors' =>  $errors,
                'variable' => $step,
                'title' => $title,
                'action' => $submit_action,
                'recipe_id' => $recipe_id,
            ]);
        } else {
            return header('location: /admin/users');
        }
    }
}
