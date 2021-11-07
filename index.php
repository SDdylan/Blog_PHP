<?php

use App\Controller\Front\HomeController;

require 'vendor/autoload.php';

// Routeur

/*
 *  $controller = 'HomeController'
 *
 */

$controller = new HomeController();
$controller->execute();

require 'index.html';