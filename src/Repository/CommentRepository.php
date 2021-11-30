<?php

namespace App\Repository;

use App\Database\DBConnection;

class CommentRepository
{
    //A factoriser ?
    //Fonction pour récuperer les derniers commentaires publiés sur un post (il faut aussi les pseudo des utilisateurs)
    public static function getCommentsPost(int $id_post) 
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment JOIN user ON comment.user_id = user.id WHERE comment.post_id = ' . $id_post . ' AND comment.is_validated = 1 ORDER BY comment.created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = $comment;
        }
        return $comments;
        
    }

    //Créer nouveau commentaire
    public static function createComment(int $user_id, int $post_id, string $content) 
    {
        $pdo = DBConnection::getPDO();
        $date = getdate();
        $created_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
        $sql = 'INSERT INTO comment ("user_id", "post_id", "created_at", "content") VALUES (' . $user_id . ', ' . $post_id . ', ' . $created_date . ', ' . $content . ' ) ';
        $commentPDO = $pdo->query($sql);
        
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
}