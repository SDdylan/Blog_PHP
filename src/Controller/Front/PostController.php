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
            //$isLogged = SessionService::isUserLoggedIn();
            $post = PostRepository::getPost($postId);
            $comments = CommentRepository::getCommentsPost($post->getId());
            if (isset($_GET['commented'])) {
                $commented = true;
            } else {
                $commented = false;
            }
            $this->render('post.twig', 'Front', ['post' => $post, 'comments' => $comments, 'commented' => $commented]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}