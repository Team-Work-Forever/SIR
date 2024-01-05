<?php

require_once __DIR__ . '../../models/recipe-model.php';
require_once __DIR__ . '../../mappers/recipe-ingredient-mapper.php';
require_once __DIR__ . '../../mappers/recipe-step-mapper.php';
require_once __DIR__ . '../../mappers/recipe-tip-mapper.php';
require_once __DIR__ . '../../mappers/image-mapper.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-ingredients-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-steps-repository.php';
require_once __DIR__ . '../../../infra/repositories/recipes-tips-repository.php';
require_once __DIR__ . '../../../infra/repositories/user-repository.php';
require_once __DIR__ . '../../../infra/repositories/images-repository.php';

function toRecipeModel($recipe)
{
    $creator = getById($recipe['creator_id']);
    $creator_name = $creator['display_name'];
    $category = getCategoryById($recipe['category_id']);
    $category_name = $category['name'];
    $cover = getImageById($recipe['cover']);
    return new RecipeModel(
        $recipe['id'],
        $recipe['title'],
        $recipe['execution_time'],
        $recipe['servings'],
        toImageModel($cover),
        $recipe['is_private'],
        $creator_name,
        $recipe['creator_id'],
        $recipe['category_id'],
        $category_name,
        $recipe['description'],
        toRecipeTipModel(getAllTipsFormRecipe($recipe['id'])),
        toRecipeIngredientModel(getAllIngredientsFormRecipe($recipe['id'])),
        toRecipeStepModelList(getAllStepsFormRecipe($recipe['id'])),
        isRecipeFavorite($recipe['id']) ? true : false,
        $recipe['created_at'],
        $recipe['updated_at'],
    );
}

function toRecipeModelList($recipes)
{
    $list = [];

    foreach ($recipes as $recipe) {

        $creator = getById($recipe['creator_id']);
        $creator_name = $creator['display_name'];
        $category = getCategoryById($recipe['category_id']);
        $category_name = $category['name'];

        $list[] = new RecipeModel(
            $recipe['id'],
            $recipe['title'],
            $recipe['execution_time'],
            $recipe['servings'],
            toImageModel(getImageById($recipe['cover'])),
            $recipe['is_private'],
            $creator_name,
            $recipe['creator_id'],
            $recipe['category_id'],
            $category_name,
            $recipe['description'],
            toRecipeTipModel(getAllTipsFormRecipe($recipe['id'])),
            toRecipeIngredientModel(getAllIngredientsFormRecipe($recipe['id'])),
            toRecipeStepModelList(getAllStepsFormRecipe($recipe['id'])),
            isRecipeFavorite($recipe['id']) ? true : false,
            $recipe['created_at'],
            $recipe['updated_at'],
        );
    }

    return $list;
}
