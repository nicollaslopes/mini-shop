<?php

namespace route;

use route\Route;
use app\controllers\Controller;
use app\utils\Redirect;
use app\utils\RouteOptions;
use app\utils\RouteWildcard;
use app\utils\Uri;
use Closure;

class Router 
{
    private array $routes = [];
    private array $routeOptions = [];
    private Route $route;

    public function add(string $uri, string $request, string $controller, array $wildcardAliases = [])
    {
        $this->route = new Route($request, $controller, $wildcardAliases);
        $this->route->addRouteUri(new Uri($uri));
        $this->route->addRouteWildcard(new RouteWildcard);
        $this->route->addRouteGroupOptions(new RouteOptions($this->routeOptions));
        $this->routes[] = $this->route;

        return $this;
    }

    public function middleware(array $middlewares)
    {
        $options = [];

        if (!empty($this->routeOptions)) {
            $options = array_merge($this->routeOptions, ['middlewares' => $middlewares]);
        } else {
            $options = ['middlewares' => $middlewares];
        }

        $this->route->addRouteGroupOptions(new RouteOptions($options));
    }

    public function group(array $routeOptions, Closure $callback)
    {   
        $this->routeOptions = $routeOptions;
        $callback->call($this);
        $this->routeOptions = [];
    }

    public function init()
    {
        foreach ($this->routes as $route) {
            if ($route->match()) {
                Redirect::register($route);
                return (new Controller)->call($route);
            }
        }

        return (new Controller)->call(new Route('GET', 'NotFoundController:index', []));
    }
}