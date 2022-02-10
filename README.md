
# Blog PHP

Ce projet est un blog en PHP réalisé dans le cadre de la formation PHP/Symfony de l'organisme OpenClassrooms.  

Réalisé selon l'architecture MVC, le visiteur peut naviguer sur les différentes pages du site dont le contenu découle d'une base de donnée stockant les informations des utilisateurs, articles et commentaires.
Un système d'authentification permet aux utilisateurs inscrits de commenter les articles mais également aux administrateurs d'interagir avec la base de donnée pour ajouter, modifier et supprimer du contenu.

## Technologies

* PHP 7.4
* Bootstrap 5

### Libraries

* [twig/twig](https://twig.symfony.com/) 3.0
* [phpmailer/phpmailer](https://github.com/PHPMailer/PHPMailer) 6.5
* [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) 4.2
* [beberlei/assert](https://github.com/beberlei/assert) 3.3
* [symfony/routing](https://github.com/beberlei/assert) 5.3
* [cocur/slugify](https://github.com/cocur/slugify) 3.2
* [twig/intl-extra](https://github.com/twigphp/intl-extra) 3.3
* [twig/extra-bundle](https://github.com/twigphp/twig-extra-bundle) 3.3
## Installation

Dans un premier temps vous devez exécuter le script SQL **projet5-structure.sql** puis le script **projet5-donnees.sql** disponible à la racine du projet dans votre système de base de donnée.  

Téléchargez et installez Composer en suivant les étapes de la [documentation officielle](https://getcomposer.org/download/).

Il faut ensuite installer les librairies, en exécutant cette commande dans un terminal à la racine du projet :

```bash
  composer install
```
### Variables d'environnement
Une fois les librairies installées, vous devez configurer les variables d'environnement en copiant le contenu du fichier **.env.example** dans un nouveau fichier **.env** 

Les valeurs devront être modifier en fonction de votre configuration au niveau de l'accès a votre système de base de donnée et de SMTP, nous vous recommandons par ailleurs l'utilisation de *MailTrap* pour la page de contact.




## Auteurs

[@SDdylan](https://github.com/SDdylan) sous la supervision de [@julienrusso-oc](https://github.com/julienrusso-oc).
