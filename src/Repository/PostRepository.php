<?php

namespace App\Repository;

use App\Database\DBConnection;

class PostRepository
{
    //A factoriser ?
    //Fonction pour récuperer les "n-ième" derniers posts publiés 
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

    //Fonction de récupération d'un post à partir de son id
    public static function getPost(int $post_id)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post WHERE id = ' . $post_id;
        $articlePDO = $pdo->query($sql);
        $post = $articlePDO -> fetchAll();
        $post[] = $articlePDO;
        return $post;
    }

    //Fonction pour renvoyer les derniers posts appartenant a une certaine catégorie/tag (ajouter une limite ?)
    public static function getPostsByTag(int $posts_tag_id)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post WHERE category_id =' . $posts_tag_id . ' AND ORDER BY updated_at DESC' ;
        $articlesPDO = $pdo->query($sql);
        $posts =[];
        foreach ($articlesPDO as $article) {
            $posts[] = $article;
        }
        return $posts;
    }

    //Fonction pour créer un post 
    public static function setPost(int $user_id, int $category_id, string $title, string $chapo, string $content)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO post ("user_id", "category_id", "title", "updated_at", "chapo", "content") VALUES (' . $user_id . ', ' . $category_id . ', ' . getdate() . ', ' . $title . ', ' . $chapo . ', ' . $content . ')' ;
        $articlesPDO = $pdo->query($sql);
    }
}