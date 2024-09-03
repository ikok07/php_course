<?php

use Core\App;
use Core\Session;
use Core\Database;
use Core\Container;

use Core\ValidationException;

const BASE_PATH = __DIR__ . "/../";

include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "Core/functions.php";


App::setContainer(new Container());
App::bind("Core\Database", function () {
    $config = include base_path("config.php");
    return new Database($config);
});

session_start();

$router = new Core\Router();

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$routes = include base_path("routes.php");

try {
    $router->route($uri, $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"]);
} catch (ValidationException $exception) {
    Session::flash("errors", $exception->errors);
    Session::flash("old", $exception->attributes);

    redirect($router->previousUrl());
}

Session::unflash();
