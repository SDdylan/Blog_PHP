<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;

class HomeController
{

    public function __invoke()
    {
        $loader = new \Twig\Loader\FilesystemLoader(ROOTPATH . '\src\View\Front');
        $twig = new \Twig\Environment($loader, [
        'cache' => false,
        ]);
        echo $twig->render('homepage.twig');
    }
}

