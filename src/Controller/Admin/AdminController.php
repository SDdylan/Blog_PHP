<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\PostRepository;

abstract class AdminController extends AbstractController
{

    public function __construct()
    {
        if( !$this->isUserLoggedIn() || !$this->isUserAdmin()) {
            $this->redirectToHomepage();
        }

    }

}
