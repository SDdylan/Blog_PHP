<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\PostRepository;
use App\Repository\TagRepository;

class ModifyPostController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $post = PostRepository::getPost($postId);
        $tags = TagRepository::getTags();
        try {
            if (isset($_POST['post-modify-form'])) {
                $modifyPost = PostRepository::modifyPost($postId, $_POST['title'], $_POST['chapo'], $_POST['content'], $_POST['tag'], new \DateTime());
                //on récupère de nouveau le contenu pour l'afficher correctement sur la page.
                $post = PostRepository::getPost($postId);
            }
            $this->render('modifyPost.twig', 'Admin', ['post' => $post, 'listTag' => $tags]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }

}