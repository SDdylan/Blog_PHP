<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;

class PostsController extends AdminController
{
    public function __invoke()
    {
        $posts = PostRepository::getLastPosts();
        $this->render('homeadmin.twig', 'Admin', ['listPost' => $posts]);
    }
}