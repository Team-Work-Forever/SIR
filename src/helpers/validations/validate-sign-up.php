<?php

function isSignUpValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['first_name']) || strlen($req['first_name']) < 2 || strlen($req['first_name']) > 25) {
        $errors['first_name'] = 'The first name field cannot be empty and must be between 2 and 25 characters.';
    }

    if (empty($req['last_name']) || strlen($req['last_name']) < 2 || strlen($req['last_name']) > 25) {
        $errors['last_name'] = 'The second name field cannot be empty and must be between 2 and 25 characters.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field must not be empty and must have an email format, such as: name@example.com.';
    }

    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email already registered in our system. If you cannot remember your password, please contact us.';
        return ['invalid' => $errors];
    }

    if (empty($req['password']) && strlen($req['password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (empty($req['gender'])) {
        $errors['gender'] = 'The Gender field cannot be empty.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
