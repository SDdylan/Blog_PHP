<?php

namespace App\Controller\Admin;

use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;

class UserAdminController extends AdminController
{
    public function __invoke()
    {
        try {
            $nbPages = UserRepository::getNbPagesUsers();
            $page = $_GET['page_user'] ?? 1;
            //changement de statut de l'utilisateur
            $users = UserRepository::getUsers($page);
            //transmettre le numéro de page et le nbpost pour la pagination
            $this->render('users.twig', 'Admin', ['listUsers' => $users, 'nbPages' => $nbPages, 'currentPage' => $page]);
        } catch (UserNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}
