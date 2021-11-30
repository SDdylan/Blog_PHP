<?php

namespace App\Entity;

use App\Repository\UserRepository;

class PostFactory
{
    public static function createFromDatabase(object $postFromDatabase): Post
    {
        $userId = $postFromDatabase->user_id;
        $user = UserRepository::getUser($userId);

        $post = new Post();
        $post->setId($postFromDatabase->id)
            ->setTitle($postFromDatabase->title)
            ->setChapo($postFromDatabase->chapo)
            ->setUpdatedAt(new \DateTime($postFromDatabase->updated_at))
            ->setUser($user);

        return $post;
    }
}