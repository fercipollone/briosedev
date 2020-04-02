<?php
     ob_start();
     session_start();

    $email = htmlspecialchars($_POST["email"]); 
    $password = htmlspecialchars($_POST["password"]); 

    require_once("../models/clsUser.php");

    $user = new clsUser();
    $resultado = $user->get_Usuario($email,$password, $respuesta);
    if ($resultado == 0)
        {
            $_SESSION['RechazoLogin'] = $respuesta;
            $user->closeCNX();
            header('Location:login.php',true,301);
        }
    else
        {
            $user->closeCNX();
            //header('Location:ImportXML.php?name=' . $_SESSION['ClienteXMLFileName'],true,301);
            if ($_SESSION['SuperUsuario']==0)
                {
                    header('Location:panel.php?panel=socio',true,301);
                }
                else
                {
                    header('Location:panel.php?panel=clientes',true,301);
                }
            
        }        
?>