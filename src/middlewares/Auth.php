<?php

namespace app\middlewares;

use app\interfaces\MiddlewareInterface;
use app\utils\Auth as UtilsAuth;
use app\utils\Redirect;

class Auth implements MiddlewareInterface
{
    public function execute()
    {
        if(!UtilsAuth::isAuth()) {
            return Redirect::to('/');
        }
    }
}