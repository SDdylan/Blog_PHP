<?php

namespace App\Controller\Admin;

use App\Entity\CommentFactory;
use App\Exception\UserNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;

class UserCommentsAdminController extends AdminController
{
    public function __invoke(array $parameters)
    {
        try {
            $userId = (int)$parameters['userId'];
            $user = UserRepository::getUser($userId);
            $nbPages = CommentRepository::getNbPagesComments();
            $page = $_GET['page_user'] ?? 1;
            // Affichage des commentaires de l'utilisateur
            $comments = CommentRepository::getCommentsUser($user, $page);
            //transmettre le numéro de page et le nbpost pour la pagination
            $this->render('commentUsers.twig', 'Admin', ['user' => $user, 'listComments' => $comments, 'nbPages' => $nbPages, 'currentPage' => $page]);
        } catch (UserNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }
}
