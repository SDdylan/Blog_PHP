<?php

use App\Controller\Front\HomeController;
use App\Service\Router;
use Twig\Extra\Intl\IntlExtension;

session_start();

/* PATH A AJOUTER POUR LES DIFFERENTES VUES TWIG
$loader->addPath(dirname(__DIR__).'/src/View', 'view');
$loader->addPath( dirname(__DIR__). '/src/View/Front', 'front');
$loader->addPath( dirname(__DIR__). '/src/View/Admin', 'admin');*/
require 'vendor/autoload.php';

//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();
