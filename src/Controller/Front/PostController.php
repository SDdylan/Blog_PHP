<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Entity\CommentFactory;
use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Service\SessionService;
use Assert\Assertion;
use Assert\AssertionFailedException;

class PostController extends AbstractController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];

        try {
            $isLogged = SessionService::isUserLoggedIn();
            $post = PostRepository::getPost($postId);
            //Si soumission d'un commentaire à la BDD
            /*if (isset($_POST["comment-form"])) {
                //Validation des données (à compléter)
                $errors = $this->validateCommentForm();


                //!\\ A DEPLACER DANS UN CommentController //!\\
                /*if(empty($errors)) {
                    $comment = CommentFactory::create($this->getUser(), PostRepository::getPost($postId), new \DateTime(), $_POST["comment-text"]);
                    //Insertion de l'utilisateur dans la BDD
                    $comment = CommentRepository::addComment($comment);
                }
                // ---------------------------------- //


            }*/
            $comments = CommentRepository::getCommentsPost($post->getId());
            $this->render('post.twig', 'Front', ['post' => $post, 'comments' => $comments, 'isLogged' => $isLogged]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }

    //A DEPLACER DANS UN COMMENT CONTROLLER
    //
    /*
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
    }*/
}