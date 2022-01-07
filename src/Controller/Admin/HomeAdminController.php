<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

class HomeAdminController extends AdminController
{
    public function __invoke()
    {
        //Faire en sorte de récupérer les posts 10 par 10 afin de ne pas surcharger la page ?
        $posts = PostRepository::getLastPosts();
        var_dump($posts);
        //$this->render('(old)homeadmin.twig', 'Admin', ['listPost' => $posts]);
    }
}