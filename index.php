<?php

use App\Controller\Front\HomeController;
use App\Service\Router;
define('ROOTPATH', __DIR__);
require 'vendor/autoload.php';

//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();
