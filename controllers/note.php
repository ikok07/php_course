<?php

$config = include "config.php";
$db = new Database($config);

$note = $db->query("select * from notes where id = ?", [$_GET["id"]])->fetch();

include "views/note.view.php";
