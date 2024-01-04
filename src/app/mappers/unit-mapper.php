<?php

require_once __DIR__ . '../../models/unit-model.php';

function toUnitModel($unit)
{
    return new UnitModel($unit['id'], $unit['name'], $unit['unit'],);
}

function toUnitModelList($units)
{
    $list = [];

    foreach ($units as $unit) {
        $list[] = new UnitModel($unit['id'], $unit['name'], $unit['unit'],);
    }

    return $list;
}
