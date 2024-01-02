<?php

require_once __DIR__ . '../../models/recipe-ingredient-model.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../../infra/repositories/units-repository.php';

function toRecipeIngredientModel($ingredients)
{
    $list = [];


    foreach ($ingredients as $ingredient) {
        $list[] = new RecipeIngredientModel($ingredient['id'], $ingredient['recipe_id'],  getIngredientsById($ingredient['ingredient_id']), $ingredient['quantity'], getUnitById($ingredient['unit']),);
    }

    return $list;
}
