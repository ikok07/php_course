<?php

$email = $_POST["email"];
$password = $_POST["password"];

$errors = [];

if (!Core\Validator::email($email))
    $errors["email"] = "Enter valid email address!";

if (!Core\Validator::string($password, 1, 120))
    $errors["password"] = "Password should be at least 7 characters and maximum 255 characters";

if (!empty($errors)) return view("registration/create.view.php", ["errors" => $errors]);

$db = Core\App::resolve(Core\Database::class);

$user = $db->query("select * from users where email = :email", ["email" => $email])->find();

if ($user) header("location: /");
else {
    $db->query("INSERT INTO users(name, email, password) VALUES(?, ?, ?)", [
        "John",
        $email,
        password_hash($password, PASSWORD_BCRYPT)
    ]);

    $_SESSION["user"] = [
        "email" => $email,
    ];
    header("location: /");
}
