<?php

namespace App\Repository;

use App\Database\DBConnection;

class PostRepository
{
    public static function getLastPosts(int $limit = 10)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post ORDER BY updated_at DESC LIMIT ' . $limit;
        $articlesPDO = $pdo->query($sql);
        $posts =[];
        foreach ($articlesPDO as $article) {
            $posts[] = $article;
        }
        return $posts;
        
    }
}