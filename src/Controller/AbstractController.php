<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\UserFactory;
use App\Service\SessionService;
use Assert\Assertion;
use Assert\AssertionFailedException;

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
        $content['folder'] = $folderName;
        echo $twig->render($folderName . "/" . $templateName, $content);
    }

    protected function redirectToUrl(string $url = "/")
    {
        header('Location: ' . $url);
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

    protected function validatePostForm(): array
    {
        $errors = [];

        $title = $_POST["title"];
        try {
            Assertion::notEmpty($title);
            Assertion::minLength($title, Post::TITLE_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['title'] = "Le titre ne faire moins de " . Post::TITLE_MIN_LENGTH  . " caractères.";
        }

        $chapo = $_POST["chapo"];
        try {
            Assertion::notEmpty($chapo);
            Assertion::minLength($chapo, Post::CHAPO_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['chapo'] = "Le chapo ne faire moins de " . Post::CHAPO_MIN_LENGTH  . " caractères.";
        }

        $content = $_POST["content"];
        try {
            Assertion::notEmpty($content);
            Assertion::minLength($content, Post::CONTENT_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['content'] = "Le contenu ne faire moins de " . Post::CONTENT_MIN_LENGTH  . " caractères.";
        }

        return $errors;
    }

}
