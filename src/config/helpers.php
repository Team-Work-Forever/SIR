<?php

use Config\Twig\Twig;

function view($name, $data = [])
{
    extract($data);
    echo Twig::getTemplateRenderer()->render($name . ".twig", $data);
}

function redirect($path)
{
    header("Location: {$path}");
}
