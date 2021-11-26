<?php

namespace App\Controller\Front;
use App\Repository\PostRepository;
use App\Controller\AbstractController;
use App\Database\DBConnection;
class HomeController extends AbstractController
{
    public function __invoke()
    {
        //$posts = PostRepository::getLastPosts();
        //$this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        $post = PostRepository::getPost(1);
        var_dump($post);
        exit;
        $this->render('homepage.twig', 'Front', ['post' => $post]);
    }
}
