<?php

ini_set('display_errors', 1);

include '../vendor/autoload.php';
include '../config/database.php';

session_start();

$route = getRouteFromURL();

function getRouteFromURL(): array
{
    $url = explode('?', $_SERVER['REQUEST_URI'])[0];

    $routes = include_once '../config/routes.php';

    if (!isset($routes[$url])) {
        echo "<h1>Página não encontrada</h1>";
        exit;
    }
    return $routes[$url];
}

function main(): void
{
    global $route;

    include '../vendor/autoload.php';

    $controller = $route['controller'];
    $method = $route['action'];

    (new $controller())->$method();

}

if ($route['api_rest'] === true) {

    $controller = $route['controller'];
    $method = strtolower($_SERVER['REQUEST_METHOD']) . 'Action';

    (new $controller())->$method();

    exit;
}
include '../views/initial.phtml';
