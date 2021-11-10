<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;

class ContactController
{

    public function __invoke()
    {
        echo 'ContactPage loaded';
        //require '../../View/Front/homepage.php';
    }
}