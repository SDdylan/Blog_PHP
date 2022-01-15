<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class PostCommentController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $post = PostRepository::getPost($postId);

        try {
            if (isset($_POST["comment-status"])) {
                $commentStatus = CommentRepository::changeStatusComment($_POST["comment-id"], $_POST["comment-status"]);
            }
            $comments = CommentRepository::getCommentsPost($postId);
            $this->render('commentPost.twig', 'Admin', ['comments' => $comments, 'post' => $post]);
        } catch (PostNotFoundException $exception) { //CHANGER L'EXCEPTION
            $this->redirectToUrl();
        }

    }
}