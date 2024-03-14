<?php

namespace app\model;

use app\database\Transaction;
use PDO;
use PDOException;

abstract class Model
{
    protected static string $table;

    public static function all(string $fields = '*')
    {
        try {
            Transaction::open();

            $conn = Transaction::getConnection();

            $tableName = static::$table;

            $query = $conn->prepare("SELECT {$fields} FROM {$tableName}");
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, static::class);

        } catch (PDOException $e) {
            Transaction::rollback();
        }


        Transaction::close();
    }

    public static function where(string $field, string $value, string $fields = '*')
    {
        try {
            Transaction::open();

            $conn = Transaction::getConnection();

            $tableName = static::$table;

            $query = $conn->prepare("SELECT {$fields} FROM {$tableName} WHERE {$field} = :{$field}");
            $query->execute([$field => $value]);

            return $query->fetchObject(static::class);

        } catch (PDOException $e) {
            Transaction::rollback();
        }


        Transaction::close();
    }
}