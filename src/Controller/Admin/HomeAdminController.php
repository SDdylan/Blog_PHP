<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class HomeAdminController extends AdminController
{
    public function __invoke()
    {
        $this->render('homeadmin.twig', 'Admin');
    }
}