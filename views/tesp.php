<?php
    
    require_once("../models/clsMailer.php");
                        
    $from = "tuclub@gmail.com";
    $email = "fercipollone@gmail.com";
    $subject = "Envio de creedenciales a tu direccion";
    $body =  "Estimado PEPE ¡Gracias por visitarnos y hacer su registro para nuestra sede virtual! Estamos contentos de que pueda usar esta opción de autogestión. Nuestro objetivo es que siempre esté satisfecho, y que puedas disfrutar de las instalaciones del club sin tener que pierda tiempo en la administración. ";
    $body =  $body . "Haga clic aquí para terminar el trámite de activación:";
    $body =  $body . "http:\\www.google.com";
    $body =  $body . " Atentamente, El equipo de administración";
    $club = "prueba";
    $color = "#F0F0F0";
    
    $mailer = new clsMailer(); 
    $resp = $mailer->Enviar($from, $email, $subject, $body, $club);
    echo "Ya envio";
    if ($resp)
        {
            $resp = "Envio exitoso";
        }  
    else
        {
            $resp = "Fracaso el envio";
        }
    
    echo $resp;
    
    echo "fernando";

?>