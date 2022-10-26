<?php

use Vita\Booking\Services\Router;

require_once './vendor/autoload.php';
require_once './routes.php';

$router = new Router;

$router->doRouting(
    path: $_SERVER['REQUEST_URI'],
    method: $_SERVER['REQUEST_METHOD'],
    params: $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET
);
