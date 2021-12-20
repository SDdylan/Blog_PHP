<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];

        try {
            $post = PostRepository::getPost($postId);
            $comments = CommentRepository::getCommentsPost(1);
            $this->render('post.twig', 'Front', ['post' => $post, 'comments' => $comments]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}