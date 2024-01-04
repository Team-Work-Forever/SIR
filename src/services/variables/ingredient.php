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

        //TODO: FIX
        // $params = '?' . http_build_query($req);
        // header('location: /app/createrecipe' . $params);
        header('location: /admin/variables/createingredient');

        return;
    }

    createNewIngredient($data);

    header('location: /admin/variables');
}

function update($req)
{
    $data = isIngredientUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX
        header('location: /app/updateingredient?id=' . $req['ingredient_id']);

        return;
    }

    updateIngredient($data);

    header('location: /app/updateingredient?id=' . $req['ingredient_id']);
}

function remove($req)
{
    deleteIngredientById($req['ingredient_id']);

    header('location: /admin/variables');
}
