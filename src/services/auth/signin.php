<?php
session_start();

require_once __DIR__ . '/../../config/Mail/MailSender.php';
require_once __DIR__ . '/../../infra/repositories/user-repository.php';
require_once __DIR__ . '/../../infra/repositories/token-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-login-password.php';
@require_once __DIR__ . '../../../helpers/session.php';

use Config\Mail\MailSender;
use Config\Tokens\Token;
use Config\Tokens\TokenType;

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'login') {
        login($_POST);
    }

    if ($_POST['user'] == 'logout') {
        logout();
    }

    if ($_POST['user'] == 'forgot') {
        forgotPassword($_POST);
    }

    if ($_POST['user'] == 'reset') {
        doResetPassword($_POST);
    }
}

function forgotPassword($req)
{
    $data = isEmailValid($req);
    $user = checkErrors($data, $req);

    if ($user) {
        doForgotPassword($data);
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

function checkErrors($data, $req, $modal_id = 'login')
{
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?email=' . $req['email'] . '&modal=login';
        header('location: /' . $params);
        return false;
    }

    return true;
}

function doResetPassword($data)
{
    $req = isForgetRequestValid($data);

    if (isset($req['invalid'])) {

        $_SESSION['errors'] = $req['invalid'];

        return header('location: ' . $data['path']);
    }

    // Fetch user
    $user = getById($data['user_id']);

    if (!$user) {
        return header('location: /');
    }

    // Alter password
    $userToChange['user_id'] = $user['id'];
    $userToChange['password'] = $data['password'];
    updateUserPassword($userToChange);

    deleteToken($data['token']);

    return header('location: /');
}

function doForgotPassword($data)
{
    // Generate token
    foreach ($data as $key => $value) {
        $data[$key] =  trim($data[$key]);
    }

    // Create the new token
    $token = new Token(TokenType::forgot);
    $data['token'] = $token->generate();
    $data['type'] = $token->getTokenType();

    try {
        // Save the token onto the database
        $user = getByEmail($data['email']);

        // If not found
        if ($user['email'] != $data['email']) {
            $_SESSION['errors'] = ['email' => 'Email não encontrado'];
            return header('location: /');
        }

        saveToken($data);

        // Send an email with the respective token for validation
        $sender = new MailSender();
        $sender->send($data['email'], 'Recuperação de senha', 'forgot', [
            'displayName' => $user['display_name'],
            'token' => $_SERVER['HTTP_HOST'] . '/forgot?token=' . $data['token']
        ]);
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
    }

    header('location: /');
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
