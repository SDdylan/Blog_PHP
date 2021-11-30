<?php

namespace App\Repository;

use App\Database\DBConnection;

class TagRepository
{
    //Fonction pour ajouter un Tag a la BDD
    public static function createTag(string $name)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO tag ("name", ) VALUES (' . $name . ') ';
        $userPDO = $pdo->query($sql);
    }

    //Recupération de tout les tags (tri des posts)
    public static function getTags()
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM tag ORDER BY updated_at DESC';
        $articlesPDO = $pdo->query($sql);
        $posts =[];
        foreach ($articlesPDO as $article) {
            $posts[] = $article;
        }
        return $posts;
        
    }
}