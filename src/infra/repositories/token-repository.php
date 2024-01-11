<?php
require_once __DIR__ . '../../db/connection.php';

function saveToken($token)
{
    $sqlCreate = "INSERT INTO 
    tokens (
        email,
        token,
        type
        ) 
    VALUES (
        :email,
        :token,
        :type
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':email' => $token['email'],
        ':token' => $token['token'],
        ':type' => $token['type'],
    ]);

    return $success;
}


function getTokenInfoByToken($token)
{
    $sqlCreate = "
    SELECT 
        users.id as user_id,
        tokens.token as token,
        tokens.type as type
    FROM
        tokens
    INNER JOIN users 
        ON tokens.email = users.email
    WHERE 
        token = :token and tokens.deleted_at is null;
    ";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':token' => $token,
    ]);

    return $PDOStatement->fetch();
}

function deleteToken($id)
{
    $sqlUpdate = "UPDATE  
            tokens SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE token = :token ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':token' => $id
    ]);
}
