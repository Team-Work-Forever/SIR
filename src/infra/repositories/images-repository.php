<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '../../../utils/uuid.php';

function createImage($image)
{
    $idUUID = createUUID();
    $sqlCreate = "INSERT INTO 
    images (
        id,
        name,
        content,
        type
        ) 
    VALUES (
        :id,
        :name,
        :content,
        :type
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':id' => $idUUID,
        ':name' => $image['name'],
        ':content' => $image['content'],
        ':type' => $image['type']
    ]);

    if ($success) {
        return $idUUID;
    }

    return false;
}

function getImageById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM images WHERE id = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function deleteImage($id)
{
    $sqlUpdate = "UPDATE  
            images SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}
