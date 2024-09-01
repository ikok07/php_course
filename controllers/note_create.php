<?php

$config = include "config.php";
$db = new Database($config);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (!Validator::string($_POST["body"], 1, 1000))
        $errors["body"] = "The maximum body length is 1000 characters!";

    if (empty($errors))
        $db->query("INSERT INTO notes(body, user_id) VALUES(?, ?)", [$_POST["body"], 1]);
}

include "views/note_create.view.php";