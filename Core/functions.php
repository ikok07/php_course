<?php

use Core\Response;

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function abort($status_code = 404) {
    http_response_code($status_code);
    include base_path("views/$status_code.php");
    die();
}

function urlIs($value) {
    return $_SERVER["REQUEST_URI"] === $value;
}

function authorize($condition, $status_code = Response::FORBIDDEN) {
    if (!$condition) abort($status_code);
    return true;
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $arguments = []) {
    extract($arguments);

    return include base_path("views/" . $path);
}