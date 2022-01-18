<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Service\Mailer;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        if (isset($_POST['submit'])){
            $mail = sendMail();
        }
        $this->render('contact.twig', 'Front');
    }
}