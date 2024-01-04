<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class AdminRecipesController
{
    public function index()
    {
        $publicRecipes = toRecipeModelList(getAllPublicRecipes());
        $privateRecipes = toRecipeModelList(getAllPrivatesRecipes());
        $removedRecipes = toRecipeModelList(getAllRemovedRecipes());
        return view("secure/admin/recipes", ['administrator' => true, 'publicRecipes' => $publicRecipes, 'privateRecipes' => $privateRecipes, 'removedRecipes' => $removedRecipes]);
    }
}
