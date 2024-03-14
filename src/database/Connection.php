<?php

namespace app\database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $connection = null; 

    public static function connect()
    {
        if (!self::$connection) {
            try {
                self::$connection = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$connection;
    } 

}