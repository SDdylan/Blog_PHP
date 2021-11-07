<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controller\Front\HomeController;

// Routeur

/*
 *  $controller = 'HomeController'
 *
 */

$controller = new HomeController();
$controller->execute();

require 'src/View/Front/homepage.php';