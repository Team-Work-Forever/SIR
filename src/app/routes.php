<?php

$router->get('', 'IndexController@index');
$router->get('app', 'HomeController@index');
$router->get('app/myrecipes', 'MyRecipesController@index');
$router->get('app/createrecipe', 'CreateRecipeController@index');
$router->get('app/updaterecipe', 'UpdateRecipeController@index');
$router->get('app/detailsrecipe', 'DetailsRecipeController@index');
$router->get('app/profile', 'ProfileController@index');
$router->get('admin', 'AdminHomeController@index');
