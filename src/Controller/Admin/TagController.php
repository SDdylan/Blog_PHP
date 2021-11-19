<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class TagController extends AbstractController
{
    public function __invoke()
    {
        $this->render('tag.twig', 'Admin');
    }
}