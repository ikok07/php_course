<?php

$db = Core\App::resolve(Core\Database::class);

$user_id = 1;

$note = $db->query("select * from notes where id = ?", [$_POST["id"]])->findOrFail();
authorize($note["user_id"] === $user_id);

$errors = [];

if (!Core\Validator::string($_POST["body"], 1, 1000))
    $errors["body"] = "The maximum body length is 1000 characters!";

if (!empty($errors)) view("notes/edit.view.php", ["errors" => $errors, "note" => $note]);
$db->query("update notes set body = :body where id = :id", [
    "body" => $_POST["body"],
    "id" => $_POST["id"]
]);

header("location: /notes");
