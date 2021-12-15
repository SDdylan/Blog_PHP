<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Entity\UserFactory;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;

class ConnexionController extends AbstractController
{

    public function __invoke()
    {
        /*
         * Supprimer commentaire inutiles
         * Supprimer ligne 24 ($user = 0)
         */

        //echo password_hash('1234', PASSWORD_DEFAULT);
        //$password = UserRepository::modifyPasswordUser('1234');
        $user = 0;

        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["register-form"])) {

            //Supprimer les var-dump
            var_dump($_POST["lastname-register"]);
            var_dump($_POST["firstname-register"]);
            var_dump($_POST["alias-register"]);
            var_dump($_POST["password-register"]);
            var_dump($_POST["mail-register"]);

            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm($_POST);
            if(empty($errors)) {
                $user = UserFactory::create($_POST["firstname-register"], $_POST["lastname-register"], $_POST["mail-register"], $_POST["alias-register"], $_POST["password-register"]);

                //Appeler la méthode createUser du repository afin de l'insérer en DB

                //Créer la session PHP pour stocker toutes les données de User (plus tard, la session sera gérée dans un service de session)
            }

            /*
             * Tout le bloc en dessous est inutile
             */

            var_dump($user);
            $hash = $user->getPassword();
            var_dump($hash);

            if (password_verify($_POST["password-register"], $hash)) {
                echo 'Le mot de passe est valide !';
            } else {
                echo 'Le mot de passe est invalide.';
            }
        }

        // Si on a soumis le formulaire de connexion
        if (isset($_POST["connexion-form"])) {
            var_dump($_POST["mail-connexion"]);
            var_dump($_POST["password-connexion"]);

            //Modifier l'appel ci-dessous pour n'utiliser que le $_POST["mail-connexion"]
            $user = UserRepository::getUserByEmail($_POST["mail-connexion"], $_POST["password-connexion"]);

            //Vérifier la validité du password en comparant $user->getPassword() à $_POST["password-connexion"]



            //ajouter pop-up puis redirection vers page de profil ou page d'accueil

        }

        //Ajouter aux paramètres envoyées à la vue notre nouveau table d'erreur de saisie et afficher les messages d'erreur côté front le cas échéant
        $this->render('connexion.twig', 'Front', ['user' => $user]);
    }

    /**
     * @param array $_POST
     */
    private function validateRegisterForm(array $_POST): array
    {
        $errors = [];

        $firstName = $_POST["firstname-register"];
        try {
            Assertion::notEmpty($firstName);
        } catch (AssertionFailedException $exception) {
            $errors['firstname-register'] = "Le prénom ne peut pas être vide";
        }

        $email = $_POST["mail-register"];
        try {
            Assertion::notEmpty($email);
            Assertion::email($email);
        } catch (AssertionFailedException $exception) {
            $errors['mail-register'] = "Le format de l'adresse mail est invalide";
        }

        return $errors;

    }

}