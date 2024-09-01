<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value) {
    return $_SERVER["REQUEST_URI"] === $value;
}

function authorize($condition, $status_code = Response::FORBIDDEN) {
    if (!$condition) abort($status_code);
}