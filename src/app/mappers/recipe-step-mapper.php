<?php

require_once __DIR__ . '../../models/recipe-step-model.php';

function toRecipeStepModel($steps)
{
    $list = [];


    foreach ($steps as $step) {
        $list[] = new RecipeStepModel($step['id'], $step['recipe_id'], $step['name'], $step['step_number'], $step['description'],);
    }

    return $list;
}
