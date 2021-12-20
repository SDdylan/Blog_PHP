<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Repository\PostRepository;

class CommentFactory
{
    public static function create(int $id, User $user, Post $post, \DateTimeInterface $createdAt, string $content): Comment
    {
        $comment = new Comment();


        $comment->setId($id)
            ->setUser($user)
            ->setPost($post)
            ->setCreatedAt($createdAt)
            ->setContent($content);

        return $comment;
    }

    public static function createFromDatabase(object $commentFromDatabase): Comment
    {
        $userId = $commentFromDatabase->user_id;
        $user = UserRepository::getUser($userId);

        $postId = $commentFromDatabase->post_id;
        $post = PostRepository::getPost($postId);

        $comment = new Comment();
        $comment->setId($commentFromDatabase->id);
        $comment->setUser($user);
        $comment->setPost($post);
        $comment->setCreatedAt(new \DateTime($commentFromDatabase->created_at));
        $comment->setContent($commentFromDatabase->content);
        $comment->setIsValidated($commentFromDatabase->is_validated === 1);

        return $comment;
    }
}