<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Entity\CommentFactory;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;

class CommentController extends AbstractController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $post = PostRepository::getPost($postId);
        if (isset($_POST["comment-form"])) {
            //Validation des données (à compléter)
            $errors = $this->validateCommentForm();

            if (empty($errors)) {
                $comment = CommentFactory::create($this->getUser(), $post, new \DateTime(), $_POST["comment-text"]);
                //Insertion de l'utilisateur dans la BDD
                CommentRepository::addComment($comment);
            }
        }
        $this->redirectToUrl('/posts/' . $postId . '-' . $post->getSlug());
    }

    //A DEPLACER DANS UN COMMENT CONTROLLER
    private function validateCommentForm(): array
    {
        $errors = [];

        $comment = $_POST["comment-text"];
        try {
            Assertion::notEmpty($comment);
        } catch (AssertionFailedException $exception) {
            $errors['comment-text'] = "Le commentaire ne peut pas être vide";
        }
        return $errors;
    }
}