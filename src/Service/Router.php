<?php

namespace App\Service;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\Front\HomeController;

class Router
{
    public static array $routes = [
        '' => 'Front\HomeController',
       'contact' => 'Front\ContactController',
       'posts' => 'Front\PostController',
       'connexion' => 'Front\ConnexionController',
       'process' => 'Front\ProcessController',
       '?admin' => 'Admin\HomeAdminController',
       'admin/newpost' => 'Admin\PostController',
       'admin/newtag' => 'Admin\TagController',
    ];

    public function run(): void
    {
        $routes = new RouteCollection();
        $route = new Route('/', ['_controller' => HomeController::class]);
        $routes->add('home', $route);


        $context = new RequestContext();

        $matcher = new UrlMatcher($routes, $context);
        $routeUri = $_SERVER['REQUEST_URI'];
        $parameters = $matcher->match($routeUri);
        //On récupère tout ce qui est à droite de l'URI en supprimant le 1er "/"
        
        //$routeName retourne son premier opérande s'il existe et n'est pas NULL; sinon, il retourne son deuxième opérande.
        //On factorise le chemin complet dans le $controllerName
        $controllerName = $parameters['_controller'];

        $controller = new $controllerName();
        $controller();
    }
}