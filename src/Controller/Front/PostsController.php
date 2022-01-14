<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

class PostsController extends AbstractController
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

        if (isset($_POST['delete_post'])) {
            $deletePost = PostRepository::deletePost($_POST['delete_post']);
        }

        $posts = PostRepository::displayPost($page);
        //transmettre le numéro de page et le nbpost pour la pagination
        $this->render('posts.twig', 'Front', ['listPost' => $posts, 'nbPages' => $nbpages, 'currentPage' => $page]);

    }
}