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

function login($user)
{
    $_SESSION["user"] = [
        "id" => $user["id"],
        "email" => $user["email"],
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie("PHPSESSID", "", time() - 3600, $params["domain"], $params["secure"], $params["httponly"]);
}