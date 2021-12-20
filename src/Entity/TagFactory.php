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

    public static function createFromDatabase(object $tagFromDatabase): Tag
    {
        $tag = new Tag();

        //ne fonctionne pas lorsque on utilise les setter à la suite comme dans les autres Factory
        $tag->setId($tagFromDatabase->id);
        $tag->setName($tagFromDatabase->name);

        return $tag;
    }
}