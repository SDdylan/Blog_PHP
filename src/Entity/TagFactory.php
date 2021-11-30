<?php

namespace App\Entity;

class TagFactory
{
    public static function create(string $name): Tag
    {
        $tag = new Tag();
        $tag->setName($name);
        return $tag;
    }

    public static function createFromDatabase(object $tagFromDatabase): User
    {
        $tag = new Tag();
        $tag->setName($tagFromDatabase->name);
        return $user;
    }
}