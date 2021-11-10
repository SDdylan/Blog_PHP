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
        //On récupère tout ce qui est à droite de l'URI en supprimant le 1er "/"
        $routeUri = ltrim($_SERVER['REQUEST_URI'], '/');
        //$routeName retourne son premier opérande s'il existe et n'est pas NULL; sinon, il retourne son deuxième opérande.
        $routeName = self::$routes[$routeUri] ?? self::$routes[''];

        //On factorise le chemin complet dans le $controllerName
        $controllerName = "App\Controller\\";
        $controllerName .= $routeName;

        $controller = new $controllerName();
        $controller();
    }
}

/*
//Exemple de routing via Twig

$loader = new Twig_Loader_Filesystem(__DIR__ . '\templates');
$twig = new Twig_Environment($loader, [
'cache' => false,
]);

echo $twig->render('home.twig');

*/        