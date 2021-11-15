<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __invoke()
    {
        $this->render('homepage.twig', 'Front');
    }
}
