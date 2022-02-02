<?php

namespace App\Entity;

use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Cocur\Slugify\Slugify;

class PostFactory
{
    public static function create(User $user, string $title, \DateTimeInterface $updatedAt, string $chapo, string $content): Post
    {
        $post = new Post();

        $slugify = new Slugify();

        $post->setUser($user);
        $post->setTitle($title);
        $post->setUpdatedAt($updatedAt);
        $post->setChapo($chapo);
        $post->setContent($content);
        $post->setSlug($slugify->slugify($title));
        return $post;
    }

    public static function createFromDatabase(object $postFromDatabase): Post
    {
        $userId = $postFromDatabase->user_id;
        $user = UserRepository::getUser($userId);

        $post = new Post();
        $post->setId($postFromDatabase->id);
        $post->setTitle($postFromDatabase->title);
        $post->setChapo($postFromDatabase->chapo);
        $post->setContent($postFromDatabase->content);
        $post->setUpdatedAt(new \DateTime($postFromDatabase->updated_at));
        $post->setSlug($postFromDatabase->slug);
        $post->setUser($user);
        return $post;
    }
}