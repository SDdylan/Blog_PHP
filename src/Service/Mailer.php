<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{

    public static function sendContactEmail(string $content, string $emailFrom, string $emailFromName, string $phone): void
    {
        $mailContent = '<p>';
        $mailContent .= 'Nom : '.$emailFromName.'<br />';
        $mailContent .= 'Adresse e-mail : '.$emailFrom.'<br />';
        $mailContent .= 'Numéro de téléphone : '.$phone.'<br />';
        $mailContent .= 'Contenu du message : ';
        $mailContent .= '</p>';
        $mailContent .= '<p>';
        $mailContent .= $content;
        $mailContent .= '</p>';

        self::sendMail($mailContent, 'Nouveau message depuis le formulaire de contact', $emailFrom, $emailFromName);
    }

    // Methode generique d'envoi d'email
    private static function sendMail(string $content, string $subject, string $emailFrom, ?string $emailFromName): void
    {
        $emailFromName = $emailFromName ?? $emailFrom;

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['EMAIL_SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['EMAIL_SMTP_USERNAME'];                     //SMTP username
        $mail->Password   = $_ENV['EMAIL_SMTP_PASSWORD'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $_ENV['EMAIL_SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($emailFrom, $emailFromName);
        $mail->addAddress($_ENV['EMAIL_RECIPIENT_ADDRESS'], $_ENV['EMAIL_RECIPIENT_NAME']);
        $mail->addReplyTo($emailFrom, $emailFromName);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->AltBody = $content;

        $mail->send();
    }
}