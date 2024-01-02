<?php

function isTipImageValid($image)
{
    if (!isset($image)) {
        $errors['image'] = 'Cover is missing or invalid.';
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

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $image;
}
