<?php

session_start();

@require_once __DIR__ . '/../../helpers/session.php';

if (!isset($_SESSION['id'])) {
  if (isset($_COOKIE['id']) && isset($_COOKIE['display_name'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['name'] = $_COOKIE['display_name'];
  } else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('Location: ' . $home_url);
  }
}

if (administrator()) {
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/admin';
  header('Location: ' . $home_url);
}
