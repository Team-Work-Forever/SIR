<?php

$router->get('', 'IndexController@index');
$router->get('app', 'HomeController@index');
$router->get('app/myrecipes', 'MyRecipesController@index');
$router->get('app/createrecipe', 'CreateRecipeController@index');
$router->get('app/updaterecipe', 'UpdateRecipeController@index');
$router->get('app/detailsrecipe', 'DetailsRecipeController@index');
$router->get('app/profile', 'ProfileController@index');
$router->get('admin', 'AdminHomeController@index');
$router->get('admin/users', 'AdminUsersController@index');
$router->get('admin/users/createuser', 'AdminCreateUserController@index');
$router->get('admin/users/updateuser', 'AdminUpdateUserController@index');
$router->get('admin/users/userprofile', 'AdminUserProfileController@index');
$router->get('admin/users/userprofile/recipe', 'AdminUserRecipeController@index');
$router->get('admin/recipes', 'AdminRecipesController@index');
$router->get('admin/recipes/createrecipe', 'AdminCreateRecipeController@index');
$router->get('admin/recipes/updaterecipe', 'AdminUpdateRecipeController@index');
$router->get('admin/variables', 'AdminVariablesController@index');
$router->get('admin/variables/createcategory', 'AdminCreateCategoryController@index');
$router->get('admin/variables/updatecategory', 'AdminUpdateCategoryController@index');
$router->get('admin/variables/creategender', 'AdminCreateGenderController@index');
$router->get('admin/variables/updategender', 'AdminUpdateGenderController@index');
$router->get('admin/variables/createingredient', 'AdminCreateIngredientController@index');
$router->get('admin/variables/updateingredient', 'AdminUpdateIngredientController@index');
$router->get('admin/variables/createunit', 'AdminCreateUnitController@index');
$router->get('admin/variables/updateunit', 'AdminUpdateUnitController@index');
