<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;

class HomeController
{

    public function __invoke()
    {
        //require_once 'vendor/autoload.php';
        /*echo "homepage";

        $loader = addPath('/templates')
        $loader = new \Twig\Loader\FilesystemLoader('/src/View');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        
        echo $twig->load('home.twig');*/
        //readfile("../../View/Front/homepage.php");
        $loader = new \Twig\Loader\FilesystemLoader(ROOTPATH . '\src\View\Front');
        $twig = new \Twig\Environment($loader, [
        'cache' => false,
        ]);

        echo $twig->render('home.twig');
    }
}

