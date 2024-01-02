<?php

namespace App\Controllers;

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/middlewares/middleware-private.php';
require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../mappers/recipe-mapper.php';

class DetailsRecipeController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (getRecipeById($id)) {
                $recipe = toRecipeModel(getRecipeById($id));
                $admin = userId() == $recipe->getCreatorId();
                $errors_tip = $_SESSION['errors_tip'];
                unset($_SESSION['errors_tip']);
                return view("secure/user/details_recipe", ['recipe' => $recipe, 'admin' => $admin, 'profile' => $_SESSION['id'], 'errors_tip' =>  $errors_tip]);
            } else redirect($GLOBALS['pc']->pop());
        } else {
            return redirect($GLOBALS['pc']->pop());
        }
    }
}
