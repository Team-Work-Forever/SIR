<?php

require_once __DIR__ . '/../../infra/repositories/genders-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-variable.php';


if (isset($_POST['gender'])) {
    if ($_POST['gender'] == 'createGender') {
        createNewGender($_POST);
    }

    if ($_POST['gender'] == 'updateGender') {
        update($_POST);
    }

    if ($_POST['gender'] == 'removeGender') {
        remove($_POST);
    }
}

function createNewGender($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX
        // $params = '?' . http_build_query($req);
        // header('location: /app/createrecipe' . $params);
        header('location: /admin/variables/creategender');

        return;
    }

    createGender($data);

    header('location: /admin/variables');
}

function update($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX
        header('location: /app/updategender?id=' . $req['gender_id']);

        return;
    }

    updateGender($data);

    header('location: /app/updategender?id=' . $req['gender_id']);
}

function remove($req)
{
    deleteGender($req['gender_id']);

    header('location: /admin/variables');
}
