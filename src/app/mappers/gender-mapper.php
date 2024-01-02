<?php

require_once __DIR__ . '../../models/gender-model.php';

function toGenderModel($genders)
{
    $list = [];

    foreach ($genders as $gender) {
        $list[] = new GenderModel($gender['id'], $gender['name'],);
    }

    return $list;
}
