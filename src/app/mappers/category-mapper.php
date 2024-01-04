<?php

require_once __DIR__ . '../../models/category-model.php';

function toCategoryModel($category)
{
    return new CategoryModel($category['id'], $category['name'],);;
}

function toCategoryModelList($categories)
{
    $list = [];

    foreach ($categories as $category) {
        $list[] = new CategoryModel($category['id'], $category['name'],);
    }

    return $list;
}
