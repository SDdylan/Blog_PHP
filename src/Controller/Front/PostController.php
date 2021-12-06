<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    public function __invoke(string $slug = 'titre-test')
    {
        $post = PostRepository::getPostBySlug($slug);
        $comments = CommentRepository::getCommentsPost($post->getId());
        $this->render('post.twig', 'Front', ['post' => $post, 'comments' => $comments]);
    }
}