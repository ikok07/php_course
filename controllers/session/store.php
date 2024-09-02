<?php

$email = $_POST["email"];
$password = $_POST["password"];

if (!Core\Validator::email($email))
    $errors["email"] = "Invalid email address!";

if (!Core\Validator::string($password, 1, 120))
    $errors["password"] = "Invalid password!";

if (!empty($errors)) return view("session/create.view.php", ["errors" => $errors]);

$db = Core\App::resolve(Core\Database::class);

$user = $db->query("select * from users where email = ?", [$email])->find();

if ($user && password_verify($password, $user["password"])) {
    login($user);
    header("location: /");
}

return view("session/create.view.php", ["errors" => ["email" => "Invalid credentials!"]]);

