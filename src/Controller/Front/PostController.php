<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class PostController extends AbstractController
{

    public function __invoke()
    {
        $this->render('post.twig', 'Front');
    }
}