<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class PostController extends AbstractController
{
    public function __invoke()
    {
        $this->render('post.twig', 'Admin');
    }
}