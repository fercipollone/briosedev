<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPmailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';



class clsMailer
        {
        
        protected $mail;
        protected $db;    
        protected $mysqli;

        public function __construct()
            {
                               
            }
        
        private function conectar()
            {
                require_once("../models/cnx.php");
                $this->db = new cnx(); 
                $this->mysqli = $this->db->conectar();  
            }
        
        private function desconectar()
            {
                $this->mysqli->close();
                $this->db->desconectar();
            }
        
        private function ObtenerCredenciales()
            {
                $this->conectar();
                $qry = "SELECT * FROM smtpserver";    
                $resultado = $this->mysqli->query($qry); 
                $resultado->free();
                $this->desconectar();
                return $resultado;
            }

        public function Enviar($from, $email, $subject, $textohtml, $club, $color)
            {
                $envio = false;
                $credenciales = $this->ObtenerCredenciales();
                
                while ($credencial = $credenciales->fetch_assoc())
                    {
                        $envio = $this->Envio($from, $email, $subject, $textohtml, $club, $credencial, $color);
                        if ($envio) 
                            {
                                break;
                            }
                    }
                return $envio;
            }
        public function Envio($from, $email, $subject, $textohtml, $club, $credencial, $color)
            {
                $mail = new PHPMailer(true);
                $resp = false;
                try 
                    {
                        
                        //Server settings DIGITAR
                        $mail->SMTPDebug = 0;   // 2 - Enable verbose debug output  / 0 - Disabled                                   
                        $mail->isSMTP(); // Set mailer to use SMTP                                           
                        $mail->Host = $credencial['smtp_host']; // Specify main and backup SMTP servers                      
                        
                        if ($credencial['smtp_auth'] == 1)
                            {
                                $mail->SMTPAuth = true; // Enable SMTP authentication
                            }
                        else
                            {
                                $mail->SMTPAuth = false; // Enable SMTP authentication
                            }
                        
                        $mail->Username = $credencial['smtp_username']; // SMTP username          
                        $mail->Password = $credencial['smtp_pass']; // SMTP password
                        
                        if (!$credencial['smtp_auth'] != Null)
                            {
                               $mail->SMTPSecure = $credencial['smtp_auth']; // Enable TLS encryption, `ssl` also accepted         
                            }  
                        
                        $mail->Port = $credencial['smtp_port']; // TCP port to connect to
                                                                 
                        // Header
                        $mail->setFrom($credencial['smtp_username'], $club.' Sede Virtual');
                                                
                        $mail->addReplyTo($from, $club.' Administracion');
                        $mail->addAddress($email);     // Name is optional
                        $mail->addBCC('fernando@movilsol.net');
                    
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $this->htmlmessage($textohtml, $club);
                        //$mail->Body = $shtml;
                        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
                        $mail->send();
                        $resp = true; 
                    } 
                catch (Exception $e) 
                    {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        //die();
                    }
                    return $resp;
            }
        
        private function htmlmessage($message, $club, $color)
            {
                $html = "
                <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                <html xmlns='http://www.w3.org/1999/xhtml'>
                <head>
                <!-- <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />-->
                <meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />
                <title>Sede Virtual</title>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'/>

                <style type='text/css'>
                    .boton_personalizado{
                    text-decoration: none;
                    padding: 10px;
                    font-weight: 600;
                    font-size: 20px;
                    color: #ffffff;
                    background-color: {$color};
                    border-radius: 6px;
                    border: 2px solid #F0F0F0;
                    }
                    .p {
                    font-family: sans-serif;
                    }
                </style>

                </head>
                <body style='margin: 0; padding: 0;'>

                        <table width='100%' bgcolor='#ffffff' style='border:1px solid #CCCCCC; color: #696969; border-collapse: collapse; padding:15px 10px 20px 10px; margin: 5px 0;'>
                            <tr>
                                <td width='100%' bgcolor='{$color}' style='padding: 5px; letter-spacing: -3px; color: #ffffff; font-size: 48px;'>
                                    <h2 style='font-family: sans-serif;'><b>Sede Virtual {$club}</h2>
                                </td>
                            </tr>

                            <tr>
                                <td style='padding: 15px 15px;'>
                                    {$message}
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor='#EFEFEF' style='padding: 0 0 10px 5px;'>
                                    <p>Atentamente, el equipo de administraci&oacute;n <b>de su club {$club}</b></p>
                                </td>
                            </tr>

                        </table>

                    </body>
                </html>
                ";

                return $html;
            }
        
        
        
        }

        /*
        //Server settings DIGITAR
                        
        $mail->SMTPDebug = 0;   // 2 - Enable verbose debug output  / 0 - Disabled                                   
        $mail->isSMTP(); // Set mailer to use SMTP                                           
        $mail->Host       = 'smtp.envioclubes.com.ar'; // Specify main and backup SMTP servers                      
        $mail->SMTPAuth   =  true; // Enable SMTP authentication
        $mail->Username   = 'club1@envioclubes.com.ar'; // SMTP username          
        $mail->Password   = 'PepeMoni1973-'; // SMTP password
        //$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted         
        $mail->Port       = 465; // TCP port to connect to
                                                    
        
        /*
        //Server settings GMAIL
        $mail->SMTPDebug = 0;                                       // Disable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'envioclubes@gmail.com';                // SMTP username
        $mail->Password   = 'Pass@movilsol';                        // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
        */



?>

/*
                        