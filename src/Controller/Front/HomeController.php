<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;

class HomeController
{

    public function __invoke()
    {
        echo 'Homepage loaded';
    }
}

