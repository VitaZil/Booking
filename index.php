<?php
namespace Vita\Booking;
use Vita\Booking\Services\Router;

require_once (__DIR__ . './vendor/autoload.php');
require_once (__DIR__ . './routes.php');

$router = new Router;

$router->doRouting(
    path: $_SERVER['REQUEST_URI'],
    method: $_SERVER['REQUEST_METHOD'],
    params: $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET
);

