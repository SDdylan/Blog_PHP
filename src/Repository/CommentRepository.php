<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\CommentFactory;
use App\Entity\Comment;

class CommentRepository
{
    //A factoriser ?
    //Fonction pour récuperer les derniers commentaires publiés sur un post (il faut aussi les pseudo des utilisateurs)
    public static function getCommentsValidatedPost(int $postId) : array
    {

        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE post_id = ' . $postId . ' AND is_validated = 1 ORDER BY created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = CommentFactory::createFromDatabase($comment);
        }
        return $comments;
    }

    //Fonction pour récupérer tous les commentaires d'un post sans prendre en compte leurs statut
    public static function getCommentsPost(int $postId) : array
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE post_id = ' . $postId . ' ORDER BY created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = CommentFactory::createFromDatabase($comment);
        }
        return $comments;
    }

    //Récupérer un Commentaire à partir de son id
    public static function getComment(int $commentId) : Comment
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE id = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$commentId]);
        $commentPDO = $select->fetch();

        return CommentFactory::createFromDatabase($commentPDO);
    }

    //Créer nouveau commentaire
    public static function createComment(Comment $comment) : void
    {
        $commentParams = [
            "user_id" => $comment->getUserId(),
            "post_id" => $comment->getPostId(),
            "created_at" => $comment->getCreatedAt()->format('Y-m-d H:i:s'),
            "content" => $comment->getContent()
        ];

        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO comment (user_id, post_id, created_at, content) VALUES (:user_id, :post_id, :created_at, :content) ';
        $insert = $pdo->prepare($sql);
        $insert->execute($commentParams);
    }

    //Supprimer un commentaire
    public static function deleteComment(int $comment_id) : void
    {
        $pdo = DBConnection::getPDO();
        $sql = 'DELETE FROM comment WHERE id = ' . $comment_id;
        $commentPDO = $pdo->query($sql);
    }

    //Recupérer tout les commentaires d'un utilisateur
    public static function getCommentsUser(int $id_user) 
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE user_id = ' . $id_user . ' ORDER BY created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = $comment;
        }
        return $comments;
    }

    public static function getNbComments() : int
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT COUNT(*) as nbcomment FROM comment';
        $select = $pdo->prepare($sql);
        $select->execute();
        $commentPDO = $select->fetch();
        return (int)$commentPDO->nbcomment;
    }

    public static function getNbPagesComments() : int
    {
        $nbComments = self::getNbComments();
        $nbpages = floatval($nbComments/10);
        $nbpages = ceil($nbpages);
        return $nbpages;
    }

    public static function displayComments(int $numpages = 1): array
    {
        $pdo = DBConnection::getPDO();
        $nbComments = self::getNbComments();
        if ($nbComments > $numpages*10) {
            if ($numpages === 1) {
                $sql = "SELECT * FROM comment ORDER BY created_at DESC LIMIT 10 ";
            } elseif ($numpages > 1) {
                $sql = "SELECT * FROM comment ORDER BY created_at DESC LIMIT 10 OFFSET " . ($numpages-1)*10 ;
            }
        } else {
            $sql = "SELECT * FROM comment ORDER BY created_at DESC LIMIT 10 OFFSET " . ($numpages-1)*10 ;
        }
        $commentsPDO = $pdo->query($sql);
        $comments = [];
        foreach ($commentsPDO as $commentPDO) {
            $comments[] = CommentFactory::createFromDatabase($commentPDO);
        }
        return $comments;
    }

    public static function changeStatusComment(Comment $comment, int $status_comment) : void
    {
        $pdo = DBConnection::getPDO();
        if ($status_comment == 0) {
            $new_status = 1;
        } else {
            $new_status = 0;
        }
        $sql = 'UPDATE comment SET is_validated = ' . $new_status . ' WHERE id = ' . $comment->getId();
        $commentsPDO = $pdo->query($sql);
    }
}