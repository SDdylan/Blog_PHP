<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use App\Entity\TagFactory;
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
                PostRepository::createPost(PostFactory::create(TagRepository::getTag($_POST["tag"]), $this->getUser(), $_POST["title"], new \DateTime(), $_POST["chapo"], $_POST["content"]));
            }
        }
        //récuperer les tags
        $tags = TagRepository::getTags();
        $this->render('addPost.twig', 'Admin',  ['listTag' => $tags, "errors" => $errors]);
    }

    private function validateRegisterForm(): array //$_POST en paramètre provoque une erreur : Cannot re-assign auto-global variable _POST
    {
        $errors = [];

        $tag = $_POST["tag"];
        try {
            Assertion::notEmpty($tag);
        } catch (AssertionFailedException $exception) {
            $errors['tag'] = "Le tag ne peut pas être vide";
        }

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