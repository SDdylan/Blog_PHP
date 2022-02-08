<?php

namespace App\Repository;

use App\Database\DBConnection;
use App\Entity\User;
use App\Entity\UserFactory;

class UserRepository
{
    public static function getUser(int $userId): User
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM user WHERE id = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$userId]);
        $userPDO = $select->fetch();

        return UserFactory::createFromDatabase($userPDO);
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

    public static function getUsers(int $numpages = 1): array
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
        $newStatus = $statusUser == 0 ? 1 : 0;
        $userParams = [
            'id_user' => $user->getId(),
            'new_status' => $newStatus
        ];
        $sql = 'UPDATE user SET is_admin = :new_status WHERE id = :id_user';
        $userPDO = $pdo->prepare($sql);
        $userPDO->execute($userParams);
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

    public static function getUserByEmail(string $mail) : User
    {
        $pdo = DBConnection::getPDO();
        $sql = 'SELECT * FROM user WHERE email = ?';
        $select = $pdo->prepare($sql);
        $select->execute([$mail]);
        $userPDO = $select->fetch();
        return UserFactory::createFromDatabase($userPDO);
    }
}
