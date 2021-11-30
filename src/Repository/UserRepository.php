<?php

namespace App\Repository;

use App\Database\DBConnection;

class UserRepository
{
    //A factoriser ?
    //Fonction pour récuperer les utilisateurs 
    public static function getUser(int $limit = 10)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM user ORDER BY id ASC LIMIT ' . $limit;
        $usersPDO = $pdo->query($sql);
        $users =[];
        foreach ($usersPDO as $user) {
            $users[] = $user;
        }
        return $users;
        
    }

    //Passer un utilisateur en administrateur
    public static function setAdmin(int $id)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'UPDATE user SET is_admin = 1  WHERE id=? ASC LIMIT ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        //$userPDO = $pdo->query($sql);
        
    }

    //Créer un nouvel utilisateur
    public static function createUser(string $email, string $password, string $alias, string $firstname, string $lastname)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO user ("email", "password", "alias", firstname, "lastname") VALUES (' . $email . ', ' . $password . ', ' . $alias . ', ' . $firstname . ', ' . $lastname . ') ';
        $userPDO = $pdo->query($sql);
    }

    //Fonction de connexion ?
    //Bannir utilisateur
    //Modifier alias, mdp, email, ...
}