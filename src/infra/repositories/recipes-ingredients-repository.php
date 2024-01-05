<?php
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../db/connection.php';

$createIngredients = [];

function addIngredientRecipe($recipesIngredient)
{
    $sqlCreate = "INSERT INTO
    recipesIngredients (
        recipe_id,
        ingredient_id,
        quantity,
        unit
        )
    VALUES (
        :recipe_id,
        :ingredient_id,
        :quantity,
        :unit
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $recipesIngredient['recipe_id'],
        ':ingredient_id' => $recipesIngredient['ingredient_id'],
        ':quantity' => $recipesIngredient['quantity'],
        ':unit' => $recipesIngredient['unit']
    ]);

    return $success;
}

function getIngredientsRecipe($ingredient)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesIngredients WHERE recipe_id = ? and ingredient_id = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $ingredient['recipe_id']);
    $PDOStatement->bindValue(2, $ingredient['ingredient_id'], PDO::PARAM_INT);
    $PDOStatement->execute();

    return $PDOStatement->fetch();
}

function getAllIngredientsFormRecipe($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesIngredients WHERE recipe_id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    $recipesIngredients = [];
    while ($recipesIngredientsLits = $PDOStatement->fetch()) {
        $recipesIngredients[] = $recipesIngredientsLits;
    }

    return $recipesIngredients;
}

function updateIngredientRecipe($ingredient)
{
    $sqlUpdate = "UPDATE  
            recipesIngredients SET
                quantity = :quantity,
                unit = :unit
            WHERE recipe_id = :recipe_id and ingredient_id = :ingredient_id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':quantity' => $ingredient['quantity'],
        ':unit' => $ingredient['unit'],
        ':recipe_id' => $ingredient['recipe_id'],
        ':ingredient_id' => $ingredient['ingredient_id']
    ]);
}

function deleteIngredientRecipe($ingredient)
{
    $sqlUpdate = "UPDATE  
            recipesIngredients SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE recipe_id = :recipe_id and id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':recipe_id' => $ingredient['recipe_id'],
        ':id' => $ingredient['id']
    ]);
}
