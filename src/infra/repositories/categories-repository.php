<?php
require_once __DIR__ . '../../db/connection.php';

function createCategory($category)
{
    $sqlCreate = "INSERT INTO 
    categories (
        name
        ) 
    VALUES (
        :name
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':name' => $category['name']
    ]);

    return $success;
}

function getAllCategories()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM categories WHERE deleted_at is null;');
    $categories = [];
    while ($categoriesLits = $PDOStatement->fetch()) {
        $categories[] = $categoriesLits;
    }

    return $categories;
}

function getCategoryById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM categories WHERE id = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getCategoryByName($name)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT id FROM categories WHERE name = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $name);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function updateCategory($category)
{
    $sqlUpdate = "UPDATE  
            categories SET
                name = :name 
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $category['id'],
        ':name' => $category['name']
    ]);
}

function deleteCategory($id)
{
    $sqlUpdate = "UPDATE  
            categories SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}
