<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    public function __invoke(array $parameters)
    {
        $postId = $parameters['postId'];
        $slug = $parameters['postSlug'];

        var_dump($postId);
        var_dump($slug);
        exit;
        $post = PostRepository::getPost(1);
        $comments = CommentRepository::getCommentsPost(1);
        $this->render('post.twig', 'Front', ['post' => $post, 'comments' => $comments]);
    }
}