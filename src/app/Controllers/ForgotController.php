<?php

namespace App\Controllers;

require_once __DIR__ . '/../../infra/repositories/token-repository.php';
require_once __DIR__ . '/../../infra/repositories/user-repository.php';

class ForgotController
{
    public function index()
    {
        $title = 'Esqueceu-se da palavra-chave';

        if (!isset($_GET['token'])) {
            return header('Location: /');
        }

        // Check if token exists
        $token = getTokenInfoByToken($_GET['token']);

        // Check type of token
        if ($token['type'] !== 'forgot') {
            return header('Location: /');
        }

        // Get user id
        $user = getById($token['user_id']);

        if (!$user) {
            return header('Location: /');
        }

        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        return view("public/forgot_password", [
            'title' => $title,
            'token' => $token['token'],
            'user_id' => $token['user_id'],
            'path' => $_SERVER['REQUEST_URI'],
            'errors' => $errors,
        ]);
    }
}
