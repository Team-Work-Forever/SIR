<?php

require_once __DIR__ . '../../../infra/repositories/recipes-repository.php';

$recipe = getRecipeById($_GET['id']);
$creator_id = $recipe['creator_id'];

if ($_SESSION['id'] != $creator_id) {
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/app';
  header('Location: ' . $home_url);
}
