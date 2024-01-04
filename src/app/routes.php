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
$router->get('admin/variables', 'AdminVariablesController@index');
