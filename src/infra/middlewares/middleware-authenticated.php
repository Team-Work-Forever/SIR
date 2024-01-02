<?php

require_once __DIR__ . '/../../helpers/session.php';

if (isset($_COOKIE['id']) && user($_COOKIE['id'])) {
    if (administrator()) {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/admin';
        header('Location: ' . $home_url);
        return;
    }
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/app';
    header('Location: ' . $home_url);
}
