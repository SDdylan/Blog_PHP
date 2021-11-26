<?php

namespace App\Repository;

use App\Database\DBConnection;

class CommentRepository
{
    //A factoriser ?
    //Fonction pour récuperer les derniers commentaires publiés sur un post
    public static function getComments(int $id_post) 
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE post_id = ' . $id_post . ' ORDER BY created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = $comment;
        }
        return $comments;
        
    }

    //Créer nouveau commentaire
    public static function setNewComments(int $user_id, int $post_id, string $content) 
    {
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO comment ("user_id", "post_id", "created_at", "content") VALUES (' . $user_id . ', ' . $post_id . ', ' . getdate() . ', ' . $content . ' ) ';
        $commentPDO = $pdo->query($sql);
        
    }


