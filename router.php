<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = include "routes.php";

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) include $routes[$uri];
    else abort();
}

function abort($status_code = 404) {
    http_response_code($status_code);
    include "views/$status_code.php";
}

routeToController($uri, $routes);
