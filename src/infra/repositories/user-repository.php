<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '../../../utils/uuid.php';

function createNewUser($user)
{
    $idUUID = createUUID();
    $display_name = $user['first_name'] . ' ' . $user['last_name'];
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $user['birth_date'] = $user['day'] . '/' . $user['mounth'] . '/' . $user['year'];
    $sqlCreate = "INSERT INTO 
    users (
        id,
        email, 
        password,
        salt,
        display_name, 
        first_name, 
        last_name, 
        description, 
        avatar,
        birth_date,
        gender_id, 
        is_admin) 
    VALUES (
        :id,
        :email, 
        :password,
        :salt, 
        :display_name, 
        :first_name, 
        :last_name,
        :description, 
        :avatar,
        :birth_date,
        :gender_id,  
        :is_admin
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':id' => $idUUID,
        ':email' => $user['email'],
        ':password' => $user['password'],
        ':salt' => $user['password'],
        ':display_name' => $display_name,
        ':first_name' => $user['first_name'],
        ':last_name' => $user['last_name'],
        ':description' => '',
        ':avatar' => 'c93a0f1a-50fd-d119-f984-c7edd07ca624',
        ':birth_date' => $user['birth_date'],
        ':gender_id' => $user['gender'],
        ':is_admin' => 0
    ]);

    if ($success) {
        $new['id'] = $idUUID;
        $new['display_name'] = $display_name;

        return $new;
    }

    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE id = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE email = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmailIfDeleted($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function changePrivilege($user)
{
    $sqlUpdate = "UPDATE  
            users SET
                is_admin = CASE WHEN is_admin = true THEN false ELSE true END
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':id' => $user['id']
    ]);

    return $success;
}

function updateUser($user)
{
    $sqlUpdate = "UPDATE  
            users SET
                email = :email,
                display_name = :display_name,
                first_name = :first_name,
                last_name = :last_name,
                description = :description
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':email' => $user['email'],
        ':display_name' => $user['first_name'] . ' ' . $user['last_name'],
        ':first_name' => $user['first_name'],
        ':last_name' => $user['last_name'],
        ':description' => $user['description'],
        ':id' => $user['id']
    ]);

    return $success;
}

function updateUserPassword($user)
{
    $sqlUpdate = "UPDATE  
            users SET
                password = :password
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':password' => password_hash($user['password'], PASSWORD_DEFAULT),
        ':id' => $user['id']
    ]);

    return $success;
}

function updateUserImage($user, $image)
{
    $sqlUpdate = "UPDATE  
            users SET
                avatar = :avatar
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':avatar' => $image,
        ':id' => $user
    ]);

    return $success;
}

function deleteUser($user)
{
    $sqlUpdate = "UPDATE  
            users SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id']
    ]);
}
