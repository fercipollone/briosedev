<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/src/PHPmailer.php';
require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/SMTP.php';



class clsMailer
        {
            protected $mail;

            public function __construct()
            {
                               
            }

            Public function Enviar($from, $email, $subject, $textohtml)
            {
                $mail = new PHPMailer(true);
                $resp = false;
                try 
                    {
                        //Server settings
                        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                        //$mail->SMTPDebug = 0;                                       // Disable verbose debug output
                        $mail->isSMTP();                                            // Set mailer to use SMTP
                        $mail->Host       = 'smtp.envioclubes.com.ar';                       // Specify main and backup SMTP servers
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = 'club1@enviclubes.com.ar';                    // SMTP username
                        $mail->Password   = 'PepeMoni1973-';                               // SMTP password
                        //$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                        $mail->Port       = 465;                                    // TCP port to connect to
                    
                        //Recipients
                        $mail->setFrom('clubx@clubx.com.ar', 'Envio desde la sede virtual');
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
                        $mail->Subject = 'Reenvio de Clave ';
                        $mail->Body    = 'Le enviamos su clave para que pueda acceder al sitio http://cecha.org.ar, su clave es: ';
                        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        $mail->send();
                    
                        //echo 'Message has been sent';
                        $resp = true; 
                        die();
                
                    } 
                catch (Exception $e) 
                    {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        die();
                    }
                    return $resp;
            }
        }


?>
