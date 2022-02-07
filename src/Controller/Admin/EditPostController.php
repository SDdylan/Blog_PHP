<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Post;
use App\Exception\PostNotFoundException;
use App\Repository\PostRepository;

class EditPostController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $errors = null;
        try {
            $post = PostRepository::getPost($postId);
            if (isset($_POST['post-modify-form'])) {
                $errors = AbstractController::validateRegisterForm();
                if(empty($errors)) {
                    PostRepository::editPost($this->updatePost($post));
                }
            }
            $this->render('editPost.twig', 'Admin', ['post' => $post, 'errors' => $errors]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }

    private function updatePost(Post $post)
    {
        $post->setUser($this->getUser());
        $post->setTitle($_POST['title']);
        $post->setUpdatedAt(new \DateTime());
        $post->setChapo($_POST['chapo']);
        $post->setContent($_POST['content']);
        return $post;
    }
}
