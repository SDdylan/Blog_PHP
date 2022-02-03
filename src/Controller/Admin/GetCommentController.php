<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class GetCommentController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        try {
            $post = PostRepository::getPost($postId);
            $comments = CommentRepository::getCommentsPost($postId, false);
            $this->render('commentPost.twig', 'Admin', ['comments' => $comments, 'post' => $post]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }

    }
}