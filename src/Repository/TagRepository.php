<?php

namespace App\Repository;

use App\Database\DBConnection;

class TagRepository
{
    //Fonction pour ajouter un Tag a la BDD
    public static function setNewTag(string $name)
    {
        $pdo = DBConnection::getPDO();
        $sql = 'INSERT INTO category ("name", ) VALUES (' . $name . ') ';
        $userPDO = $pdo->query($sql);
    }