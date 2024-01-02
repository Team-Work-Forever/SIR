<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-authenticated.php';
require_once __DIR__ . '../../../infra/repositories/genders-repository.php';
require_once __DIR__ . '../../mappers/gender-mapper.php';

class IndexController
{
    public function index()
    {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        return view("public/index", ['genders' => toGenderModel(getAllGenders()), 'errors' => $errors]);
    }
}
