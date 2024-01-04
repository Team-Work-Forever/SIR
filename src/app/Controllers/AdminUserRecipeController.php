<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class AdminUserRecipeController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (getRecipeById($id)) {
                $recipe = toRecipeModel(getRecipeById($id));
                return view("secure/admin/user_profile_recipe", ['administrator' => true, 'recipe' => $recipe,]);
            } else {
                return header('location: /admin/users');
            }
        } else {
            return header('location: /admin/users');
        }
    }
}
