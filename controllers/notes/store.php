<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST["body"], 1, 1000))
    $errors["body"] = "The maximum body length is 1000 characters!";

if (!empty($errors)) return view("notes/create.view.php", ["errors" => $errors]);

$db->query("INSERT INTO notes(body, user_id) VALUES(?, ?)", [$_POST["body"], 1]);
header("location: /notes");