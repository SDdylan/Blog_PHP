<?php

namespace App\Entity;

class UserFactory
{
    public static function create(string $firstName, string $lastName, string $email, string $alias, string $password): User
    {
        $user = new User();

        $user->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email)
            ->setAlias($alias)
            ->encodePassword($password);

        return $user;
    }

    public static function createFromDatabase(object $userFromDatabase): User
    {
        $user = new User();

        $user->setId($userFromDatabase->id)
            ->setFirstName($userFromDatabase->firstname)
            ->setLastName($userFromDatabase->lastname)
            ->setEmail($userFromDatabase->email)
            ->setAlias($userFromDatabase->alias)
            ->setPassword($userFromDatabase->password)
            ->setIsAdmin((int)$userFromDatabase->is_admin === 1);

        return $user;
    }
}
