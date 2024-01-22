<?php

namespace app\controllers;

use route\Route;

class Controller 
{
    public function call(Route $route)
    {
        $controller = $route->controller;
    
        if (!str_contains($controller, ':')) {
            throw new \Exception("Semi colon need to controller {$controller} in route");
        }

        [$controller, $action] = explode(':', $controller);

        $controllerInstance = "app\\controllers\\" . $controller;
        
        if (!class_exists($controllerInstance)) {
            throw new \Exception("Controller {$controller} does not exists!");
        }

        $controller = new $controllerInstance;

        if (!method_exists($controller, $action)) {
            throw new \Exception("Action {$action} does not exists!");
        }

        call_user_func_array([$controller, $action], []);
    }
}