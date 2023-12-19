<?php
require_once __DIR__ . '../../db/connection.php';

function createUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    users2 (
        name, 
        lastname, 
        phoneNumber, 
        email, 
        foto, 
        administrator, 
        password) 
    VALUES (
        :name, 
        :lastname, 
        :phoneNumber, 
        :email, 
        :foto, 
        :administrator, 
        :password
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':name' => $user['name'],
        ':lastname' => $user['lastname'],
        ':phoneNumber' => $user['phoneNumber'],
        ':email' => $user['email'],
        ':foto' => $user['foto'],
        ':administrator' => $user['administrator'],
        ':password' => $user['password']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users2 WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users2 WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM users2;');
    $users2 = [];
    while ($listaDeusers2 = $PDOStatement->fetch()) {
        $users2[] = $listaDeusers2;
    }
    return $users2;
}

function updateUser($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        users2 SET
            name = :name, 
            lastname = :lastname, 
            phoneNumber = :phoneNumber, 
            email = :email, 
            foto = :foto, 
            administrator = :administrator, 
            password = :password
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':name' => $user['name'],
            ':lastname' => $user['lastname'],
            ':phoneNumber' => $user['phoneNumber'],
            ':email' => $user['email'],
            ':foto' => $user['foto'],
            ':administrator' => $user['administrator'],
            ':password' => $user['password']
        ]);
    }

    $sqlUpdate = "UPDATE  
    users2 SET
        name = :name, 
        lastname = :lastname, 
        phoneNumber = :phoneNumber, 
        email = :email, 
        foto = :foto, 
        administrator = :administrator
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id'],
        ':name' => $user['name'],
        ':lastname' => $user['lastname'],
        ':phoneNumber' => $user['phoneNumber'],
        ':email' => $user['email'],
        ':foto' => $user['foto'],
        ':administrator' => $user['administrator']
    ]);
}

function updatePassword($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        users2 SET
            name = :name, 
            password = :password
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':name' => $user['name'],
            ':password' => $user['password']
        ]);
    }
}

function deleteUser($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM users2 WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function createNewUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    users2 (
        name, 
        email, 
        password) 
    VALUES (
        :name, 
        :email, 
        :password
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':name' => $user['name'],
        ':email' => $user['email'],
        ':password' => $user['password']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}
