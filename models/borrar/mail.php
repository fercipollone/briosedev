<?php

    $headers =  'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'From: Fernando <fercipollone@gmail.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
    $to = "fernando@movilsol.net";
    $subject = "test email";
    $body = "envio de email prueba";
    mail($to,$subject,$body,$headers);

    echo "Email enviado";

?>