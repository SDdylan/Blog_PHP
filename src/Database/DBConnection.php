<?php

namespace App\Database;

use PDO;

class DBConnection {

    private static ?PDO $pdo = null;

    public static function getPDO(): PDO 
    {
        if (is_null(self::$pdo)) {
            $host= $_ENV['DATABASE_HOST'];
            $dbName=$_ENV['DATABASE_NAME'];
            $dbUser=$_ENV['DATABASE_USER'];
            $dbPwd=$_ENV['DATABASE_PASSWORD'];
            $pdo= new \PDO("mysql:dbname=$dbName;host=$host", $dbUser, $dbPwd);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            self::$pdo = $pdo;
        }
        return self::$pdo;
        
    }
}
