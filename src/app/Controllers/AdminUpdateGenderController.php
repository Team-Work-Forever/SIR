<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';
require_once __DIR__ . '../../mappers/gender-mapper.php';

class AdminUpdateGenderController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $gender = toGenderModel(getGenderById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Género";
            $submit_action = "updateGender";
            $variableName = "gender";

            return view("secure/admin/variable", [
                'administrator' => true,
                'errors' =>  $errors,
                'variableName' => $variableName,
                'variable' => $gender,
                'title' => $title,
                'action' => $submit_action,
            ]);
        } else {
            return header('location: /admin/variables');
        }
    }
}
