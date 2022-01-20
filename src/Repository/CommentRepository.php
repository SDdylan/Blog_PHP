<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\CommentFactory;
use App\Entity\Comment;
use App\Entity\User;

class CommentRepository
{
    //Fonction pour récupérer tous les commentaires d'un post validés ou non
    public static function getCommentsPost(int $postId, bool $validOnly = true) : array
    {
        $pdo = DBConnection::getPDO();
        $validOnly = ($validOnly === true) ? ' AND is_validated = 1' : null;
        $sql = 'SELECT * FROM comment WHERE post_id = ' . $postId . ' ' . $validOnly . ' ORDER BY created_at DESC ';
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
    public static function addComment(Comment $comment) : void
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
    public static function deleteComment(int $commentId) : void
    {
        $pdo = DBConnection::getPDO();
        $sql = 'DELETE FROM comment WHERE id = ' . $commentId;
        $commentPDO = $pdo->query($sql);
    }

    //Recupérer tout les commentaires d'un utilisateur
    /*public static function getCommentsUser(int $idUser): array
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM comment WHERE user_id = ' . $idUser . ' ORDER BY created_at DESC ';
        $commentsPDO = $pdo->query($sql);
        $comments =[];
        foreach ($commentsPDO as $comment) {
            $comments[] = $comment;
        }
        return $comments;
    }*/

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

    //Récuperation et affichage de tout les commentaires d'un utilisateur
    public static function getCommentsUser(User $user, int $numPages = 1): array
    {
        $pdo = DBConnection::getPDO();
        $nbComments = self::getNbComments();
        $idUser = $user->getId();
        $sql = $nbComments > $numPages * 10 && $numPages === 1 ? "SELECT * FROM comment WHERE user_id = " . $idUser . " ORDER BY created_at DESC LIMIT 10 " : "SELECT * FROM comment WHERE user_id = " . $idUser . " ORDER BY created_at DESC LIMIT 10 OFFSET " . ($numPages - 1) * 10;
        $commentsPDO = $pdo->query($sql);
        $comments = [];
        foreach ($commentsPDO as $commentPDO) {
            $comments[] = CommentFactory::createFromDatabase($commentPDO);
        }
        return $comments;
    }

    public static function changeStatusComment(Comment $comment, int $commentStatus) : void
    {
        $pdo = DBConnection::getPDO();
        $new_status = $commentStatus == 0 ? 1 : 0;
        $sql = 'UPDATE comment SET is_validated = ' . $new_status . ' WHERE id = ' . $comment->getId();
        $commentsPDO = $pdo->query($sql);
    }
}