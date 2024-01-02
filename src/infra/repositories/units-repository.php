<?php
require_once __DIR__ . '../../db/connection.php';

function createUnit($unit)
{
    $sqlCreate = "INSERT INTO 
    units (
        name, 
        unit
        ) 
    VALUES (
        :name, 
        :unit
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':name' => $unit['name'],
        ':unit' => $unit['unit']
    ]);

    return $success;
}

function getUnitById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM units WHERE id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllUnits()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM units and deleted_at is null;');
    $units = [];
    while ($unitsLits = $PDOStatement->fetch()) {
        $units[] = $unitsLits;
    }
    return $units;
}

function updateUnit($unit)
{
    $sqlUpdate = "UPDATE  
    units SET
        name = :name, 
        unit = :unit
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':id' => $unit['id'],
        ':name' => $unit['name'],
        ':unit' => $unit['unit']
    ]);

    return $success;
}

function deleteUnitById($id)
{
    $sqlUpdate = "UPDATE  
            units SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}
