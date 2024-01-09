<?php

require_once __DIR__ . '/../../infra/repositories/categories-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-variable.php';
@require_once __DIR__ . '../../../helpers/session.php';

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

        $_SESSION['errors_category'] = $data['invalid'];
        // TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER
        $params = '?' . http_build_query($req);

        return header('location: /admin/variables/createcategory' . $params);
    }

    createCategory($data);

    header('location: ' . $req['path']);
}

function update($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors_category'] = $data['invalid'];
        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER

        return header('location: /admin/variables/updatecategory?id=' . $req['category_id']);
    }

    updateCategory($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteCategory($req['category_id']);

    header('location: /admin/variables');
}
