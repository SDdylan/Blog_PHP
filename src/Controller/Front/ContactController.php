<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Service\Mailer;
use Assert\Assertion;
use Assert\AssertionFailedException;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        $success = false;
        $error = false;

        if (isset($_POST['submit'])){
            try {
                Mailer::sendContactEmail($_POST["message"],$_POST["email"],$_POST["name"]);
                $success = true;
            } catch (\Exception $e) {
                $error = true;
            }
        }
        $this->render('contact.twig', 'Front', [
            'success' => $success,
            'error' => $error
        ]);
    }
}
