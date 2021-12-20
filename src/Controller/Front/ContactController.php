<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        $this->render('contact.twig', 'Front');
    }
}