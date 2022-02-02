<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserFactory;

class SessionService
{
    public static function isUserLoggedIn() : bool
    {
        return isset($_SESSION['user']);
    }

    public static function createSession(User $user) : void
    {
        $_SESSION['user'] = $user;
    }

    public static function deleteSession() : void
    {
        session_destroy();
    }

    public static function getUser() : ?User
    {
        if (self::isUserLoggedIn()) {
            return $_SESSION['user'];
        }
        return null;
    }
}