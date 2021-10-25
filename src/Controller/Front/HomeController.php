<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;

class HomeController
{

    public function __construct()
    {

    }

    public function execute()
    {
        //Récupérer la liste des 10 derniers posts
        $posts = PostRepository::getLastPosts();

        //Envoyer les données récupérées à la vue concernée
        //Loader la vue Twig correspondante en lui passant notre variable $posts

    }
}