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

    public static function getNbUsers() : int
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT COUNT(*) as nbusers FROM user';
        $select = $pdo->prepare($sql);
        $select->execute();
        $usersPDO = $select->fetch();
        return (int)$usersPDO->nbusers;
    }

    public static function getNbPagesUsers() : int
    {
        $nbusers = self::getNbUsers();
        $nbpages = floatval($nbusers/10);
        $nbpages = ceil($nbpages);
        return $nbpages;
    }

    public static function displayUsers(int $numpages = 1): array
    {
        $pdo = DBConnection::getPDO();
        $nbusers = self::getNbUsers();
        if ($nbusers > $numpages*10) {
            if ($numpages === 1) {
                $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 10 ";
            } elseif ($numpages > 1) {
                $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 10 OFFSET " . ($numpages-1)*10 ;
            }
        } else {
            $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 10 OFFSET " . ($numpages-1)*10 ;
        }
        $usersPDO = $pdo->query($sql);
        $user = [];
        foreach ($usersPDO as $userPDO) {
            $user[] = UserFactory::createFromDatabase($userPDO);
        }
        return $user;
    }

    //Fonction pour changer le statut d'un utilisateur
    public static function changeStatusUser(User $user, int $statusUser) : void
    {
        $pdo = DBConnection::getPDO();
        $idUser = $user->getId();
        if ($statusUser == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }
        $sql = 'UPDATE user SET is_admin = ' . $newStatus . ' WHERE id = ' . $idUser;
        $userPDO = $pdo->query($sql);
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
        return UserFactory::createFromDatabase($userPDO);
    }

    //Fonction de connexion ?
    //Bannir utilisateur
    //Modifier alias, mdp, email, ...
}