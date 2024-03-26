<?php

namespace app\utils;

use app\model\User;
use stdClass;

class Auth
{
    public static function loginAs(User $user)
    {
        if (!isset($_SESSION['auth'])) {
            $stdClass = new stdClass;
            $stdClass->id = $user->id;
            $stdClass->firstName = $user->first_name;
            $stdClass->lastName = $user->last_name;
            $stdClass->fullName = $user->first_name . ' ' . $user->last_name;

            $_SESSION['auth'] = $stdClass;
        }
    }

    public static function auth()
    {
        return $_SESSION['auth'] ?? null;
    }

    public static function logout()
    {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
        }
    }
}