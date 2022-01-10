<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
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
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["post-form"])) {
            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm();
            if(empty($errors)) {
                //$tag = TagRepository::getTag($_POST["tag"]);
                $post = PostFactory::create(TagRepository::getTag($_POST["tag"]), $this->getUser(), $_POST["title"], new \DateTime(), $_POST["chapo"], $_POST["content"]);
                //Insertion de l'utilisateur dans la BDD
                $createPost = PostRepository::createPost($post);
            }
        }

        //récuperer les tags
        $tags = TagRepository::getTags();
        $this->render('addpost.twig', 'Admin',  ['listTag' => $tags]);
    }
    //const time = DateTimeInterface::ATOM;
    //var_dump(datetime);

    private function validateRegisterForm(): array //$_POST en paramètre provoque une erreur : Cannot re-assign auto-global variable _POST
    {
        $errors = [];

        $firstName = $_POST["tag"];
        try {
            Assertion::notEmpty($firstName);
        } catch (AssertionFailedException $exception) {
            $errors['tag'] = "Le tag ne peut pas être vide";
        }

        $title = $_POST["title"];
        try {
            Assertion::notEmpty($title);
        } catch (AssertionFailedException $exception) {
            $errors['title'] = "Le titre ne peut être vide";
        }

        $chapo = $_POST["chapo"];
        try {
            Assertion::notEmpty($chapo);
        } catch (AssertionFailedException $exception) {
            $errors['chapo'] = "Le chapo ne peut être vide";
        }

        $content = $_POST["content"];
        try {
            Assertion::notEmpty($content);
        } catch (AssertionFailedException $exception) {
            $errors['content'] = "Le contenu ne peut être vide";
        }

        return $errors;
    }

    }