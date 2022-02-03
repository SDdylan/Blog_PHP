<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Entity\PostFactory;
use Assert\Assertion;
use Assert\AssertionFailedException;

class NewPostController extends AdminController
{
    public function __invoke()
    {
        $errors = null;
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["post-form"])) {
            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm();
            if(empty($errors)) {
                //Insertion du Post dans la BDD
                PostRepository::createPost(PostFactory::create($this->getUser(), $_POST["title"], new \DateTime(), $_POST["chapo"], $_POST["content"]));
                $this->redirectToAdminHomepage();
            }
        }
        $this->render('addPost.twig', 'Admin',  [ "errors" => $errors]);
    }

    private function validateRegisterForm(): array
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