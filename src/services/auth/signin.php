<?php
session_start();

require_once __DIR__ . '/../../infra/repositories/user-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-login-password.php';
@require_once __DIR__ . '../../../helpers/session.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'login') {
        login($_POST);
    }

    if ($_POST['user'] == 'logout') {
        logout();
    }
}

function login($req)
{
    $data = isLoginValid($req);
    $valid = checkErrors($data, $req);

    if ($valid) {
        $data = isPasswordValid($data);
    }

    $user = checkErrors($data, $req);

    if ($user) {
        doLogin($data);
    }
}

function checkErrors($data, $req)
{
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?email=' . $req['email'];
        //TODO: ERROS EM MODALS
        header('location: /' . $params);
        return false;
    }

    return true;
}

function doLogin($data)
{
    $_SESSION['id'] = $data['id'];
    $_SESSION['display_name'] = $data['display_name'];

    setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
    setcookie("display_name", $data['display_name'], time() + (60 * 60 * 24 * 30), "/");

    if (administrator()) {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/admin';
        return header('Location: ' . $home_url);
    }

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/app';
    header('location: ' . $home_url);
}

function logout()
{
    if (isset($_SESSION['id'])) {

        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }
        session_destroy();
    }

    setcookie('id', '', time() - 3600, "/");
    setcookie('display_name', '', time() - 3600, "/");

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('Location: ' . $home_url);
}
