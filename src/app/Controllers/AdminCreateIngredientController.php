<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/units-repository.php';
require_once __DIR__ . '../../mappers/unit-mapper.php';

class AdminCreateIngredientController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        $units = toUnitModelList(getAllUnits());
        $title = "Criar Ingrediente";
        $submit_action = "createIngredient";
        $variableName = "ingredient";

        return view("secure/admin/variable", [
            'administrator' => true,
            'errors' =>  $errors,
            'variableName' => $variableName,
            'units' => $units,
            'title' => $title,
            'action' => $submit_action,
            'units' => $units,
        ]);
    }
}
