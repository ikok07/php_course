<?php

use Core\App;
use Core\Database;

include base_path("controllers/button.php");

$db = App::resolve(Database::class);

$notes = $db->query("select * from notes where user_id = {$_SESSION["user"]["id"]}")->get();

view("notes/index.view.php", ["notes" => $notes]);
