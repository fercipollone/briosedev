<?php 
    class clsUser
        {
            protected $db;
            protected $users;
            protected $mysqli;

            public function __construct()
                 {
                    require_once("../models/cnx.php");
                     $this->db = new cnx(); 
                     $this->mysqli = $this->db->conectar();  
                     
                 }
            
            public function closeCNX()
                 {
                    $this->mysqli->close();
                    $this->db->desconectar();
                 }
            
                 
            public function ValidarUsuarioNuevo($tipodocumento, $documentonro, $sexo, &$respuesta, $email, $clave, &$color, &$titulo)
                {
                    
                    $resultado = [];
                    //buscar si esa en la BD de algun club 
                    $resp = false;
                    $qry = "SELECT * FROM vw_sociosusuario WHERE soc_documento = {$documentonro} and soc_sexo = '{$sexo}' and tid_idtipodocumento = {$tipodocumento}";
                    
                    //echo($qry);
                    $resultado = $this->mysqli->query($qry); 

                    if ($resultado->num_rows == 0)
                        {
                            $titulo = "Atención";
                            $titulo = "<h4><i class=\"icon fa fa-ban\"></i>No se registraron las credenciales</h4>";
                            $respuesta = "Los datos ingresados no coinciden con ningun registro dentro de la base de datos, verifique el nro. de dni y el sexo estén bien";
                            $color = "alert alert-danger alert-dismissible";
                        }
                    else    
                        {
                            $socio = $resultado->fetch_assoc();
                                                       
                            switch (true) 
                            {
                                // 1 - Sin Hablitar
                                case $socio['hab_idHabilitacion'] == 1:
                                    $this->ActivarSocioUsuario($socio, $email, $clave);
                                    //$this->EnvioDeCredenciales($socio, $email, $clave);
                                    $titulo = "<h4><i class=\"icon fa fa-check\"></i>Usuario registrado, falta activación</h4>";
                                    $respuesta = "Sus datos se han registrado correctamente.<br>IMPORTANTE: Se ha enviado un email a {$email} para que pueda activar su cuenta";
                                    $resp = true;
                                    $color = "alert alert-success alert-dismissible";
                                    break;
                                // 2 - Pendiente Habilitación
                                case $socio['hab_idHabilitacion'] == 2:
                                    //$this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Proceso ya iniciado</h4>";
                                    $respuesta = "Ya se ha inciado un proceso anterior de activación, volvemos a enviar un email a {$socio['usr_Email']} para que pueda activar su cuenta";
                                    $resp = false;
                                    $color = "alert alert-warning alert-dismissible";
                                    break;
                                // 3 - Habilitado
                                case $socio['hab_idHabilitacion'] == 3:
                                    //$this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
                                    $titulo = "Cuenta ya Activa";
                                    $respuesta = "Esta intentanto activar un socio que ya se encuentra activado, enviamos sus credenciales al correo previamente registrado: {$socio['usr_Email']}";
                                    $color = "bg-warning";
                                    $resp = false;
                                    break;    
                                // Null - Sin Hablitar
                                case is_null($socio['hab_idHabilitacion']):
                                    $this->ActivarSocioUsuario($socio, $email, $clave);
                                    //$this->EnvioDeCredenciales($socio, $email, $clave);
                                    $titulo = "<h4><i class=\"icon fa fa-check\"></i>Usuario registrado, falta activación</h4>";
                                    $respuesta = "Sus datos se han registrado correctamente.<br>IMPORTANTE: Se ha enviado un email a {$email} para que pueda activar su cuenta";
                                    $color = "alert alert-success alert-dismissible";
                                    $resp = true;
                                    break;    
                                default:
                                    $resp = false;
                                    $titulo = "<h4><i class=\"icon fa fa-ban\"></i>No se registraron las credenciales</h4>";
                                    $repuesta = "No se pudieron encontrar ninguna coincidencia en los estados de la habilitacion inicial";
                                    $color = "alert alert-danger alert-dismissible";
                            }
                        }
                    
                    return $resp;
                }
            
                public function ValidarActivacion($socio_id, $cliente_id, &$titulo, &$color, &$respuesta)
                {
                    $resultado = [];
                    //buscar si esa en la BD de algun club 
                    $resp = false;
                    $qry = "SELECT * FROM vw_sociosusuario WHERE soc_idSocio = {$socio_id} and cli_idCliente = {$cliente_id}";
                    
                    //echo($qry);
                    $resultado = $this->mysqli->query($qry); 

                    if ($resultado->num_rows == 0)
                        {
                            $titulo = "Atención";
                            $titulo = "<h4><i class=\"icon fa fa-ban\"></i>No se registraron las credenciales</h4>";
                            $respuesta = "Los datos ingresados no coinciden con ningun registro dentro de la base de datos";
                            $color = "alert alert-danger alert-dismissible";
                        }
                    else    
                        {
                            $socio = $resultado->fetch_assoc();
                                                       
                            switch (true) 
                            {
                                // 1 - Sin Hablitar
                                case $socio['hab_idHabilitacion'] == 1:
                                    //$this->ActivarSocioUsuario($socio, $email, $clave);
                                    //$this->EnvioDeCredenciales($socio, $email, $clave);
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Usuario sin activación o alta</h4>";
                                    $respuesta = "Sus datos no se han registrados correctamente en el proceso de activación";
                                    $resp = false;
                                    $color = "alert alert-danger alert-dismissible";
                                    break;
                                // 2 - Pendiente Habilitación
                                case $socio['hab_idHabilitacion'] == 2:
                                    //$this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
                                    $this->HabilitarSocioUsuario($socio_id, $cliente_id);
                                    $titulo = "<h4><i class=\"icon fa fa-check\"></i>Proceso finalizado con exito !!!</h4>";
                                    $respuesta = "Muchisimas gracias. Hemos concluido el proceso de verificación de su cuenta, dirijase a la pantalla de login e ingrese sus credenciales para acceder a las sede virtual.";
                                    $resp = true;
                                    $color = "alert alert-success alert-dismissible";
                                    break;
                                // 3 - Habilitado
                                case $socio['hab_idHabilitacion'] == 3:
                                    //$this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Cuenta ya Activa</h4>";
                                    $respuesta = "Esta intentanto activar un socio que ya se encuentra habilitado para acceder, dirijase a la pantalla de login con sus credenciales";
                                    $color = "alert alert-warning alert-dismissible";
                                    $resp = false;
                                    break;    
                                // Null - Sin Hablitar
                                case is_null($socio['hab_idHabilitacion']):
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Usuario sin activación o alta</h4>";
                                    $respuesta = "Sus datos no se han registrados correctamente en el proceso de activación";
                                    $resp = false;
                                    $color = "alert alert-danger alert-dismissible";
                                    break;    
                                default:
                                    $resp = false;
                                    $titulo = "<h4><i class=\"icon fa fa-ban\"></i>No se registraron las credenciales</h4>";
                                    $repuesta = "No se pudieron encontrar ninguna coincidencia en los estados de la habilitacion inicial";
                                    $color = "alert alert-danger alert-dismissible";
                            }
                        }
                    return $resp;
                }

            public function HabilitarSocioUsuario($socio_id, $cliente_id)
                {  
                   $qry = "UPDATE usuario SET " . 
                   " hab_idHabilitacion = 3, " .
                   " usr_habilitado = now() " .
                   " WHERE " . 
                   " soc_idSocio = {$socio_id}" . 
                   " AND cli_idCliente = {$cliente_id}";
                   
                   //echo($qry);

                   $this->mysqli->query($qry);
                }

            public function EnvioDeCredenciales($socio, $email, $clave)
                {
                    /*
                    require_once("../models/clsMailer.php");
                    
                    $from = "tuclub@gmail.com";
                    
                    $subject = "Envio de creedenciales a {$socio['soc_apellidoynombre']} de {$socio['cli_nombre']}";
                    $body =  "Estimado {$socio['cli_nombre']} ¡Gracias por visitarnos y hacer su registro para nuestra sede virtual! Estamos contentos de que pueda usar esta opción de autogestión. Nuestro objetivo es que siempre esté satisfecho, y que puedas disfrutar de las instalaciones del club sin tener que pierda tiempo en la administración. ";
                    $body =  $body . "Haga clic aquí para terminar el trámite de activación:";
                    $body =  $body . "http:\\www.google.com";
                    $body =  $body . " Atentamente, El equipo de administración";

                    $mailer = new clsMailer(); 
                    if ($mailer->Enviar($from, $email, $subject, $body))
                        {
                            $resp = "Envio exitoso";
                        }  
                    else
                        {
                            $resp = "Fracaso el envio";
                        }
                    
                    return $resp;
                    */
                }
            
            public function ActivarSocioUsuario($socio, $email, $clave)
                {  
                   $qry = "INSERT INTO usuario(usr_nombre, usr_email, usr_clave, cli_idCliente, usr_superusuario, soc_idsocio, hab_idHabilitacion, usr_creado) " . 
                   " Values( " .
                   "'{$socio['soc_documento']}',".
                   "'{$email}',".
                   "'{$clave}',".
                   "{$socio['cli_idcliente']},".
                   "0,".
                   "{$socio['soc_idsocio']},".
                   "2,".
                   "now())";
                   
                   $this->mysqli->query($qry);
                }


            public function get_Usuario($username, $password, &$respuesta)
                {  
                    //Establezco la zona horaria                    
                    date_default_timezone_set('America/Argentina/Buenos_Aires');

                    //Busco por la tabla Usuario
                    $qry = "SELECT * FROM vw_usuarios WHERE usr_nombre = '{$username}' and usr_clave = '{$password}' and usr_SuperUsuario > 0";
                    $superusuario = $this->mysqli->query($qry);
                    if ($superusuario->num_rows == 0)
                        {
                            //usr_nombre es el nro de documento
                            $qry = "SELECT * FROM vw_sociosusuario WHERE usr_nombre = '{$username}' and usr_clave = '{$password}'";
                            echo($qry);
                            echo("<br>");
                            $resultado = $this->mysqli->query($qry);
                        }
                        else
                        {
                            $resultado = $superusuario;
                        }

                    if ($resultado->num_rows == 0)
                        {
                            //No hay coincidencias 
                            $respuesta = "No existen registros asociados con ese número de documento y esa clave";
                        }
                    else
                        {                            
                            $fila = $resultado->fetch_assoc();
                            //Si es estado es Habilitado pasa
                            if ($fila['hab_idHabilitacion'] == 3)
                            {    
                                //Creo la variable global para almacenar los datos de Login
                                //session_start();
                                $_SESSION['ClienteId'] = $fila['cli_idcliente'];
                                $_SESSION['ClienteNombre'] = $fila['cli_nombre'];
                                $_SESSION['ClienteLogo'] = $fila['cli_Logo'];
                                $_SESSION['ClienteXMLFileName'] = $fila['cli_XMLFileName'];
                                $_SESSION['Skin'] = $fila['cli_skin'];
                                $_SESSION['SkinCSS'] = $fila['cli_skincss'];
                                $_SESSION['ClienteFotoPath'] = $fila['cli_FotoPath'];
                                $_SESSION['UsuarioId'] = $fila['usr_idUsuario'];  
                                $_SESSION['SuperUsuario'] = $fila['usr_SuperUsuario'];
                                $_SESSION['SocioId'] = $fila['soc_idsocio'];
                                $_SESSION['SocioNombre'] = $fila['soc_apellidoynombre'];
                                $_SESSION['UsuarioNombre'] = $fila['usr_Nombre'];
                                $_SESSION['Login'] = false;

                                echo $_SESSION['UsuarioNombre'];

                                switch ($fila['usr_SuperUsuario']) {
                                    case 0:
                                        $_SESSION['TipoUsuario'] = 'Socio' ;
                                        break;
                                    case 1:
                                        $_SESSION['TipoUsuario'] = 'Admin' ;
                                        break;
                                    case 2:
                                        $_SESSION['TipoUsuario'] = 'SuperUsuario' ;
                                        break;
                                } 
                                 
                                $resp = 1;
                            }
                            else
                            {
                                //El estado NO es Habilitado 
                                $respuesta = "Su usuario no esta habilitado aún para operar, le enviamos un pedido de confirmación a este email a {$fila['usr_Email']} ";
                            }
                        }
                    $resultado->free();
                    $this->closeCNX();

                    return $resp;
                }
            


            public function get_Usuarios()
                {
                   $qry = "SELECT * FROM vw_usuarios ORDER BY cli_Nombre";
                   $resultado = $this->mysqli->query($qry);  
                   return $resultado;
                }
         }

?>      