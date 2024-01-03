<?php

namespace route\routes;

class Router {

    private array $routes = [];

    public function add(string $uri, string $request, string $controller)
    {
        $this->routes[] = new Route($uri, $request, $controller);
    }

    public function init()
    {

    }
}