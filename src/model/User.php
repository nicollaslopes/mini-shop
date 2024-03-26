<?php

namespace app\model;

class User extends Model
{
    public static string $table = 'users';
    public readonly int $id;
    public readonly string $first_name;
    public readonly string $last_name;
    public readonly string $email;
    public readonly string $password;
    public readonly string $created_at;
    public readonly string $updated_at;
}