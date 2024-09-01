<?php

$config = include "config.php";
$db = new Database($config);

$note = $db->query("select * from notes where id = ?", [$_GET["id"]])->findOrFail();

$user_id = 1;

authorize($note["user_id"] === $user_id);

include "views/note.view.php";
