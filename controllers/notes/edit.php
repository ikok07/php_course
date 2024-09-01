<?php

$db = Core\App::resolve(Core\Database::class);

$user_id = 1;

$note = $db->query("select * from notes where id = ?", [$_GET["id"]])->findOrFail();
authorize($note["user_id"] === $user_id);

view("notes/edit.view.php", ["note" => $note]);
