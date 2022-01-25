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
                Mailer::sendContactEmail($_POST["message"],$_POST["email"],$_POST["name"], $_POST["phone"]);
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

    /*private function validateContactForm(): array //$_POST en paramètre provoque une erreur : Cannot re-assign auto-global variable _POST
    {
        $errors = [];

        $name = $_POST["name"];
        try {
            Assertion::notEmpty($name);
        } catch (AssertionFailedException $exception) {
            $errors['firstname-register'] = "Le nom ne peut pas être vide";
        }

        $email = $_POST["email"];
        try {
            Assertion::notEmpty($email);
            Assertion::email($email);
        } catch (AssertionFailedException $exception) {
            $errors['email'] = "Le format de l'adresse mail est invalide";
        }

        $phone = $_POST["phone"];
        try {
            Assertion::notEmpty($phone);
        } catch (AssertionFailedException $exception) {
            $errors['phone'] = "Le format du numéro de téléphone n'est pas valide";
        }

        $message = $_POST["message"];
        try {
            Assertion::notEmpty($message);
        } catch (AssertionFailedException $exception) {
            $errors['message'] = "Le format du message n'est pas valide";
        }

        return $errors;
    }*/
}