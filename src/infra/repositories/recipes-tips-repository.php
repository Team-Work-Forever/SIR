<?php
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../db/connection.php';

function addTipRecipe($recipesTip)
{
    $sqlCreate = "INSERT INTO
    recipesTips (
        recipe_id,
        description,
        creator_id
        )
    VALUES (
        :recipe_id,
        :description,
        :creator_id
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $recipesTip['recipe_id'],
        ':description' => $recipesTip['description'],
        ':creator_id' => $recipesTip['creator_id']
    ]);

    return $success;
}

function addTipImageRecipe($req, $image, $imageName)
{
    $sqlCreate = "INSERT INTO
    recipesTips (
        recipe_id,
        description,
        image_id,
        creator_id
        )
    VALUES (
        :recipe_id,
        :description,
        :image_id,
        :creator_id
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $req['recipe_id'],
        ':description' => $imageName,
        ':image_id' => $image,
        ':creator_id' => $req['creator_id']
    ]);

    return $success;
}

function getAllTipsFormRecipe($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesTips WHERE recipe_id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    $recipesTips = [];
    while ($recipesTipsLits = $PDOStatement->fetch()) {
        $recipesTips[] = $recipesTipsLits;
    }

    return $recipesTips;
}

function deleteTipRecipe($tip)
{
    $sqlUpdate = "UPDATE  
            recipesTips SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE recipe_id = :recipe_id and id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':recipe_id' => $tip['recipe_id'],
        ':id' => $tip['tip_id']
    ]);
}
