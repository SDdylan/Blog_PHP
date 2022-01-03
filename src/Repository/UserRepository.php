<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\User;
use App\Entity\UserFactory;

class UserRepository
{
    //Fonction pour récuperer les utilisateurs 
    public static function getUsers(int $limit = 10) : array
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
    public static function createUser(User $user): User
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

        return self::getUserByEmail($user->getEmail());
    }

    //Fonction pour update les infos de l'utilisateur
    public static function modifyPasswordUser(string $newPassword) : void
    {
        $pdo = DBConnection::getPDO();
        $pwd = password_hash($newPassword, PASSWORD_DEFAULT);
        //On part du principe que l'utilisateur est déjà loggé
        $sql = 'UPDATE user SET password = "' . $pwd . '" WHERE id = 1 ' ;
        $userPDO = $pdo->query($sql);
    }

    //Fonction de connexion
    //Respecter les PSR au niveau de l'alignement des accolades
    public static function getUserByEmail(string $mail) : User
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM user WHERE email = "'.  $mail . '"';
        $select = $pdo->prepare($sql);
        $select->execute();
        $userPDO = $select->fetch();
        $user = UserFactory::createFromDatabase($userPDO);
        return $user;
    }

    //Fonction de connexion ?
    //Bannir utilisateur
    //Modifier alias, mdp, email, ...
}