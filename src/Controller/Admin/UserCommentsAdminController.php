<?php

namespace App\Controller\Admin;

use App\Entity\CommentFactory;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;

class UserCommentsAdminController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $userId = (int)$parameters['userId'];
        $user = UserRepository::getUser($userId);
        //CREER NBPAGECOMMENT
        $nbpages = CommentRepository::getNbPagesComments();
        //récupérer tout les commentaire à partir de cet id user
        $commentUser = CommentRepository::getCommentsUser($userId);
        if (isset($_GET['page_user'])) {
            $page = $_GET['page_user'];
        } else {
            $page = 1;
        }

        //changement de statut du commentaire
        if (isset($_POST["comment-id"])) {
            $commentStatus = CommentRepository::changeStatusComment(CommentRepository::getComment($_POST["comment-id"]), $_POST["comment-status"]);
        }

        //CREER DISPLAY COMMENTS
        $comments = CommentRepository::displayComments($page);

        //transmettre le numéro de page et le nbpost pour la pagination
        $this->render('commentUsers.twig', 'Admin', ['user' => $user, 'listComments' => $comments, 'nbPages' => $nbpages, 'currentPage' => $page]);
    }
}