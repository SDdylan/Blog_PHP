<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\PostFactory;
use App\Entity\TagFactory;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;

class NewTagController extends AbstractController
{
    public function __invoke()
    {
        $errors = null;
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["tagName"])) {
            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm();
            if(empty($errors)) {
                //Insertion du Post dans la BDD
                $tags = TagRepository::getTags();
                foreach ($tags as $tag) {
                    if ($_POST["tagName"] == $tag->getName()) {
                        $errors["tag"] = "Erreur : ce tag existe déjà.";
                    }
                }
                if (!isset($errors['tag'])) {
                    TagRepository::createTag(TagFactory::create($_POST["tagName"]));
                }
            }
        }
        $this->render('newTag.twig', 'Admin', ["errors" => $errors]);
    }

    private function validateRegisterForm(): array
    {
        $errors = [];

        $tag = $_POST["tagName"];
        try {
            Assertion::notEmpty($tag);
        } catch (AssertionFailedException $exception) {
            $errors['tag'] = "Le tag ne peut pas être vide";
        }
        return $errors;
    }

}