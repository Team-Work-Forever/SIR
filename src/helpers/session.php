<?php
session_start();
require_once __DIR__ . '/../infra/repositories/user-repository.php';

function isAuthenticated()
{
    return isset($_SESSION['id']);
}

function user()
{
    if (isAuthenticated()) {
        return getById($_SESSION['id']);
    } else {
        return false;
    }
}

function userId()
{
    return  $_SESSION['id'];
}

function administrator()
{
    $user = user();
    return $user['is_admin'] == 1 ? true : false;
}
