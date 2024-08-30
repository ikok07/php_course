<?php

$config = include "config.php";
$db = new Database($config);

$notes = $db->query("select * from notes where user_id = 1")->fetchAll();

include "views/notes.view.php";
