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
        //$adminDPO = $pdo->prepare($sql);
        //$adminPDO->execute([$id]);
        //$userPDO = $pdo->query($sql);
        //return void;
    }

    //Créer un nouvel utilisateur
    public static function createUser(string $email, string $password, string $alias, string $firstname, string $lastname)
    {
        $user = [
            'email' => $email,
            'password' => $password,
            'alias' => $alias,
            'firstname' => $firstname,
            'lastname' => $lastname
        ];
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO user (email, password, alias, firstname, lastname) VALUES (:email, :password, :alias, :firstname, :lastname) ';
        $insert = $pdo->prepare($sql);
        $insert->execute($user);
        //var_dump($sql);
        //exit;
    }

    public static function modifyPasswordUser(string $newPassword)
    {
        $pdo = DBConnection::getPDO();
        //On part du principe que l'utilisateur est déjà loggé
        $sql = 'UPDATE user (password) VALUES (' . $newPassword . ') WHERE alias = ' . $_SESSION['login'] . ' AND password = ' . $_SESSION['password'] ;
        $userPDO = $pdo->query($sql);
    }



    //Fonction de connexion ?
    //Bannir utilisateur
    //Modifier alias, mdp, email, ...
}