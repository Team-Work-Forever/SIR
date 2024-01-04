<?php

function isUserValid($req, $image)
{

    if (!isset($image)) {
        $errors['avatar'] = 'Avatar URL is missing or invalid.';
    } else {
        $imagePath = $image["tmp_name"];

        $allowedTypes = array('', 'image/png', 'image/jpeg', 'image/gif');
        $detectedType = $image['type'];

        $maxFileSize = 5 * 1024 * 1024;

        if (!in_array($detectedType, $allowedTypes)) {
            $errors['image_type'] = 'Image type not supported.';
        }

        if (filesize($imagePath) > $maxFileSize) {
            $errors['image_size'] = 'Image size exceeds 5 MB.';
        }
    }

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

    $data = getById($req['user_id']);

    if ($req['email'] != $data['email']) {
        if (getByEmail($req['email'])) {
            $errors['email'] = 'Email already registered in our system.';
            return ['invalid' => $errors];
        }
    }

    if (!empty($req['password']) && strlen($req['password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}

function isNewUserValid($req, $image)
{

    if (empty($req['gender'])) {
        $errors['gender'] = 'The Gender field cannot be empty.';
    }

    $req = isUserValid($req, $image);

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
