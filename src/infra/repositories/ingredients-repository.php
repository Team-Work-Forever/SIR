<?php
require_once __DIR__ . '../../db/connection.php';

function createNewIngredient($ingredient)
{
    $sqlCreate = "INSERT INTO
    ingredients (
        id,
        name,
        price,
        unit
        )
    VALUES (
        :id,
        :name,
        :price,
        :unit
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':id' => $ingredient['id'],
        ':name' => $ingredient['name'],
        ':price' => $ingredient['price'],
        ':unit' => $ingredient['unit']
    ]);

    return $success;
}

function getAllIngredients()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM ingredients WHERE deleted_at is null;');
    $ingredients = [];
    while ($ingredientsLits = $PDOStatement->fetch()) {
        $ingredients[] = $ingredientsLits;
    }

    return $ingredients;
}

function getIngredientsById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM ingredients WHERE id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function deleteIngredientById($id)
{
    $sqlUpdate = "UPDATE  
            ingredients SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}
