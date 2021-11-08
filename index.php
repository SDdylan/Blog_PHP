<?php

use App\Service\Router;

require 'vendor/autoload.php';

//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();