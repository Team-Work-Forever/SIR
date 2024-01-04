<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/units-repository.php';
require_once __DIR__ . '../../../infra/repositories/ingredients-repository.php';
require_once __DIR__ . '../../mappers/ingredient-mapper.php';
require_once __DIR__ . '../../mappers/unit-mapper.php';

class AdminUpdateIngredientController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ingredient = toIngredientModel(getIngredientsById($id));
            $units = toUnitModelList(getAllUnits());
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Ingrediente";
            $submit_action = "updateIngredient";
            $variableName = "ingredient";

            return view("secure/admin/variable", [
                'administrator' => true,
                'errors' =>  $errors,
                'variableName' => $variableName,
                'variable' => $ingredient,
                'units' => $units,
                'title' => $title,
                'action' => $submit_action,
            ]);
        } else {
            return header('location: /admin/variables');
        }
    }
}
