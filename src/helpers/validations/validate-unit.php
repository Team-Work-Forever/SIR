<?php

function isUnitValid($req)
{

    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 2 || strlen($req['name']) > 25) {
        $errors['name'] = 'The name field cannot be empty and must be between 2 and 25 characters.';
    }

    if (empty($req['unit']) || strlen($req['unit']) > 10) {
        $errors['unit'] = 'The unit field cannot be empty and cannot have more than 10 characters.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
