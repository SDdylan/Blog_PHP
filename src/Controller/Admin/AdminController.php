<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

class AdminController extends AbstractController
{

    public function __construct()
    {
        if( !$this->isUserLoggedIn() || !$this->isUserAdmin()) {
            $this->redirectToHomepage();
        }
        $posts = PostRepository::getLastPosts();
        $this->render('homeadmin.twig', 'Admin', ['listPost' => $posts]);
    }

}