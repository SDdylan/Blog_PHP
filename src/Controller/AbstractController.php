<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserFactory;
use App\Service\SessionService;

abstract class AbstractController
{
    protected function render(string $templateName, string $folderName, array $content = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(ROOTPATH . '/src/View/'.$folderName);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render($templateName, $content);
    }

    protected function redirectToUrl(string $url = "/")
    {
        header('Location: ' . $url);
        exit();
    }

    protected function redirectToHomepage(): void
    {
        $this->redirectToUrl("/");
    }

    protected function redirectToAdminHomepage(): void
    {
        $this->redirectToUrl("/admin");
    }


    protected function getUser(): ?User
    {
        /*$user = UserFactory::create($_SESSION['user']->getFirstName(), $_SESSION['user']->getLastName(), $_SESSION['user']->getEmail(), $_SESSION['user']->getAlias(), $_SESSION['user']->getPassword());
        return $user;*/
        return null;
    }

    protected function isUserLoggedIn(): bool
    {
        /*if(isset($_SESSION['user'])) {
            $logged = true;
        } else {
            $logged = false;
        }
        return $logged; */

        // SessionService::isUserLoggedIn()   //isset($_SESSION['user']
        return true;
    }

    protected function isUserAdmin(): bool
    {
        if(!$this->isUserLoggedIn()) {
            return false;
        }

        /*
         * $user = $this->getUser();
         * return $user->isAdmin();
         */

        //d'ou viens le $user ?
        /*$user = SessionService::getUser();
        return $user->isAdmin();   */

        return true;
    }

}