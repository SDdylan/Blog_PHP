<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\Post;
use App\Entity\PostFactory;

class PostRepository
{
    /**
     * @param int $limit
     * @return Post[]
     */
    public static function getLastPosts(int $limit = 10): array
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post ORDER BY updated_at DESC LIMIT ' . $limit;
        $postsPDO = $pdo->query($sql);

        $posts = [];
        foreach ($postsPDO as $postPDO) {
            $posts[] = PostFactory::createFromDatabase($postPDO);
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
        //var_dump($post);
        //exit;
        return $post;
    }

    //Fonction pour renvoyer les derniers posts appartenant a une certaine catégorie/tag (ajouter une limite ?)
    public static function getPostsByTag(int $posts_tag_id)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post WHERE tag_id = ' . $posts_tag_id . ' ORDER BY updated_at DESC' ;
        $articlesPDO = $pdo->query($sql);
        $posts =[];
        foreach ($articlesPDO as $article) {
            $posts[] = $article;
        }
        return $posts;
    }

    //Fonction pour créer un post 
    //NE FONCTIONNE PAS ENCORE
    public static function createPost(int $user_id, int $tag_id, string $title, string $chapo, string $content)
    {
        $pdo = DBConnection::getPDO();
        $date = getdate();
        $updated_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
        $sql = 'INSERT INTO post (user_id, tag_id, title, updated_at, chapo, content) VALUES (' . $user_id . ', ' . $tag_id . ', ' . $title . ', ' . $updated_date . ', ' . $chapo . ', ' . $content . ')' ;
        //var_dump($sql);
        //exit;
        $articlePDO = $pdo->query($sql);
        return $articlePDO;
    }
}