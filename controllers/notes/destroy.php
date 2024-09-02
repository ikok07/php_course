<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$note = $db->query("select * from notes where id = ?", [$_POST["id"]])->findOrFail();
authorize($note["user_id"] === $_SESSION["user"]["id"]);
$db->query("delete from notes where id = ?", [$_POST["id"]]);
header("location: /notes");