<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/user-mapper.php';
require_once __DIR__ . '../../mappers/ingredient-mapper.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';
require_once __DIR__ . '../../mappers/category-mapper.php';

class AdminUpdateRecipeController
{
    public function index()
    {
        if (isset($_GET['id']) && isset($_GET['recipe_id'])) {
            $id = $_GET['id'];
            $recipe = $_GET['recipe_id'];
            $user = toUserModel(getById($id));
            $recipe = toRecipeModel(getRecipeById($recipe));
            $title = "Editar Receita";
            $submit = "Salvar";
            $submit_action = "updateRecipe";
            $errors = $_SESSION['errors'];
            $errors_step = $_SESSION['errors_step'];
            $errors_ingredient = $_SESSION['errors_ingredient'];
            unset($_SESSION['errors']);
            unset($_SESSION['errors_step']);
            unset($_SESSION['errors_ingredient']);

            return view("secure/admin/recipe", [
                'administrator' => true,
                'ingredients' => toIngredientModelList(getAllIngredients()),
                'errors' =>  $errors,
                'errors_step' =>  $errors_step,
                'errors_ingredient' =>  $errors_ingredient,
                'recipe' => $recipe,
                'title' => $title,
                'submit' => $submit,
                'action' => $submit_action,
                'categories' => toCategoryModelList(getAllCategories()),
                'profile' => $user
            ]);
        } else {
            return header('location: /admin/recipes');
        }
    }
}
