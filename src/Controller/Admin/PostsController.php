<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;

class PostsController extends AdminController
{
    public function __invoke()
    {
        $posts = PostRepository::getLastPosts();
        $nbpost = PostRepository::getNbPosts();
        var_dump($nbpost);
        $this->render('homeadmin.twig', 'Admin', ['listPost' => $posts]);
    }
}