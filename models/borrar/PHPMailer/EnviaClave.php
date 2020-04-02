<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPmailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

$email = "fernando@movilsol.net";
$razonSocial = "Hola Mundo";
$password = "Clave";

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->SMTPDebug = 0;                                       // Disable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@cecha.org.ar';                     // SMTP username
    $mail->Password   = 'Pass@info';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@cecha.org.ar', 'Resp. Aut. desde CECHA.org.ar');
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

    //echo 'Message has been sent';
    header("Location:EnviaClaveOK.asp");
    die();

} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location:EnviaClaveFail.asp");
    die();
}

?>
