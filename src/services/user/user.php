<?php

require_once __DIR__ . '/../../infra/repositories/user-repository.php';
require_once __DIR__ . '/../../infra/repositories/images-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-user.php';
@require_once __DIR__ . '../../../helpers/session.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'updateUser') {
        changeUser($_POST);
    }

    if ($_POST['user'] == 'deleteUser') {
        removeUser($_POST);
    }
}

function changeUser($req)
{
    $image = $_FILES["avatar"];

    $data = isUserValid($req, $image);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];

        $params = '?' . http_build_query($req);

        //TODO: ERROS EM MODALS
        // header('location: /app/profile?id=' . $req['id']);
    } else {
        if ($image['type'] != "") {
            $image['content'] = file_get_contents($image["tmp_name"]);

            $imageInserted = createImage($image);

            updateUserImage($data['id'], $imageInserted);
        }

        if (!empty($data['password'])) {
            updateUserPassword($data);
        }
        $user = updateUser($data);

        unset($_FILES["avatar"]);

        $_SESSION['display_name'] = $user['display_name'];

        setcookie("display_name", $_SESSION['display_name'], time() + (60 * 60 * 24 * 30), "/app/profile?id=" . $req['id']);

        header('location: /app/profile?id=' . $req['id']);
    }
}

function removeUser($req)
{
    deleteUser($req['id']);

    //TODO: VER PÁGINA DO ADMIN
    header('location: /app');
}
