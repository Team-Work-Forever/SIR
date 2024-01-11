<?php

function isForgetRequestValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (!filter_var($req['password']) || strlen($req['confirm_password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (empty($req['confirm_password']) || strlen($req['confirm_password']) < 6) {
        $errors['confirm_password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if ($req['password'] != $req['confirm_password']) {
        $errors['not_equal'] = 'The Password and Confirm Password must be equals.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

function isLoginValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field cannot be empty and must have the email format, for example: nome@example.com.';
    }

    if (empty($req['password']) || strlen($req['password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

function isEmailValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field cannot be empty and must have the email format, for example: nome@example.com.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

function isPasswordValid($req)
{
    if (!isset($_SESSION['id'])) {
        $user = getByEmailIfDeleted($req['email']);

        if (!$user || $user['deleted_at'] != null) {
            $errors['email'] = 'Wrong email or password.';
        } else {
            if (!password_verify($req['password'], $user['password'])) {
                $errors['password'] = 'Wrong email or password.';
            }
        }

        if (isset($errors)) {
            return ['invalid' => $errors];
        }

        return $user;
    }
}
