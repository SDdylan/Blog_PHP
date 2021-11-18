<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class HomeAdminController extends AbstractController
{
    public function __invoke()
    {
        $this->render('homeadmin.twig', 'Admin');
    }
}