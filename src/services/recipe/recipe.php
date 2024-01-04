<?php

require_once __DIR__ . '/../../infra/repositories/recipes-repository.php';
require_once __DIR__ . '/../../infra/repositories/recipes-steps-repository.php';
require_once __DIR__ . '/../../infra/repositories/recipes-ingredients-repository.php';
require_once __DIR__ . '/../../infra/repositories/recipes-tips-repository.php';
require_once __DIR__ . '/../../infra/repositories/categories-repository.php';
require_once __DIR__ . '/../../infra/repositories/images-repository.php';
require_once __DIR__ . '/../../helpers/validations/validate-recipe.php';
require_once __DIR__ . '/../../helpers/validations/validate-step.php';
require_once __DIR__ . '/../../helpers/validations/validate-ingredient.php';
require_once __DIR__ . '/../../helpers/validations/validate-tip.php';
require_once __DIR__ . '/../../helpers/validations/validate-tip-image.php';
@require_once __DIR__ . '../../../helpers/session.php';

if (isset($_POST['recipe'])) {
    if ($_POST['recipe'] == 'createRecipe') {
        createNewRecipe($_POST);
    }

    if ($_POST['recipe'] == 'updateRecipe') {
        update($_POST);
    }

    if ($_POST['recipe'] == 'removeRecipe') {
        remove($_POST);
    }

    if ($_POST['recipe'] == 'changeStatusRecipe') {
        reverse($_POST);
    }
}

if (isset($_POST['favorite'])) {
    if ($_POST['favorite'] == 'changeFavoriteHome') {
        changeFavoriteHome($_POST);
    }

    if ($_POST['favorite'] == 'changeFavoriteMyRecipes') {
        changeFavoriteMyRecipes($_POST);
    }

    if ($_POST['favorite'] == 'changeFavoriteProfile') {
        changeFavoriteProfile($_POST);
    }

    if ($_POST['favorite'] == 'changeFavoriteDetails') {
        changeFavoriteDetails($_POST);
    }
}

if (isset($_POST['step'])) {
    if ($_POST['step'] == 'addStep') {
        createStep($_POST);
    }

    if ($_POST['step'] == 'removeStep') {
        deleteStep($_POST);
    }

    if ($_POST['step'] == 'editStep') {
        updateStep($_POST);
    }
}

if (isset($_POST['ingredient'])) {
    if ($_POST['ingredient'] == 'addIngredient') {
        createIngredient($_POST);
    }

    if ($_POST['ingredient'] == 'removeIngredient') {
        deleteIngredient($_POST);
    }
}

if (isset($_POST['state'])) {
    if ($_POST['state'] == 'changeState') {
        updateState($_POST);
    }
}

if (isset($_POST['tip'])) {
    if ($_POST['tip'] == 'addTip') {
        createTip($_POST);
    }

    if ($_POST['tip'] == 'addTipImage') {
        createTipImage($_POST);
    }
}

function createNewRecipe($req)
{
    $image = $_FILES["cover"];
    unset($_FILES["cover"]);
    $_FILES["cover"] = array();

    $data = isRecipeValid($req, $image, true);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        // $params = '?' . http_build_query($req);
        // TODO: MODAL
        header('location: ' . $req['pathError']);

        return;
    }

    if ($image['type'] == "") {
        $recipe = createRecipe($data);

        header('location: ' . $req['path'] . $recipe);

        return;
    }

    $recipe = createRecipe($data);

    $image['content'] = file_get_contents($image["tmp_name"]);

    $imageInserted = createImage($image);

    updateRecipeImage($recipe, $imageInserted);

    header('location: ' . $req['path'] . $recipe);
}

function update($req)
{
    $image = $_FILES["cover"];
    unset($_FILES["cover"]);
    $_FILES["cover"] = array();

    $data = isRecipeValid($req, $image, false);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        header('location: ' . $req['pathError']);

        return;
    }

    if ($image['type'] != "") {

        $image['content'] = file_get_contents($image["tmp_name"]);

        $imageInserted = createImage($image);

        updateRecipeImage($req['recipe_id'], $imageInserted);
    }

    updateRecipe($data);

    header('location: ' . $req['path']);
}

function remove($req)
{
    deleteRecipe($req['recipe_id']);

    if (administrator()) {
        header('location: ' . $req['path']);
        return;
    }

    header('location: /app/myrecipes');
}

