<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\PostRepository;
use App\Entity\PostFactory;

class NewPostController extends AdminController
{
    public function __invoke()
    {
        $errors = null;
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["post-form"])) {
            //Validation des données (à compléter)
            $errors = AbstractController::validatePostForm();
            if(empty($errors)) {
                //Insertion du Post dans la BDD
                PostRepository::createPost(PostFactory::create($this->getUser(), $_POST["title"], new \DateTime(), $_POST["chapo"], $_POST["content"]));
                $this->redirectToAdminHomepage();
            }
        }
        $this->render('addPost.twig', 'Admin',  ['errors' => $errors]);
    }
}
