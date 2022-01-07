<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserFactory;

class SessionService
{
    /*
     * Implémenter 3 méthodes statiques :
     *
     * 1) isUserLoggedId() -> bool et permet de savoir si l'user est connecté ou pas
     * 2) createSession(User $user) -> crée la session en stockant le User
     * 3) deleteSession() -> supprimer la session (en ayant vérifié que la clé $_SESSION['user'] existe bien
     * 4) getUser() -> renvoie $_SESSION['user'] si ça existe
     */
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