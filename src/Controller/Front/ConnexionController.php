<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Entity\UserFactory;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\SessionService;
use Assert\Assertion;
use Assert\AssertionFailedException;

class ConnexionController extends AbstractController
{


    public function __invoke()
    {
        $errors = null;
        // Si on a soumis le formulaire d'enregistrement
        if (isset($_POST["register-form"])) {
            //Validation des données (à compléter)
            $errors = $this->validateRegisterForm();
            if(empty($errors)) {
                $user = UserFactory::create($_POST["firstname-register"], $_POST["lastname-register"], $_POST["mail-register"], $_POST["alias-register"], $_POST["password-register"]);
                //Insertion de l'utilisateur dans la BDD
                UserRepository::createUser($user);
                //Création de la session
                SessionService::createSession($user);
                $this->redirectToHomepage();
            }
        }

        // Si on a soumis le formulaire de connexion
        if (isset($_POST["connexion-form"])) {
            //Validation des données
            $errors = $this->validateSignInForm();
            if(empty($errors)) {
                $user = UserRepository::getUserByEmail($_POST["mail-connexion"]);
                //Vérifier la validité du password en comparant $user->getPassword() à $_POST["password-connexion"]
                if ($user->checkPassword($_POST["password-connexion"])) {
                    SessionService::createSession($user);
                    $this->redirectToAdminHomepage();
                }
            }
        }

        //Ajouter aux paramètres envoyées à la vue notre nouveau table d'erreur de saisie et afficher les messages d'erreur côté front le cas échéant
        $this->render('connexion.twig', 'Front', ["errors" => $errors]);
    }

    /**
     * @param array $_POST
     *
     */
    private function validateRegisterForm(): array
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

        $password = $_POST["password-register"];
        try {
            Assertion::notEmpty($password);
            Assertion::betweenLength($password, 8,255);
            Assertion::regex($password,"([a-zA-Z]*[0-9]*[$&+,:;=?@#|'<>.^*()%!-])"); // au moins 1 lettre majuscule ou minuscule, 1 chiffre et 1 caractère spécial
        } catch (AssertionFailedException $exception) {
            $errors['password-register'] = "Le format du mot de passe est invalide : au moins 1 lettre, 1 chiffre et 1 caractère spécial)";
        }

        $lastName = $_POST["lastname-register"];
        try {
            Assertion::notEmpty($password);
        } catch (AssertionFailedException $exception) {
            $errors['lastname-register'] = "Le format du nom n'est pas valide";
        }

        $firstName = $_POST["firstname-register"];
        try {
            Assertion::notEmpty($firstName);
        } catch (AssertionFailedException $exception) {
            $errors['lastname-register'] = "Le format du prénom n'est pas valide";
        }

        return $errors;
    }

    /**
     * @param array $_POST
     *
     */
    private function validateSignInForm(): array
    {
        $errors = [];

        $email = $_POST["mail-connexion"];
        try {
            Assertion::notEmpty($email);
            Assertion::email($email);
        } catch (AssertionFailedException $exception) {
            $errors['mail-connexion'] = "Le format de l'adresse mail est invalide";
        }

        $password = $_POST["password-connexion"];
        try {
            Assertion::notEmpty($password);
            Assertion::betweenLength($password, 8,255);
            Assertion::regex($password,"([a-zA-Z]*[0-9]*[$&+,:;=?@#|'<>.^*()%!-])");
        } catch (AssertionFailedException $exception) {
            $errors['password-connexion'] = "Le format du mot de passe est invalide";
        }

        return $errors;
    }

}
