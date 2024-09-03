<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $db = App::resolve(Database::class);
        $user = $db->query("select * from users where email = ?", [$email])->find();

        if ($user && password_verify($password, $user["password"])) {
            $this->login($user);
            return true;
        }

        return false;
    }

    private function login($user)
    {
        $_SESSION["user"] = [
            "id" => $user["id"],
            "email" => $user["email"],
        ];

        session_regenerate_id(true);
    }

    private function logout()
    {
        Session::destroy();
    }
}