<?php

namespace App\Controller\Admin;

use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;

class UserAdminController extends AdminController
{
    public function __invoke()
    {
        try {
            $nbpages = UserRepository::getNbPagesUsers();
            //$nbpost = PostRepository::getNbPosts();
            if (isset($_GET['page_user'])) {
                $page = $_GET['page_user'];
            } else {
                $page = 1;
            }

            //changement de statut de l'utilisateur
            if (isset($_POST["user-id"])) {
                $userStatus = UserRepository::changeStatusUser($_POST["user-id"], $_POST["user-status"]);
            }

            $users = UserRepository::displayUsers($page);
            //transmettre le numéro de page et le nbpost pour la pagination
            $this->render('users.twig', 'Admin', ['listUsers' => $users, 'nbPages' => $nbpages, 'currentPage' => $page]);
        } catch (UserNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}