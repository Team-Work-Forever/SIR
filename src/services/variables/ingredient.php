<?php

require_once __DIR__ . '/../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-ingredient-unit.php';


if (isset($_POST['ingredient'])) {
    if ($_POST['ingredient'] == 'createIngredient') {
        create($_POST);
    }

    if ($_POST['ingredient'] == 'updateIngredient') {
        update($_POST);
    }

    if ($_POST['ingredient'] == 'removeIngredient') {
        remove($_POST);
    }
}

function create($req)
{
    $data = isIngredientUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER
        $params = '?' . http_build_query($req);

        return header('location: /admin/variables/createingredient' . $params);
    }

    createNewIngredient($data);

    header('location: ' . $req['path']);
}

function update($req)
{
    $data = isIngredientUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER

        return header('location: /admin/variables/updateingredient?id=' . $req['ingredient_id']);
    }

    updateIngredient($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteIngredientById($req['ingredient_id']);

    header('location: /admin/variables');
}
