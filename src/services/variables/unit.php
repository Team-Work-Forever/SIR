<?php

require_once __DIR__ . '/../../infra/repositories/units-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-unit.php';
@require_once __DIR__ . '../../../helpers/session.php';

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
        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER

        $params = '?' . http_build_query($req);
        return header('location: /admin/variables/createunit' . $params);
    }

    createUnit($data);

    header('location: ' . $req['path']);
}

function update($req)
{
    $data = isUnitValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER

        return header('location: /admin/variables/updateunit?id=' . $req['unit_id']);
    }

    updateUnit($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteUnitById($req['unit_id']);

    header('location: /admin/variables');
}
