<?php

use App\Controller\Front\HomeController;
use App\Service\Router;
use Twig\Extra\Intl\IntlExtension;
//On importe la classe User afin que l'objet en session ne devienne pas un PHP_Incomplete_Class dans la navigation
require_once __DIR__ . '/src/Entity/User.php';

session_start();

/* PATH A AJOUTER POUR LES DIFFERENTES VUES TWIG
$loader->addPath(dirname(__DIR__).'/src/View', 'view');
$loader->addPath( dirname(__DIR__). '/src/View/Front', 'front');
$loader->addPath( dirname(__DIR__). '/src/View/Admin', 'admin');*/
require 'vendor/autoload.php';

//constante définissant la racine du projet (AbstractController)
const ROOTPATH = __DIR__;


//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();
