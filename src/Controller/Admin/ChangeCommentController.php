<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class ChangeCommentController extends AdminController
{
    public function __invoke(array $parameters)
    {
        try {
            if (isset($_POST["comment-status"])) {
                CommentRepository::changeStatusComment(CommentRepository::getComment($_POST["comment-id"]), $_POST["comment-status"]);
            }
            if (isset($_POST['post'])) {
                $this->redirectToUrl('/admin/posts/' . $_POST['post'] . '/comments');
            } elseif (isset($_POST['user'])) {
                $this->redirectToUrl('/admin/users/' . $_POST['user'] . '/comments');
            }
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }

    }
}
