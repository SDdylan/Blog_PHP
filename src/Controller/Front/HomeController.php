<?php

namespace App\Controller\Front;
use App\Entity\TagFactory;
use App\Entity\UserFactory;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use App\Controller\AbstractController;
use App\Database\DBConnection;
class HomeController extends AbstractController
{
    public function __invoke()
    {
        //$posts = PostRepository::getLastPosts();
        //$this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        $posts = PostRepository::getPostBySlug("titre-test");
        //$this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        //$posts = PostRepository::getLastPosts();
        //var_dump($posts);
        //exit;
        //$this->render('homepage.twig', 'Front', ['listPost' => $posts]);

        //$post = PostRepository::createPost(1,1,"Title test 2", "chapo test 2", "content test 2");
        //var_dump($post);
        //exit;
        //$this->render('homepage.twig', 'Front', ['post' => $post]);

        //$user = UserRepository::GetUser(1);
        //$userAd = UserRepository::setAdmin(UserRepository::GetUser(1));
        //$newTag = TagFactory::create('Divers');
        //var_dump($newTag);

        //$Tag = TagRepository::createTag($newTag);


        
    }
}
