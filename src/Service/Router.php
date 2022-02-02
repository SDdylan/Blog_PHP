<?php

namespace App\Service;

use App\Controller\Admin\ChangeCommentController;
use App\Controller\Admin\ChangeUserController;
use App\Controller\Admin\EditPostController;
use App\Controller\Admin\GetCommentController;
use App\Controller\Admin\PostDeleteController;
use App\Controller\Admin\PostsController as AdminPostsController;
use App\Controller\Admin\UserAdminController;
use App\Controller\Admin\UserCommentsAdminController;
use App\Controller\Front\CommentController;
use App\Controller\Front\DeconnexionController;
use App\Controller\Front\PostsController;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\Front\HomeController;
use App\Controller\Front\ContactController;
use App\Controller\Front\PostController;
use App\Controller\Front\ConnexionController;
use App\Controller\Admin\NewPostController;


class Router
{
    public function run(): void
    {
        $routes = new RouteCollection();

        $route = new Route('/', ['_controller' => HomeController::class]);
        $routes->add('home', $route);

        $route = new Route('/contact', ['_controller' => ContactController::class]);
        $routes->add('contact', $route);

        $route = new Route('/connexion', ['_controller' => ConnexionController::class]);
        $routes->add('connexion', $route);

        $route = new Route('/deconnexion', ['_controller' => DeconnexionController::class]);
        $routes->add('deconnexion', $route);

        $route = new Route('/posts', ['_controller' => PostsController::class]);
        $routes->add('posts', $route);

        $route = new Route('/posts/{postId}/comments/add', ['_controller' => CommentController::class]);
        $routes->add('postNewComment', $route);

        $route = new Route('/posts/{postId}-{postSlug}', ['_controller' => PostController::class]);
        $routes->add('postDetail', $route);

        //Adapter le bon controleur à la route juste en dessous
        $route = new Route('/admin', ['_controller' => AdminPostsController::class]);
        $routes->add('admin', $route);

        $route = new Route('/admin/posts/add', ['_controller' => NewPostController::class]);
        $routes->add('newPost', $route);

        $route = new Route('/admin/posts/{postId}/delete', ['_controller' => PostDeleteController::class]);
        $routes->add('deletePost', $route);

        $route = new Route('/admin/posts/{postId}/edit', ['_controller' => EditPostController::class]);
        $routes->add('edit_post', $route);

        $route = new Route('/admin/posts/{postId}/comments', ['_controller' => GetCommentController::class]);
        $routes->add('postComment', $route);

        $route = new Route('/admin/comments/{commentId}/change', ['_controller' => ChangeCommentController::class]);
        $routes->add('commentChange', $route);

        $route = new Route('/admin/users', ['_controller' => UserAdminController::class]);
        $routes->add('users', $route);

        $route = new Route('admin/users/{userId}/comments', ['_controller' => UserCommentsAdminController::class]);
        $routes->add('users_comments', $route);

        $route = new Route('admin/users/{userId}/change', ['_controller' => ChangeUserController::class]);
        $routes->add('users_change', $route);

        $context = new RequestContext();

        $matcher = new UrlMatcher($routes, $context);
        $routeUri = !isset($_SERVER['REDIRECT_URL']) ? '/' : $_SERVER['REDIRECT_URL'];
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
        } else {
            $controller($extraParameters);
        }
    }
}