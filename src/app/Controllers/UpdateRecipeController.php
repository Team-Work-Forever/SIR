<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/middlewares/middleware-owner.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/ingredient-mapper.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';
require_once __DIR__ . '../../mappers/category-mapper.php';

class UpdateRecipeController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $recipe = toRecipeModel(getRecipeById($id));
            $title = "Editar Receita";
            $submit = "Salvar";
            $submit_action = "updateRecipe";
            $errors = $_SESSION['errors'];
            $errors_step = $_SESSION['errors_step'];
            $errors_ingredient = $_SESSION['errors_ingredient'];
            unset($_SESSION['errors']);
            unset($_SESSION['errors_step']);
            unset($_SESSION['errors_ingredient']);
            return view("secure/user/recipe", ['ingredients' => toIngredientModel(getAllIngredients()), 'errors' =>  $errors, 'errors_step' =>  $errors_step, 'errors_ingredient' =>  $errors_ingredient, 'recipe' => $recipe, 'title' => $title, 'submit' => $submit, 'action' => $submit_action, 'categories' => toCategoryModel(getAllCategories()), 'profile' => $_SESSION['id']]);
        } else {
            return header('location: /app/myrecipes');
        }
    }
}
