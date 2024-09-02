<?php

use Core\App;
use Core\Database;

include base_path("controllers/button.php");

$db = App::resolve(Database::class);

$note = $db->query("select * from notes where id = ?", [$_GET["id"]])->findOrFail();

authorize($note["user_id"] === $_SESSION["user"]["id"]);

view("notes/show.view.php", ["note" => $note]);
