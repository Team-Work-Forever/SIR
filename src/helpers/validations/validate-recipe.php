<?php

function isRecipeValid($req, $image)
{
    if (!isset($image)) {
        $errors['cover'] = 'Cover is missing or invalid.';
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

    if (empty($req['name']) || strlen($req['name']) < 2 || strlen($req['name']) > 20) {
        $errors['name'] = 'The name field cannot be empty and must be between 2 and 20 characters.';
    }

    if (empty($req['description']) || strlen($req['description']) < 2 || strlen($req['description']) > 80) {
        $errors['description'] = 'The description field cannot be empty and must be between 2 and 80 characters.';
    }

    if (empty($req['servings'])) {
        $errors['servings'] = 'The portions quantity field is required.';
    }

    if (filter_var($req['servings'], FILTER_VALIDATE_INT) === false || filter_var($req['servings'], FILTER_VALIDATE_INT) <= 0) {
        $errors['servings'] = 'The portions quantity must be a positive integer.';
    }

    if (empty($req['execution_time'])) {
        $errors['execution_time'] = 'The time field is required.';
    }

    if (filter_var($req['execution_time'], FILTER_VALIDATE_INT) === false || filter_var($req['execution_time'], FILTER_VALIDATE_INT) <= 0) {
        $errors['execution_time'] = 'The time must be a positive integer.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
