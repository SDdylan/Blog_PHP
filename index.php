<?php

use App\Service\Router;
define('ROOTPATH', __DIR__);
require 'vendor/autoload.php';

//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();
/*
$loader = new Twig_Loader_Filesystem(__DIR__ . '\src\View\Front');
$twig = new Twig_Environment($loader, [
'cache' => false,
]);

echo $twig->render('homepage.php');
*/