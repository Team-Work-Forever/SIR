<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';
require_once __DIR__ . '../../../infra/repositories/units-repository.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../mappers/category-mapper.php';
require_once __DIR__ . '../../mappers/gender-mapper.php';
require_once __DIR__ . '../../mappers/unit-mapper.php';
require_once __DIR__ . '../../mappers/ingredient-mapper.php';

class AdminVariablesController
{
    public function index()
    {
        $categories = toCategoryModelList(getAllCategories());
        $genders = toGenderModelList(getAllGenders());
        $units = toUnitModelList(getAllUnits());
        $ingredients = toIngredientModelList(getAllIngredients());

        return view("secure/admin/variables", [
            'administrator' => true, 'categories' => $categories, 'genders' => $genders, 'units' => $units, 'ingredients' => $ingredients
        ]);
    }
}
