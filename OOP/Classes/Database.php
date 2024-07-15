<?php

namespace Classes;


class Database
{
    const HOST = "127.0.0.1";
    const USERNAME = "root";
    const PASSWORD = "root";
    const DATABASE_NAME = "test";

    private static ?\PDO $connection = null;

    private static function makeConnection(): void
    {
        if (self::$connection instanceof \PDO) {
            return;
        }

        try {
            self::$connection = new \PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE_NAME, self::USERNAME, self::PASSWORD);
            // set the PDO error mode to exception
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
            return;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return;
        }
    }

    public static function insert(string $sql, array $parameters = []): string
    {
        self::makeConnection();
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($parameters);
        return self::$connection->lastInsertId();
    }

    public static function getOneRow(string $sql, array $parameters = [])
    {
        self::makeConnection();
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getMultiRows(string $sql, array $parameters = [])
    {
        self::makeConnection();

        $stmt = self::$connection->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}