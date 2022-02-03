<?php

use App\Controller\Front\HomeController;
use App\Service\Router;
use App\Service\Mailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Twig\Extra\Intl\IntlExtension;
//On importe la classe User afin que l'objet en session ne devienne pas un PHP_Incomplete_Class dans la navigation
require_once __DIR__ . '/src/Entity/User.php';

session_start();

require 'vendor/autoload.php';

//constante définissant la racine du projet (AbstractController)
const ROOTPATH = __DIR__;


//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();
