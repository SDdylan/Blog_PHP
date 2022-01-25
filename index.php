<?php

use App\Controller\Front\HomeController;
use App\Service\Router;
use App\Service\Mailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Twig\Extra\Intl\IntlExtension;
//On importe la classe User afin que l'objet en session ne devienne pas un PHP_Incomplete_Class dans la navigation
require_once __DIR__ . '/src/Entity/User.php';

session_start();

/* PATH A AJOUTER POUR LES DIFFERENTES VUES TWIG
$loader->addPath(dirname(__DIR__).'/src/View', 'view');
$loader->addPath( dirname(__DIR__). '/src/View/Front', 'front');
$loader->addPath( dirname(__DIR__). '/src/View/Admin', 'admin');*/
require 'vendor/autoload.php';

//constante définissant la racine du projet (AbstractController)
const ROOTPATH = __DIR__;


//Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load router
$router = new Router();
$router->run();


function sendMail($body, $email, $phone, $name) //Ajouter les paramètres
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 4;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'e8d6b16f24930c';                     //SMTP username
        $mail->Password   = '625c7ab8b6ebbe';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';

        //Recipients
        /*$mail->setFrom('dylan.sardi@gmail.com', 'Mailer');
        $mail->addAddress('dylagia@gmail.com', 'User');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('dylan.sardi@gmail.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');*/
        $mail->setFrom('info@mailtrap.io', 'Mailtrap');
        $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
        $mail->addAddress('recipient1@mailtrap.io', 'Tim');
        $mail->addCC($email, $name);
        //$mail->addBCC('bcc1@example.com', 'Alex');
        /*$mail->Subject = 'Test Email via Mailtrap SMTP using PHPMailer';
        $mail->isHTML(true);
        $mailContent = "<h1>Send HTML Email using SMTP in PHP</h1><p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;*/

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Formulaire de contact : Blog';
        $mail->Body    = '<p>' . $name . ' à envoyé une demande de contact :</p><p>Adresse mail : ' . $email . '</p><p>Numéro de téléphone : ' . $phone . '</p><p>' . $body . '</p>';
        //$mail->Body    = '<p>' . $name . ' à envoyé une demande de contact :</p><p>Adresse mail : ' . $email . '</p>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}