<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

class PostsController extends AbstractController
{
    public function __invoke()
    {
        $nbPages = PostRepository::getNbPagesPosts();
        $page = $_GET['page_post'] ?? 1;
        $posts = PostRepository::getPosts($page);
        //transmettre le numéro de page et le nbpost pour la pagination
        $this->render('posts.twig', 'Front', ['listPost' => $posts, 'nbPages' => $nbPages, 'currentPage' => $page]);
    }
}