function reverse($req)
{
    changeRecipeStatus($req);

    header('location: ' . $req['path']);
}

function changeFavorite($req)
{
    changeFavoriteRecipe($req['id']);
}

function changeFavoriteHome($req)
{
    changeFavorite($req);

    header('location: /app');
}

function changeFavoriteMyRecipes($req)
{
    changeFavorite($req);

    header('location: /app/myrecipes');
}

function changeFavoriteProfile($req)
{
    changeFavorite($req);

    header('location: /app/profile?id=' . $req['creator_id']);
}

function changeFavoriteDetails($req)
{
    changeFavorite($req);

    header('location: /app/detailsrecipe?id=' . $req['id']);
}

function createStep($req)
{
    $data = isStepValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors_step'] = $data['invalid'];

        $params = '?' . http_build_query($req);

        //TODO: ERROS EM MODALS
        // header('location: /app/updaterecipe?id=' . $req['id'] . $params);
    } else {
        addStepToRecipe($data);
        updateRecipeDate($data['recipe_id']);


        header('location: /app/updaterecipe?id=' . $req['recipe_id']);
    }
}

function deleteStep($req)
{
    deleteStepRecipe($req);
    updateRecipeDate($req['recipe_id']);

    if (administrator()) {
        header('location: /admin/users/userprofile/recipe?id=' . $req['recipe_id']);
        return;
    }

    header('location: /app/updaterecipe?id=' . $req['recipe_id']);
}

function updateStep($req)
{
    $data = isStepValid($req);

    if (isset($data['invalid'])) {


        $_SESSION['errors_step'] = $data['invalid'];

        //TODO: ERROS EM MODALS
        header('location: /app/updaterecipe?id=' . $req['recipe_id']);
    } else {
        updateStepRecipe($data);
        updateRecipeDate($data['recipe_id']);

        header('location: /app/updaterecipe?id=' . $req['recipe_id']);
    }
}

function createIngredient($req)
{
    $ingredients = json_decode($req['ingredients'], true);

    foreach ($ingredients as $ingredient) {
        $temp['recipe_id'] = $req['recipe_id'];
        $temp['ingredient_id'] = $ingredient[0];
        $temp['quantity'] = $ingredient[1];
        $temp['unit'] = $ingredient[2];

        $data = isIngredientValid($temp);

        unset($temp);

        if (isset($data['invalid'])) {

            $_SESSION['errors_ingredient'] = $data['invalid'];

            $params = '?' . http_build_query($req);
            //TODO: ERROS EM MODALS
            // header('location: /app/updaterecipe?id=' . $req['id'] . $params);
            continue;
        } else {
            if (getIngredientsRecipe($data)) {
                updateIngredientRecipe($data);
                updateRecipeDate($data['recipe_id']);
            } else {
                addIngredientRecipe($data);
                updateRecipeDate($data['recipe_id']);
            }
        }
    }
    header('location: /app/updaterecipe?id=' . $req['recipe_id']);
}

function deleteIngredient($req)
{
    deleteIngredientRecipe($req);
    updateRecipeDate($req['recipe_id']);

    if (administrator()) {
        header('location: /admin/users/userprofile/recipe?id=' . $req['recipe_id']);
        return;
    }

    header('location: /app/updaterecipe?id=' . $req['recipe_id']);
}

function updateState($req)
{
    changeStateRecipe($req['recipe_id']);

    header('location: /app/detailsrecipe?id=' . $req['recipe_id']);
}

function createTip($req)
{
    $data = isTipValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors_tip'] = $data['invalid'];

        header('location: /app/detailsrecipe?id=' . $req['recipe_id']);
    } else {
        addTipRecipe($data);

        header('location: /app/detailsrecipe?id=' . $req['recipe_id']);
    }
}

function createTipImage($req)
{
    $image = $_FILES["image"];
    unset($_FILES["image"]);

    $data = isTipImageValid($image);

    if (isset($data['invalid'])) {

        $_SESSION['errors_tip'] = $data['invalid'];

        header('location: /app/detailsrecipe?id=' . $req['recipe_id']);
    } else {
        $image['content'] = file_get_contents($image["tmp_name"]);

        $imageInserted = createImage($image);

        addTipImageRecipe($req['recipe_id'], $imageInserted, $image['name']);

        header('location: /app/detailsrecipe?id=' . $req['recipe_id']);
    }
}
