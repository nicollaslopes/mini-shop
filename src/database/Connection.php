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
                self::$connection = new PDO("mysql:host=172.18.0.2;dbname=app_development", "root", "password");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$connection;
    } 

}