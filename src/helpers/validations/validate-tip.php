<?php

function isTipValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['description']) || strlen($req['description']) < 2 || strlen($req['description']) > 50) {
        $errors['description'] = 'The description field cannot be empty and must be between 2 and 50 characters.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
