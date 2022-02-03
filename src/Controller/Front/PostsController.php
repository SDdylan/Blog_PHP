<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

class PostsController extends AbstractController
{
    public function __invoke()
    {
        //numéro de page et le nbpost pour la pagination
        $nbPages = PostRepository::getNbPagesPosts();
        $page = $_GET['page_post'] ?? 1;
        $posts = PostRepository::getPosts($page);
        $this->render('posts.twig', 'Front', ['listPost' => $posts, 'nbPages' => $nbPages, 'currentPage' => $page]);
    }
}