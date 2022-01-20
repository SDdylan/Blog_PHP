<?php

namespace App\Controller\Admin;

use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;

class ChangeUserController extends AdminController
{
    public function __invoke(array $parameters)
    {
        try {
            //changement de statut de l'utilisateur
            if (isset($_POST["user-id"])) {
                $user = UserRepository::getUser($_POST["user-id"]);
                UserRepository::changeStatusUser(UserRepository::getUser($_POST["user-id"]), $_POST["user-status"]);
            }
            $this->redirectToUrl('/admin/users');
        } catch (UserNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}