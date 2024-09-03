<?php

$db = Core\App::resolve(Core\Database::class);

$note = $db->query("select * from notes where id = ?", [$_GET["id"]])->findOrFail();
authorize($note["user_id"] === $_SESSION["user"]["id"]);

view("notes/edit.view.php", ["note" => $note]);
