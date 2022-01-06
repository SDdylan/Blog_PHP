<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;

class PostCommentController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        try {
            if (isset($_POST["status-form"])) {
                var_dump($_POST["comment-id"]);
                var_dump($_POST["comment-status"]);
                $commentStatus = CommentRepository::changeStatusComment($_POST["comment-id"], $_POST["comment-status"]);
            }
            $comments = CommentRepository::getCommentsPost($postId);
            $this->render('commentPost.twig', 'Admin', ['comments' => $comments]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }

    }
}