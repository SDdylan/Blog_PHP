<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Service\SessionService;

class DeconnexionController extends AbstractController
{
    public function __invoke()
    {
        SessionService::deleteSession();
        $this->redirectToHomepage();
    }
}