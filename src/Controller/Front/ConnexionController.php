<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class ConnexionController extends AbstractController
{

    public function __invoke()
    {
        $this->render('connexion.twig', 'Front');
    }
}