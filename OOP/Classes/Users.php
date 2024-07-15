<?php

namespace Classes;
class Users
{
    const TEXT = "text";

    public function __construct()
    {
    }

    public function getAll()
    {
        $sql = "SELECT id, name, email, password FROM users ";
        return Database::getMultiRows($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT id, name, email, password FROM users WHERE id=:id";
        $parameters = [
            ":id" => $id,
        ];
        return Database::getOneRow($sql, $parameters);
    }
}