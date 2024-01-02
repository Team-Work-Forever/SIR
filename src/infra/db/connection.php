<?php

require_once __DIR__ . '../../db/seeder.php';


if (isset($GLOBALS['pdo']) && $GLOBALS['pdo'] instanceof PDO) {
    return;
}

try {
    $DATABASE_HOST = 'localhost';
    $DATABASE_PORT = '5432';
    $DATABASE_USER = 'sa';
    $DATABASE_PASS = 'password';
    $DATABASE_NAME = 'mestresdaculinaria';
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';port=' . $DATABASE_PORT . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $GLOBALS['pdo'] = $pdo;
    seed();
} catch (PDOException $e) {
    echo "Ups! Cannot connect to db 😭";
    echo $e->getMessage();
    exit();
}
