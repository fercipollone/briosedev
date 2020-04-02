<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPmailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

$email = "fercipollone@gmail.com";
$razonSocial = "Hola Mundo";
$password = "Clave";

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->SMTPDebug = 2;                                       // Disable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    /*
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'fercipollone@gmail.com';                     // SMTP username
    $mail->Password   = 'Fiorella';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    */

    $mail->Host       = 'smtp.envioclubes.com.ar';                // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
    $mail->Username   = 'club1@envioclubes.com.ar';               // SMTP username
    $mail->Password   = 'PepeMoni1973-';                          // SMTP password
    //$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                      // TCP port to connect to

    //Recipients
    $mail->setFrom('test@movilsol.net', 'Sede Virtual');
    //$mail->addAddress('fernando@movilsol.net', 'Fernando');     // Add a recipient
    //$mail->addAddress('contacto@gerenciadeportiva.com.ar');     // Name is optional
    $mail->addAddress($email);     // Name is optional
    $mail->addBCC('fernando@movilsol.net');
    
    /*
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
    */

    // Attachments
    /*
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    */

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reenvio de Clave ' . $razonSocial;
    $mail->Body    = 'Le enviamos su clave para que pueda acceder al sitio http://cecha.org.ar, su clave es: ' . $password;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo 'Message has been sent';
    //header("Location:EnviaClaveOK.asp");
    die();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    //header("Location:EnviaClaveFail.asp");
    die();
}

?>
