<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';
require_once __DIR__ . '../../mappers/ingredient-mapper.php';

class AdminCreateIngredientRecipeController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $recipe = toRecipeModel(getRecipeById($id));
            $ingredients = toIngredientModelList(getAllIngredients());
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Criar Ingredientes";
            $submit_action = "addIngredient";

            return view("secure/admin/recipe_ingredient", [
                'administrator' => true,
                'errors' =>  $errors,
                'title' => $title,
                'action' => $submit_action,
                'recipe' => $recipe,
                'ingredients' => $ingredients,
            ]);
        } else {
            return header('location: /admin/users');
        }
    }
}
