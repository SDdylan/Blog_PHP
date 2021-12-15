<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Entity\UserFactory;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class ConnexionController extends AbstractController
{

    public function __invoke()
    {
        //echo password_hash('1234', PASSWORD_DEFAULT);
        //$password = UserRepository::modifyPasswordUser('1234');
        $user=0;
        if (isset($_POST["register-form"])) {
            var_dump($_POST["lastname-register"]);
            var_dump($_POST["firstname-register"]);
            var_dump($_POST["alias-register"]);
            var_dump($_POST["password-register"]);
            var_dump($_POST["mail-register"]);
            $user = UserFactory::create($_POST["firstname-register"],$_POST["lastname-register"],$_POST["mail-register"], $_POST["alias-register"], $_POST["password-register"]);
            var_dump($user);
            $hash = $user->getPassword();
            var_dump($hash);

            if (password_verify($_POST["password-register"], $hash)) {
                echo 'Le mot de passe est valide !';
            } else {
                echo 'Le mot de passe est invalide.';
            }
        }

        if(isset($_POST["connexion-form"])) {
            var_dump($_POST["mail-connexion"]);
            var_dump($_POST["password-connexion"]);
            $connexion = UserRepository::getUserByEmail($_POST["mail-connexion"],$_POST["password-connexion"]);
            //ajouter pop-up puis redirection vers page de profil ou page d'accueil

        }

        $this->render('connexion.twig', 'Front', ['user' => $user]);
    }
}