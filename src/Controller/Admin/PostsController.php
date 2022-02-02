<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;

class PostsController extends AdminController
{
    public function __invoke()
    {
        $nbPages = PostRepository::getNbPagesPosts();
        $page = $_GET['page'] ?? 1;
        $posts = PostRepository::getPosts($page);
        //transmettre le numéro de page et le nbpost pour la pagination
        $this->render('homeAdmin.twig', 'Admin', ['listPost' => $posts, 'nbPages' => $nbPages, 'currentPage' => $page]);
    }
}