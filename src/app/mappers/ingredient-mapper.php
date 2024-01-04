<?php

require_once __DIR__ . '../../../infra/repositories/units-repository.php';
require_once __DIR__ . '../../mappers/unit-mapper.php';
require_once __DIR__ . '../../models/ingredient-model.php';

function toIngredientModel($ingredients)
{
    $list = [];
    foreach ($ingredients as $ingredient) {
        $list[] = new IngredientModel($ingredient['id'], $ingredient['name'], $ingredient['price'], toUnitModel(getUnitById($ingredient['unit'])),);
    }

    return $list;
}
