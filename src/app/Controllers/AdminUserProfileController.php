<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/user-mapper.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class AdminUserProfileController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (getById($id)) {
                $user = toUserModel(getById($id));
                $publicRecipes = toRecipeModelList(getRecipesByUserId($id));
                $privateRecipes = toRecipeModelList(getPrivateRecipesByUserId($id));
                $removedRecipes = toRecipeModelList(getRemovedRecipesByUserId($id));
                return view("secure/admin/user_profile", ['administrator' => true, 'user' => $user, 'publicRecipes' => $publicRecipes, 'privateRecipes' => $privateRecipes, 'removedRecipes' => $removedRecipes]);
            } else {
                return header('location: /admin/users');
            }
        } else {
            return header('location: /admin/users');
        }
    }
}
