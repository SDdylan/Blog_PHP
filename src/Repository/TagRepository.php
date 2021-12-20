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
        $articlesPDO = $pdo->query($sql);
        $posts =[];
        foreach ($articlesPDO as $article) {
            $posts[] = $article;
        }
        return $posts;
        
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