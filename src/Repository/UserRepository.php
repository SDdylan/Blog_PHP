<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\User;
use App\Entity\UserFactory;

class UserRepository
{
    //A factoriser ?
    //Fonction pour récuperer les utilisateurs 
    public static function getUsers(int $limit = 10)
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

    public static function getUser(int $userId): User
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM user WHERE id = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$userId]);
        $userPDO = $select->fetch();

        return UserFactory::createFromDatabase($userPDO);
    }

    //Passer un utilisateur en administrateur
    public static function setAdmin(User $user): void
    {
        $userParams = [
            'id' => $user->getId()
        ];
        $pdo = DBConnection::getPDO();
        $sql = 'UPDATE user SET is_admin = 1  WHERE id = :id';
        $insert = $pdo->prepare($sql);
        $insert->execute($userParams);
    }

    //Créer un nouvel utilisateur
    public static function createUser(User $user): void
    {
        $userParams = [
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'alias' => $user->getAlias(),
            'firstname' => $user->getFirstName(),
            'lastname' => $user->getLastName()
        ];
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO user (email, password, alias, firstname, lastname) VALUES (:email, :password, :alias, :firstname, :lastname) ';
        $insert = $pdo->prepare($sql);
        $insert->execute($userParams);
    }

    //Fonction pour update les infos de l'utilisateur
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