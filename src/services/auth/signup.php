<?php
session_start();

require_once __DIR__ . '/../../infra/repositories/user-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-sign-up.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'registerNewUser') {
        signUp($_POST);
    }
}

function signUp($req)
{
    $data = isSignUpValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        $params = '?' . http_build_query($req);

        //TODO: ERROS EM MODALS
        header('location: /secure/user/recipe' . $params);
    } else {

        $user = createNewUser($data);

        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['display_name'] = $user['display_name'];

            setcookie("id", $_SESSION['id'], time() + (60 * 60 * 24 * 30), "/");
            setcookie("display_name", $_SESSION['display_name'], time() + (60 * 60 * 24 * 30), "/");

            header('location: /app');
        } else {
            header('location: /');
        }
    }
}