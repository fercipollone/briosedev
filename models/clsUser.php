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
                                    $this->EnvioBotonDeActivacion($socio, $email);
                                    $titulo = "<h4><i class=\"icon fa fa-check\"></i>Usuario registrado, falta activación</h4>";
                                    $respuesta = "Sus datos se han registrado correctamente.<br>IMPORTANTE: Se ha enviado un email a {$email} para que pueda activar su cuenta";
                                    $resp = true;
                                    $color = "alert alert-success alert-dismissible";
                                    break;
                                // 2 - Pendiente Habilitación
                                case $socio['hab_idHabilitacion'] == 2:
                                    $this->EnvioBotonDeActivacion($socio, $socio['usr_Email']);
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Proceso ya iniciado</h4>";
                                    $respuesta = "Ya se ha inciado un proceso anterior de activación, volvemos a enviar un email a {$socio['usr_Email']} para que pueda activar su cuenta";
                                    $resp = false;
                                    $color = "alert alert-warning alert-dismissible";
                                    break;
                                // 3 - Habilitado
                                case $socio['hab_idHabilitacion'] == 3:
                                    $this->EnvioDeCredenciales($socio, $socio['usr_Email'], $socio['usr_Clave']);
                                    $titulo = "Cuenta ya Activa";
                                    $respuesta = "Esta intentanto activar un socio que ya se encuentra activado, enviamos sus credenciales al correo previamente registrado: {$socio['usr_Email']}";
                                    $color = "bg-warning";
                                    $resp = false;
                                    break;    
                                // Null - Sin Hablitar
                                case is_null($socio['hab_idHabilitacion']):
                                    $this->ActivarSocioUsuario($socio, $email, $clave);
                                    $this->EnvioBotonDeActivacion($socio, $email);
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
                            $clave = $socio['usr_Clave'];
                                                       
                            switch (true) 
                            {
                                // 1 - Sin Hablitar
                                case $socio['hab_idHabilitacion'] == 1:
                                    $titulo = "<h4><i class=\"icon fa fa-warning\"></i>Usuario sin activación o alta</h4>";
                                    $respuesta = "Sus datos no se han registrados correctamente en el proceso de activación";
                                    $resp = false;
                                    $color = "alert alert-danger alert-dismissible";
                                    break;
                                // 2 - Pendiente Habilitación
                                case $socio['hab_idHabilitacion'] == 2:
                                    $this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
                                    $this->HabilitarSocioUsuario($socio_id, $cliente_id);
                                    $titulo = "<h4><i class=\"icon fa fa-check\"></i>Proceso finalizado con exito !!!</h4>";
                                    $respuesta = "Muchisimas gracias. Hemos concluido el proceso de verificación de su cuenta, dirijase a la pantalla de login e ingrese sus credenciales para acceder a las sede virtual.";
                                    $resp = true;
                                    $color = "alert alert-success alert-dismissible";
                                    break;
                                // 3 - Habilitado
                                case $socio['hab_idHabilitacion'] == 3:
                                    $this->EnvioDeCredenciales($socio, $socio['usr_Email'], $clave);
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

            public function EnvioBotonDeActivacion($socio, $email)
                {
                    require_once("../models/clsMailer.php");
                    
                    $from = $socio['cli_email'];
                    
                    $subject = "Activación de creedenciales a {$socio['soc_apellidoynombre']} de {$socio['cli_nombre']}";
                    $body = "
                            <p>Hola <b>{$socio['soc_apellidoynombre']}</b></p>
                            <p>Gracias por visitarnos y hacer su registro para nuestra sede virtual</p>
                            <p>Estamos felices de que pueda usar esta opci&oacute;n de autogesti&oacute;n. Nuestro objetivo es que siempre est&eacute; satisfecho, y que puedas disfrutar de las instalaciones del club sin tener que perder tiempo en la administraci&oacute;n.</p>
                            <p>Haga clic aqu&iacute; para terminar el tr&aacute;mite de activaci&oacute;n:</p>  
                            <p style='text-align: center;'><br>
                                <a class='boton_personalizado' href='http://www.softwareclubes.com.ar/briosedev/views/loginhabilitar.php?socio_id={$socio['soc_idsocio']}&cliente_id={$socio['cli_idcliente']}'>Activar la cuenta</a>
                            </p>
                            ";

                    $mailer = new clsMailer(); 
                    if ($mailer->Enviar($from, $email, $subject, $body, $socio['cli_nombre'], $socio['cli_email'], $socio['cli_emailcolor']))
                        {
                            $resp = "Envio exitoso";
                        }  
                    else
                        {
                            $resp = "Fracaso el envio";
                        }
                    
                    return $resp;
                }
            
            public function EnvioDeCredenciales($socio, $email, $clave)
                {
                    require_once("../models/clsMailer.php");
                    
                    $from = $socio['cli_email'];
                    
                    $subject = "Envio de creedenciales a {$socio['soc_apellidoynombre']} de {$socio['cli_nombre']}";
                    $body = "
                            <p>Hola <b>{$socio['soc_apellidoynombre']}</b></p>
                            <p>Gracias por visitarnos a nuestra sede virtual.</p> 
                            <p>Estamos felices de que pueda usar esta opci&oacute;n de autogesti&oacute;n. Nuestro objetivo es que siempre est&eacute; satisfecho, y que puedas disfrutar de las instalaciones del club sin tener que perder tiempo en la administraci&oacute;n.</p>
                            <p>Sus credenciales de acceso son las siguientes:</p>  
                            <p>
                                Usuario: {$socio['usr_Nombre']}<br>
                                Clave: {$clave}
                            </p>

                            <p style='text-align: center;'>
                                <br>
                                <a class='boton_personalizado' href='http://www.softwareclubes.com.ar/briosedev/'>
                                Acceder 
                                </a>
                            </p>
                            ";

                    $mailer = new clsMailer(); 
                    if ($mailer->Enviar($from, $email, $subject, $body, $socio['cli_nombre'], $socio['cli_email'], $socio['cli_emailcolor']))
                        {
                            $resp = "Envio exitoso";
                        }  
                    else
                        {
                            $resp = "Fracaso el envio";
                        }
                    
                    return $resp;
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
                    //date_default_timezone_set('America/Argentina/Buenos_Aires');

                    //Busco por la tabla Usuario
                    $qry = "SELECT * FROM vw_usuarios WHERE usr_nombre = '{$username}' and usr_clave = '{$password}' and usr_SuperUsuario > 0 and usr_nombre is not null";
                    //echo($qry);
                    $superusuario = $this->mysqli->query($qry);
                    if ($superusuario->num_rows == 0)
                        {
                            //usr_nombre es el nro de documento
                            $qry = "SELECT * FROM vw_sociosusuario WHERE usr_nombre = '{$username}' and usr_clave = '{$password}'";
                            $resultado = $this->mysqli->query($qry);
                        }
                        else
                        {
                            $resultado = $superusuario;
                        }

                    if ($resultado->num_rows == 0)
                        {
                            //No hay coincidencias 
                            $respuesta = "No existen registros asociados con ese número de documento y esa clave.";
                        }
                    else
                        {                            
                            $fila = $resultado->fetch_assoc();
                            //Si es estado es Habilitado pasa
                            if ($fila['hab_idHabilitacion'] == 3)
                            {    
                                //session_start();
                                $this->loadsession($fila);  
                                $resp = 1;
                            }
                            else
                            {
                                //El estado NO es Habilitado 
                                $this->EnvioBotonDeActivacion($fila, $fila['usr_Email']);
                                $respuesta = "Su usuario no esta habilitado aún para operar, le enviamos un pedido de confirmación a este email a {$fila['usr_Email']} ";
                            }
                        }
                    //$resultado->free();
                    $this->closeCNX();

                    return $resp;
                }
            
            public function reloadsession($idpago)
                {
                    #Busco los datos del socio mediante el id de pago 
                    $qry = "SELECT * FROM pagos WHERE pag_idpago = {$idpago}";
                    $resultado = $this->mysqli->query($qry);
                    $datos = $resultado->fetch_assoc();


                    $qry = "SELECT * FROM vw_sociosusuario WHERE soc_idsocio = {$datos['soc_idsocio']} and cli_idcliente = {$datos['cli_idcliente']}";
                    $resultado->free();

                    $rs = $this->mysqli->query($qry);
                    $fila = $rs->fetch_assoc();

                    $this->loadsession($fila);
                    
                    $rs->free();
                    $this->closeCNX();
                }

            public function loadsession($fila)
                {
                    //Creo la variable global para almacenar los datos de Login
                    //session_start();
                    $_SESSION['ClienteId'] = $fila['cli_idcliente'];
                    $_SESSION['ClienteNombre'] = $fila['cli_nombre'];
                    $_SESSION['ClienteLogo'] = $fila['cli_Logo'];
                    $_SESSION['ClienteMPSandbox'] = $fila['cli_mp_sandbox'];
                    $_SESSION['ClienteMPPublicKey'] = $fila['cli_mp_publickey'];
                    $_SESSION['ClienteMPAccessToken'] = $fila['cli_mp_accesstoken'];
                    $_SESSION['ClienteXMLFileName'] = $fila['cli_XMLFileName'];
                    $_SESSION['Skin'] = $fila['cli_skin'];
                    $_SESSION['SkinCSS'] = $fila['cli_skincss'];
                    $_SESSION['ClienteFotoPath'] = $fila['cli_FotoPath'];
                    $_SESSION['UsuarioId'] = $fila['usr_idUsuario'];  
                    $_SESSION['SuperUsuario'] = $fila['usr_SuperUsuario'];
                    $_SESSION['SocioId'] = $fila['soc_idsocio'];
                    $_SESSION['SocioNombre'] = $fila['soc_apellidoynombre'];
                    $_SESSION['UsuarioNombre'] = $fila['usr_Nombre'];
                    $_SESSION['ClienteWA'] = $this->urlwhatsapp($fila['soc_apellidoynombre'],$fila['cli_celularwa']);
                    $_SESSION['MenuComunicacionSocio'] = $this->menucomunicacion($fila['cli_idcliente']);
                                                                        
                    switch ($fila['usr_SuperUsuario']) {
                        case 0:
                            $_SESSION['TipoUsuario'] = 'Socio' ;
                                switch ($fila['tso_idtiposocio']) {
                                    //Socio Unico
                                    case 1:
                                        $_SESSION['Cuotas_Socio_id'] = $fila['soc_idsocio'];
                                        break;
                                    //Miembro 
                                    case 2:
                                        $_SESSION['Cuotas_Socio_id'] = $fila['soc_idsociotitular'];
                                        break;
                                    //Titular
                                    case 3:
                                        $_SESSION['Cuotas_Socio_id'] = $fila['soc_idsocio'];
                                        break;
                                }
                            break;
                        case 1:
                            $_SESSION['TipoUsuario'] = 'Admin' ;
                            break;
                        case 2:
                            $_SESSION['TipoUsuario'] = 'SuperUsuario' ;
                            break;
                    } 
                }
            
            public function urlwhatsapp($nombre, $celular)
                {
                    
                    $nombre = str_replace(' ', '%20', $nombre);
                    $text = "Hola%20soy%20".$nombre."%20me%20pueden%20asistir%20con%20la%20sede%20virtual.%20Muchas%20gracias.";
                    return "https://wa.me/".$celular."?text=".$text;
                }
            
            public function menucomunicacion($cliente_id)
                {
                    $menu = "";
                    $qry = "SELECT * FROM vw_comunicacion WHERE cliente_id = {$cliente_id}";
                    $resultado = $this->mysqli->query($qry);

                    if ($resultado->num_rows == 0)
                        {
                          return $menu; 
                        }
                    else    
                        {
                            $menu = '<li class="treeview">';
                            $menu .= '<a href="#"><i class="fa fa-volume-up"></i> <span>Comunicación</span>';
                            $menu .= '<span class="pull-right-container">';
                            $menu .= '<i class="fa fa-angle-left pull-right"></i>';
                            $menu .= '</span>';
                            $menu .= '</a>';
                            $menu .= '<ul class="treeview-menu">';

                            while ($medio = $resultado->fetch_assoc())
                                {
                                    $menu .= '<li>';
                                    if ($medio['valor']=='#')
                                        {
                                            $menu .= '<a href="'.$medio['valor'].'">';
                                        }
                                    else
                                        {
                                            $menu .= '<a href="'.$medio['valor'].'" target="_blank">';   
                                        }
                                    $menu .= '<i class="'.$medio['icono'].'"></i>'.$medio['etiqueta'];
                                    $menu .= '</a>';
                                    $menu .= '</li>';
                                }

                            $menu .= '</ul></li>';
                            return $menu; 
                        }
                }

            public function get_Usuarios()
                {
                   $qry = "SELECT * FROM vw_usuarios ORDER BY cli_Nombre";
                   $resultado = $this->mysqli->query($qry);  
                   return $resultado;
                }
            
            public function get_UsuariosClientes($cliente_id)
                {
                   $qry = "SELECT * FROM vw_usuarios WHERE cli_idCliente = {$cliente_id} ORDER BY cli_Nombre";
                   $resultado = $this->mysqli->query($qry);  
                   return $resultado;
                }
         
            public function ValidarEmail($email, &$titulo, &$color, &$respuesta)
                {
                    $resultado = [];
                    //buscar si esa en la BD de algun club 
                    $resp = false;
                    $qry = "SELECT * FROM vw_sociosusuario WHERE usr_Email = '{$email}'";
                    
                    //echo($qry);
                    $resultado = $this->mysqli->query($qry); 

                    if ($resultado->num_rows == 0)
                        {
                            $titulo = "Atención";
                            $titulo = "<h4><i class=\"icon fa fa-ban\"></i>No hay coincidencias</h4>";
                            $respuesta = "No existe ningún email {$email} en nuestra base de datos";
                            $color = "alert alert-danger alert-dismissible";
                        }
                    else    
                        {
                            while ($socio = $resultado->fetch_assoc())
                            {
                                $this->EnvioDeCredenciales($socio, $socio['usr_Email'], $socio['usr_Clave']);
                            }
                            
                            $titulo = "<h4><i class=\"icon fa fa-check\"></i>Proceso finalizado con exito !!!</h4>";
                            $respuesta = "Sus credenciales han sido enviadas a su casilla de correo {$socio['usr_Email']}. Muchisimas gracias";
                            $resp = true;
                            $color = "alert alert-success alert-dismissible";
                        }
                    return $resp;
                } 

            public function CambiarClave($usuario_id, $clave, $clavenueva)
                {
                    $qry = "SELECT * FROM vw_sociosusuario WHERE usr_idUsuario = {$usuario_id} AND usr_Clave = '{$clave}'";
                    $resultado = $this->mysqli->query($qry); 
                    if ($resultado->num_rows == 0)
                        {
                            $resultado->free;
                            return false;
                        }
                    else    
                        {
                            $qry = "UPDATE usuario SET usr_Clave = '{$clavenueva}' WHERE usr_idUsuario = {$usuario_id}";
                            $this->mysqli->query($qry); 
                            return true;
                        }
                }
            
            public function get_UsuarioSocio($cliente_id, $socio_id)
                {  
                    $qry = "SELECT soc_apellidoynombre, soc_documento, soc_sexo, tid_idtipodocumento, usr_Nombre, usr_Clave, usr_Email, hab_nombre FROM vw_sociosusuario WHERE cli_idCliente = {$cliente_id} AND soc_idsocio = {$socio_id}";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }
            public function cambiaremail($email, $cliente_id, $socio_id, &$respuesta)
                {
                    $qry = "UPDATE usuario SET " . 
                    " usr_email = '{$email}'" .
                    " WHERE " . 
                    " soc_idSocio = {$socio_id}" . 
                    " AND cli_idCliente = {$cliente_id}";

                    try 
                        {
                            $this->mysqli->query($qry);

                            $respuesta = "<div class='alert alert-success alert-dismissible'>";
                            $respuesta .= "<br>";
                            $respuesta .= "<h4><i class=\"icon fa fa-check\"></i>Proceso exitoso</h4>";
                            $respuesta .= "Los datos se han almacenado exitosamente";
                            $respuesta .= "<br>";
                            $respuesta .= "<a href='panel.php?panel=list&i=usu'>Volver al listado</a>";
                            $respuesta .= "<br>&nbsp;";
                            $respuesta .= "</div>";
                        } 
                    catch (Throwable $e) 
                        {
                            $respuesta = "<div class='alert alert-danger alert-dismissible'>";
                            $respuesta .= "<br>";
                            $respuesta .= "<h4><i class=\"icon fa fa-ban\"></i>Se ha producido un error</h4>";
                            $respuesta .= "Algo fallo no pudimos grabar los cambios ".$e;
                            $respuesta .= "<br>&nbsp;";
                            $respuesta .= "</div>";
                        }
                }
        }

?>      