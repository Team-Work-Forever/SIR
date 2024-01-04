<?php

require_once __DIR__ . '../../models/gender-model.php';

function toGenderModel($gender)
{
    return new GenderModel($gender['id'], $gender['name'],);
}

function toGenderModelList($genders)
{
    $list = [];

    foreach ($genders as $gender) {
        $list[] = new GenderModel($gender['id'], $gender['name'],);
    }

    return $list;
}
