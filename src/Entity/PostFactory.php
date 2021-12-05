<?php

namespace App\Entity;

use App\Repository\TagRepository;
use App\Repository\UserRepository;

class PostFactory
{
    public static function create(Tag $tag, User $user, string $title, \DateTimeInterface $updatedAt, string $chapo, string $content): Post
    {
        $post = new Post();

        $tagId = (new Tag)->getId($tag);
        $userId = (new User)->getId($user);

        $post->setTag($tagId)
            ->setUser($userId)
            ->setTitle($title)
            ->setUpdatedAt($updatedAt)
            ->setChapo($chapo)
            ->setContent($content);
        return $post;
    }

    public static function createFromDatabase(object $postFromDatabase): Post
    {
        $userId = $postFromDatabase->user_id;
        $user = UserRepository::getUser($userId);

        $tagId = $postFromDatabase->tag_id;
        $tag = TagRepository::getTag($tagId);

        $post = new Post();
        $post->setId($postFromDatabase->id)
            ->setTitle($postFromDatabase->title)
            ->setChapo($postFromDatabase->chapo)
            ->setUpdatedAt(new \DateTime($postFromDatabase->updated_at))
            ->setUser($user)
            ->setTag($tag);

        return $post;
    }
}