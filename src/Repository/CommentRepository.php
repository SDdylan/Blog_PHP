<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\CommentFactory;
use App\Entity\Comment;

class CommentRepository
{
    //A factoriser ?
    //Fonction pour récuperer les derniers commentaires publiés sur un post (il faut aussi les pseudo des utilisateurs)
    public static function getCommentsValidatedPost(int $postId)
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
    public static function getCommentsPost(int $postId)
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

    //Créer nouveau commentaire
    public static function createComment(Comment $comment)
    {
        $commentParams = [
            "user_id" => $comment->getUser(),
            "post_id" => $comment->getPost(),
            "created_at" => $comment->getCreatedAt(),
            "content" => $comment->getContent()
        ];

        $pdo = DBConnection::getPDO();
        $date = getdate();
        $created_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
        $sql = 'INSERT INTO comment ("user_id", "post_id", "created_at", "content") VALUES (:user_id, :post_id, :created_at, :content) ';
        $insert = $pdo->prepare($sql);
        $insert->execute($commentParams);
    }

    //Supprimer un commentaire
    public static function deleteComment(int $comment_id) {
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

    public static function changeStatusComment(int $id_comment, int $status_comment)
    {
        $pdo = DBConnection::getPDO();
        if ($status_comment == 0) {
            $new_status = 1;
        } else {
            $new_status = 0;
        }
        $sql = 'UPDATE comment SET is_validated = ' . $new_status . ' WHERE id = ' . $id_comment;
        $commentsPDO = $pdo->query($sql);
    }
}