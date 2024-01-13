<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class HomeController
{
    private function __get_params($params,  $categories)
    {
        $categoriesSelected = [];

        foreach ($categories as $category) {
            if (count($params) == 0) {
                $categoriesSelected[] = $category['id'];
            }

            if (isset($params[$category['name']])) {
                $categoriesSelected[] = $category['id'];
            }
        }

        return $categoriesSelected;
    }

    public function index()
    {
        $queries_params = $_GET;
        $categories = getAllCategories();

        $recipes = getAllPublicRecipesByCategories($this->__get_params($queries_params, $categories));

        return view("secure/user/home", [
            'public' => toRecipeModelList($recipes),
            'host' => $_SERVER['HTTP_HOST'],
            'profile' => $_SESSION['id'],
            'categories' => json_encode(getAllCategories()),
        ]);
    }
}
