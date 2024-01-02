<?php

function isIngredientValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['quantity'])) {
        $errors['quantity'] = 'The quantity is required.';
    }

    if (filter_var($req['quantity'], FILTER_VALIDATE_INT) === false || filter_var($req['quantity'], FILTER_VALIDATE_INT) <= 0) {
        $errors['quantity'] = 'The quantity must be a positive integer.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
