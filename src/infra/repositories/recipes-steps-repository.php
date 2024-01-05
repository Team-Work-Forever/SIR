<?php
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../db/connection.php';

$createIngredients = [];

function addStepToRecipe($recipesStep)
{
    $sqlCreate = "INSERT INTO
    recipesSteps (
        recipe_id,
        name,
        step_number,
        description
        )
    VALUES (
        :recipe_id,
        :name,
        :step_number,
        :description
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $recipesStep['recipe_id'],
        ':name' => $recipesStep['name'],
        ':step_number' => $recipesStep['step_number'],
        ':description' => $recipesStep['description']
    ]);

    return $success;
}

function getAllStepsFormRecipe($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesSteps WHERE recipe_id = ? and deleted_at is null Order by step_number;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    $recipesSteps = [];
    while ($recipesStepsLits = $PDOStatement->fetch()) {
        $recipesSteps[] = $recipesStepsLits;
    }

    return $recipesSteps;
}

function getRecipeStepById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesSteps WHERE id = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function updateStepRecipe($step)
{
    $sqlUpdate = "UPDATE  
            recipesSteps SET
                step_number = :step_number,
                description = :description
            WHERE recipe_id = :recipe_id and id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':step_number' => $step['step_number'],
        ':description' => $step['description'],
        ':recipe_id' => $step['recipe_id'],
        ':id' => $step['step_id']
    ]);
}

function deleteStepRecipe($step)
{
    $sqlUpdate = "UPDATE  
            recipesSteps SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE recipe_id = :recipe_id and id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':recipe_id' => $step['recipe_id'],
        ':id' => $step['step_id']
    ]);
}
