<?php

require_once __DIR__ . '../../models/recipe-tip-model.php';
require_once __DIR__ . '../../models/recipe-tip-image-model.php';
require_once __DIR__ . '../../../infra/repositories/images-repository.php';

function toRecipeTipModel($tips)
{
    $list = [];


    foreach ($tips as $tip) {
        if ($tip['image_id']) {
            $list[] = new RecipeTipImageModel(
                $tip['id'],
                toImageModel(getImageById($tip['image_id'])),
                $tip['recipe_id'],
                $tip['description'],
            );
        } else {
            $list[] = new RecipeTipModel(
                $tip['id'],
                $tip['recipe_id'],
                $tip['description'],
            );
        }
    }

    return $list;
}
