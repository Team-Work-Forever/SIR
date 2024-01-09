<?php

require_once __DIR__ . '/../../infra/repositories/genders-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-variable.php';
@require_once __DIR__ . '../../../helpers/session.php';

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

        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER
        $params = '?' . http_build_query($req);

        return header('location: /admin/variables/creategender' . $params);
    }

    createGender($data);

    header('location: ' . $req['path']);
}

function update($req)
{
    $data = isVariableValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];
        //TODO: FIX SESSION[ERRORS] IS NOT RECEIVED IN THE CONTROLLER

        return header('location: /admin/variables/updategender?id=' . $req['gender_id']);
    }

    updateGender($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteGender($req['gender_id']);

    header('location: /admin/variables');
}
