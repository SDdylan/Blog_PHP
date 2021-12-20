<?php

namespace App\Service;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\Front\HomeController;
use App\Controller\Front\ContactController;
use App\Controller\Front\PostController;
use App\Controller\Front\ConnexionController;
use App\Controller\Front\ProcessController;
use App\Controller\Admin\HomeAdminController;
use App\Controller\Admin\NewPostController;
use App\Controller\Admin\TagController;

class Router
{
    /*public static array $routes = [
        '' => 'Front\HomeController',
       'contact' => 'Front\ContactController',
       'posts' => 'Front\PostController',
       'connexion' => 'Front\ConnexionController',
       'process' => 'Front\ProcessController',
       '?admin' => 'Admin\HomeAdminController',
       'admin/newpost' => 'Admin\PostController',
       'admin/newtag' => 'Admin\TagController',
    ];*/

    public function run(): void
    {
        $routes = new RouteCollection();

        //!\ A Factoriser /!\
        $route = new Route('/', ['_controller' => HomeController::class]);
        $routes->add('home', $route);

        $route = new Route('/contact', ['_controller' => ContactController::class]);
        $routes->add('contact', $route);

        $route = new Route('/posts', ['_controller' => PostController::class]);
        $routes->add('posts', $route);

        $route = new Route('/connexion', ['_controller' => ConnexionController::class]);
        $routes->add('connexion', $route);

        //Adapter le bon controleur à la route juste en dessous
        $route = new Route('/admin', ['_controller' => HomeAdminController::class]);
        $routes->add('admin', $route);

        $route = new Route('/admin/newpost', ['_controller' => NewPostController::class]);
        $routes->add('newpost', $route);

        $route = new Route('/admin/newtag', ['_controller' => TagController::class]);
        $routes->add('newtag', $route);

        $route = new Route('/process', ['_controller' => ProcessController::class]);
        $routes->add('process', $route);

        $route = new Route('/posts/{postId}-{postSlug}', ['_controller' => PostController::class]);
        $routes->add('post_detail', $route);

        $context = new RequestContext();

        $matcher = new UrlMatcher($routes, $context);
        $routeUri = $_SERVER['REQUEST_URI'];
        $parameters = $matcher->match($routeUri);
        $controllerName = $parameters['_controller'];


        $extraParameters = [];
        foreach ($parameters as $paramName => $value) {
            if ($paramName !== '_controller' && $paramName !== '_route') {
                $extraParameters[$paramName] = $value;
            }
        }

        $controller = new $controllerName();
        if(empty($extraParameters)) {
            $controller();
        }else{
            $controller($extraParameters);
        }
    }
}