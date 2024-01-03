<?php

namespace route\routes;

class Route
{

    public function __construct(
        private string $uri, 
        private string $request, 
        private string $controller
    ) {}

    private function currentUri()
    {
        return $_SERVER['REQUEST_URI'] !== '/' ? rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : '/';
    }

    private function currentRequest()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function match()
    {
        
    }

}