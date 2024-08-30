<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [
    "/" => "controllers/index.php",
    "/about" => "controllers/about.php",
    "/notes" => "controllers/notes.php",
    "/note" => "controllers/note.php",
    "/contact" => "controllers/contact.php",
];

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) include $routes[$uri];
    else abort();
}

function abort($status_code = 404) {
    http_response_code($status_code);
    include "views/$status_code.php";
}

routeToController($uri, $routes);
