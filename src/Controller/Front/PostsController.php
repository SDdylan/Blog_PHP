<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class PostsController extends AbstractController
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        var_dump($_GET);
        exit;

    }
}