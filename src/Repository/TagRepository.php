<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\Tag;
use App\Entity\TagFactory;

class TagRepository
{
    //Fonction pour ajouter un Tag a la BDD
    public static function createTag(Tag $tag) : void
    {
        /*$tagParams = [
            'name' => $tag->getName()
        ];*/
        $tagName = $tag->getName();
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO tag (name) VALUES (?) ';
        $insert = $pdo->prepare($sql);
        $insert->execute([$tagName]);
    }

    //Recupération de tout les tags (tri des posts)
    public static function getTags()
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM tag ORDER BY id DESC';
        $tagsPDO = $pdo->query($sql);
        $tags =[];
        foreach ($tagsPDO as $tag) {
            $tags[] = TagFactory::createFromDatabase($tag);
        }
        return $tags;
        
    }

    public static function getTag(int $tagId): Tag
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM tag WHERE id = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$tagId]);
        $tagPDO = $select->fetch();

        return TagFactory::createFromDatabase($tagPDO);
    }
}