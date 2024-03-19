<?php

namespace app\utils;

use route\Route;

class Redirect
{
    public static function to(string $to)
    {
        return header("Location: $to");
    }

    public static function back()
    {
        if (isset($_SESSION['redirect'])) {
            return self::to($_SESSION['redirect']['previous']);
        }
    }

    private static function registerFirstRedirect(Route $route)
    {
        if (!isset($_SESSION['redirect'])) {
            $_SESSION['redirect'] = [
              'current' => $route->uri,
              'previous' => ''
            ];
          }
    }

    private static function registerRedirect(Route $route)
    {
        $_SESSION['redirect'] = [
            'current' => $route->uri,
            'previous' => $_SESSION['redirect']['current']
        ];
    }

    public static function register(Route $route)
    {
        $uri = $_SERVER['REQUEST_URI'] !== '/' ? rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : '/';

        if (!isset($_SESSION['redirect'])) {
            self::registerFirstRedirect($route);
        } else {
            self::registerRedirect($route);
                
        }
    }
}