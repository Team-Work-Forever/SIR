<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '../../../infra/repositories/categories-repository.php';
require_once __DIR__ . '../../mappers/category-mapper.php';

class AdminUpdateCategoryController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = toCategoryModel(getCategoryById($id));
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            $title = "Editar Categoria";
            $submit_action = "updateCategory";
            $variableName = "category";

            return view("secure/admin/variable", [
                'administrator' => true,
                'errors' =>  $errors,
                'variableName' => $variableName,
                'variable' => $category,
                'title' => $title,
                'action' => $submit_action,
            ]);
        } else {
            return header('location: /admin/variables');
        }
    }
}
