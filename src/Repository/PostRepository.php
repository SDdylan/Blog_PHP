<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\Post;
use App\Entity\PostFactory;
use App\Exception\PostNotFoundException;
use Cocur\Slugify\Slugify;

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
    public static function getPost(int $postId) : Post
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM post WHERE id = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$postId]);
        $postPDO = $select->fetch();
        if (!$postPDO) {
            throw new PostNotFoundException();
        }
        return PostFactory::createFromDatabase($postPDO);
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
    public static function createPost(Post $post) : void
    {
        $postParams = [
            "user_id" => $post->getUserId(), //getUserId()
            "tag_id" => $post->getTagId(),    //getTagId à creer
            "title" => $post->getTitle(),
            "updated_at" => $post->getUpdatedAt()->format('Y-m-d H:i:s'), //on ne recupère que la date de l'objet DateTime
            "chapo" => $post->getChapo(),
            "content" => $post->getContent(),
            "slug" => $post->getSlug()
            //AJOUTER LE SLUG
        ];
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO post (user_id, tag_id, title, updated_at, chapo, content, slug) VALUES (:user_id, :tag_id, :title, :updated_at, :chapo, :content, :slug)' ;
        $insert = $pdo->prepare($sql);
        $insert->execute($postParams);
    }

    //récuperation d'un Post à partir d'un slug
    public static function getPostBySlug(string $slug) : Post
    {
        $pdo = DBConnection::getPDO();

        $sql = 'SELECT * FROM post WHERE slug = "' . $slug . '" ';
        //$postPDO = $pdo->query($sql);
        $select = $pdo->prepare($sql);
        $select->execute();
        $postPDO = $select->fetch();
        if (!$postPDO) {
            throw new PostNotFoundException();
        }
        return PostFactory::createFromDatabase($postPDO);
    }
}