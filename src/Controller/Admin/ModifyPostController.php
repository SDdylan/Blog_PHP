<?php

namespace App\Controller\Admin;

use App\Entity\PostFactory;
use App\Exception\PostNotFoundException;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;

class ModifyPostController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $post = PostRepository::getPost($postId);
        $tags = TagRepository::getTags();
        try {
            if (isset($_POST['post-modify-form'])) {
                $errors = $this->validateRegisterForm();
                if(empty($errors)) {
                    $updatedPost = PostFactory::create(TagRepository::getTag($_POST['tag']), $this->getUser(), $_POST['title'], new \DateTime(), $_POST['chapo'], $_POST['content']);
                    //On set l'id pour qu'il soit bien compris pour l'update du POST
                    $updatedPost->setId($postId);
                    $modifyPost = PostRepository::modifyPost($updatedPost);
                    //on récupère de nouveau le contenu pour l'afficher correctement sur la page.
                    $post = PostRepository::getPost($postId);
                }
            }
            $this->render('modifyPost.twig', 'Admin', ['post' => $post, 'listTag' => $tags]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }

    private function validateRegisterForm(): array
    {
        $errors = [];

        $title = $_POST['title'];
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

        $tag = $_POST["tag"];
        try {
            Assertion::notEmpty($tag);
        } catch (AssertionFailedException $exception) {
            $errors['tag'] = "Le contenu ne peut être vide";
        }

        return $errors;
    }

}