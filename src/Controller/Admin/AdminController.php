<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function __construct()
    {
        if( !$this->isUserLoggedIn() || !$this->isUserAdmin()) {
            $this->redirectToHomepage();
        }

        $this->render('homeadmin.twig', 'Admin');
    }

}