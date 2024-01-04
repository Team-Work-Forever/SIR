<?php

function isIngredientUnitValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 2 || strlen($req['name']) > 25) {
        $errors['name'] = 'The name field cannot be empty and must be between 2 and 25 characters.';
    }

    if (filter_var($req['price'], FILTER_VALIDATE_INT) === false || filter_var($req['price'], FILTER_VALIDATE_INT) <= 0) {
        $errors['price'] = 'The price must be a positive number.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
