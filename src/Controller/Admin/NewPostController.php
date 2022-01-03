<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\TagRepository;
use App\Entity\TagFactory;
use App\Entity\PostFactory;

class NewPostController extends AbstractController
{
    public function __invoke()
    {
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["post-form"])) {
            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm();
            if(empty($errors)) {
                //$user = PostFactory::create($_POST["tag"], $_SESSION["user"], $_POST["title"], date("Y-m-d H:i:s") , $_POST["chapo"], $_POST["content"]);
                //Insertion de l'utilisateur dans la BDD
                /*$createUser = UserRepository::createUser($user);

                //Créer la session PHP pour stocker toutes les données de User (plus tard, la session sera gérée dans un service de session)
                SessionService::createSession($user);
                $this->redirectToHomepage();*/
            }
        }

        //récuperer les tags
        $tags = TagRepository::getTags();
        $this->render('addpost.twig', 'Admin',  ['listTag' => $tags]);
    }


}