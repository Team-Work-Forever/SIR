<?php
require_once __DIR__ . '../../db/connection.php';

function createGender($gender)
{
    $sqlCreate = "INSERT INTO 
    genders (
        name
        ) 
    VALUES (
        :name
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':name' => $gender['name']
    ]);

    return $success;
}

function getAllGenders()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM genders WHERE deleted_at is null;');
    $genders = [];
    while ($gendersLits = $PDOStatement->fetch()) {
        $genders[] = $gendersLits;
    }

    return $genders;
}

function getGenderById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM genders WHERE id = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getGenderByName($name)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT id FROM genders WHERE name = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $name);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function updateGender($gender)
{
    $sqlUpdate = "UPDATE  
            genders SET
                name = :name 
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $gender['gender_id'],
        ':name' => $gender['name']
    ]);
}

function deleteGender($id)
{
    $sqlUpdate = "UPDATE  
            genders SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}
