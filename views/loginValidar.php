<?php
     //ob_start();
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
            //echo "loginValidar.php";
        }
    else
        {
            $user->closeCNX();
            switch ($_SESSION['SuperUsuario']) {
                case 0:
                    //  USUARIO COMUN 
                    header('Location:panel.php?panel=socio',true,301);
                    #echo "loginValidar ok.php";
                    break;
                case 1:
                    //  USUARIO ADMIN
                    header('Location:panel.php?panel=estadisticas',true,301);
                    #echo "loginValidar ok.php";
                    break;
                case 2:
                    //  USUARIO SUPERUSUARIO
                    header('Location:panel.php?panel=clientes',true,301);
                    #echo "loginValidar ok.php";
                    break;
            }
        }        
?>