<?php

namespace app\controllers;

use app\utils\Middleware;
use route\Route;

class Controller 
{
    private function controllerPath($route, $controller)
    {
        return ($route->getRouteOptions() && $route->getRouteOptions()->optionExist('controller')) ?
            "app\\controllers\\" . $route->getRouteOptions()->execute('controller') . '\\' . $controller : "app\\controllers\\" . $controller;
    }

    public function call(Route $route)
    {
        $controller = $route->controller;
    
        if (!str_contains($controller, ':')) {
            throw new \Exception("Colon need to controller {$controller} in route");
        }

        [$controller, $action] = explode(':', $controller);

        $controllerInstance = $this->controllerPath($route, $controller);

        if (!class_exists($controllerInstance)) {
            throw new \Exception("Controller {$controller} does not exists!");
        }

        $controller = new $controllerInstance;

        if (!method_exists($controller, $action)) {
            throw new \Exception("Action {$action} does not exists!");
        }

        if ($route->getRouteOptions()?->optionExist('middlewares')) {
            (new Middleware($route->getRouteOptions()->execute('middlewares')))->execute();
        }

        $params = ($route->getRouteWildCard()?->getParams() != null) ? $route->getRouteWildCard()?->getParams() : [];

        call_user_func_array([$controller, $action], $params);
    }
}