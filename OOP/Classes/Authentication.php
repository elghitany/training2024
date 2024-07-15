<?php

namespace Classes;
class Authentication
{

    public function __construct()
    {
        
    }

    public function login($email, $password)
    {
        $sql = "SELECT id, name, email, password FROM users WHERE email=:email LIMIT 1";
        $parameters = [
            ":email" => $email,
        ];

       $user = Database::getOneRow($sql, $parameters);
        if(password_verify($password, $user['password'])){
            Session::set("userId", $user['id']);
            return true;
        }
        return false;
    }

    public function signup($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $parameters = [
            ":name" => $name,
            ":email" => $email,
            ":password" => $this->bcrypt($password),
        ];
        $userId = Database::insert($sql, $parameters);
        return $userId;
    }

    public static function isLoggedIn(): bool
    {
        return Session::has("userId");
    }

    public function logout()
    {
        Session::delete("userId");

    }

    private function bcrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}