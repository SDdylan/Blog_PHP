<?php

namespace App\Controller\Front;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Controller\AbstractController;
use App\Database\DBConnection;
class HomeController extends AbstractController
{
    public function __invoke()
    {
        $posts = PostRepository::getLastPosts();
        $this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        //$posts = PostRepository::getLastPosts();
        //var_dump($posts);
        //exit;
        //$this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        //$post = PostRepository::createPost(1,1,"Title test 2", "chapo test 2", "content test 2");
        //var_dump($post);
        //exit;
        //$this->render('homepage.twig', 'Front', ['post' => $post]);

        //$user = UserRepository::createUser('test@email.fr', 'password', 'user2', 'prenom2', 'nom2');
       //$email, string $password, string $alias, string $firstname, string $lastname
        
    }
}
