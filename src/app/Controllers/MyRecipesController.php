<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class MyRecipesController
{
    public function index()
    {
        return view("secure/user/my_recipes", ['recipes' => toRecipeModelList(getAllRecipesFromAuthenticatedUser()), 'favorites' => toRecipeModelList(getAllFavoriteRecipesFromAuthenticatedUser()), 'host' => $_SERVER['HTTP_HOST'], 'profile' => $_SESSION['id']]);
    }
}
