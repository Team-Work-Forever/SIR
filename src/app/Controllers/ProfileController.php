<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/user-mapper.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class ProfileController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (getById($id)) {
                $errors = $_SESSION['errors'];
                unset($_SESSION['errors']);
                $admin = userId() == $id;
                $user = toUserModel(getById($id));
                if ($admin) {
                    $recipes = toRecipeModelList(getAllRecipesFromAuthenticatedUser());
                } else {
                    $recipes = toRecipeModelList(getRecipesByUserId($id));
                }
                return view("secure/user/profile", ['user' => $user, 'recipes' => $recipes, 'admin' => $admin, 'errors' => $errors, 'host' => $_SERVER['HTTP_HOST'], 'profile' => $_SESSION['id']]);
            } else {
                return header('location: /app');
            }
        } else {
            return header('location: /app');
        }
    }
}
