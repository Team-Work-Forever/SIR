<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';

class AdminHomeController
{
    public function index()
    {
        $graphRecipeCategories = [];
        $graphUserGenders = [];

        $categories = getAllCategories();
        $publicRecipes = getNumberPublicRecipes();
        $privateRecipes = getNumberPrivatesRecipes();
        $users = getNumberUsers();
        $genders = getAllGendersWithDeletedIncluded();

        foreach ($categories as $category) {
            $graphRecipeCategories[] = [
                'name' => $category['name'],
                'quantity' => getNumberOfRecipesByCategory($category['id'])
            ];
        }

        foreach ($genders as $gender) {
            $graphUserGenders[] = [
                'name' => $gender['name'],
                'quantity' => getNumberOfUsersByGender($gender['id'])
            ];
        }

        return view("secure/admin/home", [
            'administrator' => true,
            'categories' => json_encode($graphRecipeCategories),
            'publicRecipes' => $publicRecipes,
            'privateRecipes' => $privateRecipes,
            'users' => $users,
            'genders' => json_encode($graphUserGenders),
        ]);
    }
}
