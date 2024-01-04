<?php

require_once __DIR__ . '/../../infra/repositories/categories-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-variable.php';


if (isset($_POST['category'])) {
    if ($_POST['category'] == 'createCategory') {
        createNewCategory($_POST);
    }

    if ($_POST['category'] == 'updateCategory') {
        update($_POST);
    }

    if ($_POST['category'] == 'removeCategory') {
        remove($_POST);
    }
}

function createNewCategory($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX
        // $params = '?' . http_build_query($req);
        // header('location: /app/createrecipe' . $params);
        header('location: /admin/variables/createcategory');

        return;
    }

    createCategory($data);

    header('location: /admin/variables');
}

function update($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX
        header('location: /app/updatecategory?id=' . $req['category_id']);

        return;
    }

    updateCategory($data);

    header('location: /app/updatecategory?id=' . $req['category_id']);
}

function remove($req)
{
    deleteCategory($req['category_id']);

    header('location: /admin/variables');
}
