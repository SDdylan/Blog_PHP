<?php

namespace App\Service;


class Router
{
    public static array $routes = [
        '' => 'Front\HomeController',
       'contact' => 'Front\ContactController',
    ];

    public function run(): void
    {
        $routeUri = ltrim($_SERVER['REQUEST_URI'], '/');
        $routeName = self::$routes[$routeUri] ?? self::$routes[''];

        $controllerName = "App\Controller\\";
        $controllerName .= $routeName;

        $controller = new $controllerName();
        $controller();
    }
}