<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;

class PostsController extends AdminController
{
    public function __invoke()
    {
        $nbpages = PostRepository::getNbPagesPosts();
        //$nbpost = PostRepository::getNbPosts();
        if (isset($_GET['page_post'])) {
            $page = $_GET['page_post'];
        } else {
            $page = 1;
        }
        $posts = PostRepository::displayPost($page);
        //transmettre le numéro de page et le nbpost pour la pagination
        $this->render('homeadmin.twig', 'Admin', ['listPost' => $posts, 'nbPages' => $nbpages, 'currentPage' => $page]);
    }
}