<?php

namespace App\Controller\Front;

use App\Entity\UserFactory;
use App\Repository\UserRepository;

class SignupController
{
    public function __invoke()
    {
        //Vérifier que le formulaire a été soumis et que les valeurs sont valides
        //$_POST['firstname'];

        //Si tout est ok dans la soumission du form => alors on récupère les données du user
        $firstName = 'Dylan';
        $lastName = 'Sardi';
        $email = 'dylan@sardi.com';
        $alias = 'dylansardi';
        $clearPassword = 'password';

        //On crée une entité User à partir de ces informations (et donc en encode le mot de passe)
        $user = UserFactory::create($firstName, $lastName, $email, $alias, $clearPassword);

        //On inscrit le user depuis l'entité User qu'on passe à la méthode du repository
        UserRepository::createUser($user);

        $msgSuccess = 'Votre compte a été créé';


        //Afficher le formulaire d'inscription

    }
}