<?php

require_once __DIR__ . '/../../infra/repositories/user-repository.php';
require_once __DIR__ . '/../../infra/repositories/images-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-user.php';
@require_once __DIR__ . '../../../helpers/session.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'createUser') {
        create($_POST);
    }

    if ($_POST['user'] == 'updateUser') {
        changeUser($_POST);
    }

    if ($_POST['user'] == 'updateUserAdmin') {
        update($_POST);
    }

    if ($_POST['user'] == 'deleteUser') {
        removeUser($_POST);
    }

    if ($_POST['user'] == 'changeStatusUser') {
        changeStatus($_POST);
    }
}

function create($req)
{
    $image = $_FILES["avatar"];
    unset($_FILES["avatar"]);

    $data = isNewUserValid($req, $image);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        $params = '?first_name=' . $req['first_name'] . '&last_name=' . $req['last_name'] . '&email=' . $req['email'] . '&day=' . $req['day'] . '&month=' . $req['month'] . '&year=' . $req['year'] . '&gender=' . $req['gender'] . '&description=' . $req['description'];

        header('location: /admin/users/createuser' . $params);
        return;
    }

    $user = createNewUser($data);

    if ($image['type'] != "") {
        $image['content'] = file_get_contents($image["tmp_name"]);

        $imageInserted = createImage($image);

        updateUserImage($user['id'], $imageInserted);
    }

    header('location: ' . $req['path']);
}

function update($req)
{
    $image = $_FILES["avatar"];
    unset($_FILES["avatar"]);

    $data = isUserValid($req, $image);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];

        $params = '&first_name=' . $req['first_name'] . '&last_name=' . $req['last_name'] . '&newemail=' . $req['email'] . '&description=' . $req['description'];

        header('location: /admin/users/updateuser?id=' . $req['user_id'] . $params);
        return;
    }

    if ($image['type'] != "") {
        $image['content'] = file_get_contents($image["tmp_name"]);

        $imageInserted = createImage($image);

        updateUserImage($req['user_id'], $imageInserted);
    }

    if (!empty($data['password'])) {
        updateUserPassword($data);
    }

    updateUser($data);

    header('location: ' . $req['path']);
}

function changeUser($req)
{
    $image = $_FILES["avatar"];
    unset($_FILES["avatar"]);

    $data = isUserValid($req, $image);


    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];

        $params = '&first_name=' . $req['first_name'] . '&last_name=' . $req['last_name'] . '&newemail=' . $req['email'] . '&description=' . trim($req['description']);

        if (!administrator()) {
            $params = $params . '&modal=editProfile';
        }

        return header('location: /app/profile?id=' . $req['user_id'] . $params);
    }

    if ($image['type'] != "") {
        $image['content'] = file_get_contents($image["tmp_name"]);

        $imageInserted = createImage($image);

        updateUserImage($data['user_id'], $imageInserted);
    }

    if (!empty($data['password'])) {
        updateUserPassword($data);
    }

    $user = updateUser($data);

    $_SESSION['display_name'] = $user['display_name'];

    setcookie("display_name", $_SESSION['display_name'], time() + (60 * 60 * 24 * 30), "/app/profile?id=" . $req['user_id']);

    header('location: /app/profile?id=' . $req['user_id']);
}

function removeUser($req)
{
    deleteUser($req['user_id']);

    header('location: /admin/users');
}

function changeStatus($req)
{
    changeUserStatus($req['user_id']);

    header('location: ' . $req['path']);
}
