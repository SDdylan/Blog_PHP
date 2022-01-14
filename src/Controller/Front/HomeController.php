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
        $posts = PostRepository::getLastPosts(3);
        $this->render('homepage.twig', 'Front', ['listPost' => $posts]);
    }
}
