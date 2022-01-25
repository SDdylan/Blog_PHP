<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Service\Mailer;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        if (isset($_POST['submit'])){
            sendMail($_POST["message"],$_POST["email"],$_POST["phone"],$_POST["name"]);
        }
        $this->render('contact.twig', 'Front');
    }
}