<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/units-repository.php';
require_once __DIR__ . '../../mappers/unit-mapper.php';

class AdminUpdateUnitController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $unit = toUnitModel(getUnitById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Unidade";
            $submit_action = "updateUnit";
            $variableName = "unit";

            return view("secure/admin/variable", [
                'administrator' => true,
                'errors' =>  $errors,
                'variableName' => $variableName,
                'variable' => $unit,
                'title' => $title,
                'action' => $submit_action,
            ]);
        } else {
            return header('location: /admin/variables');
        }
    }
}
