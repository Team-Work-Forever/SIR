<?php

require 'src/config/bootstrap.php';
require_once __DIR__ . '/src/infra/db/connection.php';

use Config\Request\Request;
use Config\Router\Router;

(new Router())->load('src/app/routes.php')
    ->direct(Request::uri(), Request::method());
