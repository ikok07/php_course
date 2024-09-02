<?php

use Core\App;
use Core\Database;
use Core\Container;

const BASE_PATH = __DIR__ . "/../";

include BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    include base_path( "$class.php");
});

App::setContainer(new Container());
App::bind("Core\Database", function () {
    $config = include base_path("config.php");
    return new Database($config);
});

session_start();

$router = new Core\Router();

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$routes = include base_path("routes.php");

$router->route($uri, $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"]);
