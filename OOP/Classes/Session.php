<?php

namespace Classes;
class Session
{
    /**
     * @var mixed
     */
    private static $sessionStarted = false;

    private static function startSession()
    {
        if (!self::$sessionStarted) {
            session_start();
            self::$sessionStarted = true;
        }
    }

    public static function get($name)
    {
        self::startSession();

        if (array_key_exists($name, $_SESSION))
            return $_SESSION[$name];

        return null;
    }

    public static function has($name)
    {
        self::startSession();
        return array_key_exists($name, $_SESSION);
    }

    public static function set($name, $value)
    {
        self::startSession();
        return $_SESSION[$name] = $value;
    }

    public static function delete($name)
    {
        self::startSession();
        unset($_SESSION[$name]);
    }
}