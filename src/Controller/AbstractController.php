<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserFactory;
use App\Service\SessionService;

abstract class AbstractController
{
    protected function render(string $templateName, string $folderName, array $content = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(ROOTPATH . '/src/View/');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        $content['isLogged'] = $this->isUserLoggedIn();
        $content['isAdmin'] = $this->isUserAdmin();
        echo $twig->render($folderName . "/" . $templateName, $content);
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
        return SessionService::getUser();
    }

    protected function isUserLoggedIn(): bool
    {
        return SessionService::isUserLoggedIn();
    }

    protected function isUserAdmin(): bool
    {
        if(!$this->isUserLoggedIn()) {
            return false;
        }
        $user = $this->getUser();
        return $user->isAdmin();

    }

}