<?php

require_once __DIR__ . '/../../infra/repositories/units-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-unit.php';


if (isset($_POST['unit'])) {
    if ($_POST['unit'] == 'createUnit') {
        createNewUnit($_POST);
    }

    if ($_POST['unit'] == 'updateUnit') {
        update($_POST);
    }

    if ($_POST['unit'] == 'removeUnit') {
        remove($_POST);
    }
}

function createNewUnit($req)
{
    $data = isUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX PARAM
        // $params = '?' . http_build_query($req);
        // header('location: /app/createrecipe' . $params);
        header('location: /admin/variables/createunit');

        return;
    }

    createUnit($data);

    header('location: ' . $req['path']);
}

function update($req)
{
    $data = isUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        //TODO: FIX PARAM
        header('location: /app/updateunit?id=' . $req['unit_id']);

        return;
    }

    updateUnit($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteUnitById($req['unit_id']);

    header('location: /admin/variables');
}
