<?php 

    class clsImport
        {
            protected $db;
            protected $mysqli;
            protected $path;

            public function __construct()
                 {
                     require_once("../models/cnx.php");
                     $this->db = new cnx(); 
                     $this->mysqli = $this->db->conectar();  
                     $this->path = "xml/";
                    //$this->path = "C:\\Inetpub\\vhosts\\softwareclubes.com.ar\\cgi-bin\\xml\\";
                 }
                
            public function closeCNX()
                 {
                    $this->db->desconectar();
                    $this->mysqli->close();   
                 }
            
            public function import_Socios($filename, &$inserts)
                 {  
                    
                    set_time_limit(3000);
                    //$file = $_GET['name'];
                    $this->flushN();

                    $xml_file = $this->path . $filename;
                    
                    if (file_exists($xml_file)) 
                    {
                        $xml = simplexml_load_file($xml_file);
                    } 
                    else 
                    {
                        exit('Error al intentar abrir el fichero '.$xml_file);
                    }
                    
                    $this->flushN();
                    /* Recorremos el XML */ 
                    $count=0; 
                    $err = 0;
                    $total = $xml->count();
                    foreach ($xml->Socio as $socio) 
                    {
                        $percent = round($count/$total*100,2)."%";
                        $multiplo10 = $count % 10;

                        if ($multiplo10 == 0)
                            {
                                $this->refreshPG($count,$percent,$total,$percent);   
                            }
                        
                        if ($count==0)
                        {
                            $qry = "DELETE FROM socio WHERE cli_idCliente = " . $socio->cli_IdCliente;
                            $resultado = $this->mysqli->query($qry);
                        }
                        
                        // Verifica si no viene ningún valor en la fecha del AptoMedico
                        if ($socio->soc_fechaAptoMedico == "")
                        {
                            $FechaAptoMedico = "NULL"; 
                        }
                        else
                        {
                            $FechaAptoMedico = "'" . $socio->soc_fechaAptoMedico . "'";
                        }

                        // Verifica si no viene ningún valor en la habilitacion     
                        $HabilitaAcceso = $socio->ecm_HabilitaAcceso;
                        if ($HabilitaAcceso == "")
                        {
                            $HabilitaAcceso = "NULL"; 
                        }

                        $soc_idsociotitular = $socio->soc_idsociotitular;
                        if ($soc_idsociotitular == "")
                        {
                            $soc_idsociotitular = "NULL"; 
                        }
                        
                        //eliminar las comillas simples
                        $apellidonombre = str_replace("'","",$socio->soc_apellidoynombre);

                        // ARMA EL SQL 
                        $qry = "INSERT INTO socio ".
                        "(soc_idSocio,
                            cli_idCliente,
                            soc_nrosocio,
                            soc_apellidoynombre,
                            soc_documento,
                            soc_edad,
                            cat_descripcion,
                            ses_descripcion,
                            soc_fechatopehabilitacion,
                            soc_foto,
                            soc_pin,
                            soc_accesos,
                            soc_fechanac,
                            soc_domicilio,
                            soc_fechaalta,
                            soc_ultimaact,
                            soc_ultimoperiodopago,
                            soc_fechaAptoMedico,
                            ecm_Descripcion,
                            ecm_HabilitaAcceso,
                            soc_sexo,
                            tid_idTipoDocumento,
                            tso_idtiposocio,
                            soc_idsociotitular)".
                        " VALUES ($socio->soc_idsocio, ".
                        "$socio->cli_IdCliente,".
                        "$socio->soc_nrosocio, ".
                        "'$apellidonombre', ".
                        "$socio->soc_documento, ".
                        "$socio->soc_Edad, ".
                        "'$socio->cat_descripcion', ".
                        "'$socio->ses_descripcion', ".
                        "'$socio->soc_fechatopehabilitacion', ".
                        "'$socio->soc_foto', ".
                        "'$socio->soc_pin', ".
                        "'$socio->soc_accesos', ".
                        "'$socio->soc_fechanac', ".
                        "'$socio->soc_domicilio', ".
                        "'$socio->soc_fechaalta',".
                        "'$socio->FechaAct',".
                        "'$socio->soc_ultimoperiodopago',".
                        "$FechaAptoMedico,".
                        "'$socio->ecm_Descripcion',".
                        "$HabilitaAcceso,".
                        "'$socio->soc_sexo',".
                        "$socio->tid_idTipoDocumento,".
                        "$socio->tso_idtiposocio,".
                        "$soc_idsociotitular".
                        ")";
                        
                        //echo "Ahora ejecutamos el INSERT en la BD";     
                        //echo "</br>";    
                        //echo $qry . "\n\n";
                        
                        if (!$this->mysqli->query($qry))
                        {
                            $err++;
                            echo $this->mysqli->error . "\n";
                            echo $qry . "\n\n"; 
                        };

                    // Incrementamos 
                        $count++;
                    }
                    
                    echo "-------------------------------------------</br>";
                    echo " SOCIOS </br> ";
                    echo "-------------------------------------------</br>";
                    echo "Total de socios importados: $count </br>";
                    echo "Total de errores: $err </br>";
                    echo "------------------------------------------- </br>";
                                        
                    $inserts = $count - $err;
                    return $err;
                }

            
            public function import_ActividadesSocios($filename, &$inserts)
                {  
                    set_time_limit(1500);
                    $filename = "ACT" . $filename;

                    $xml_file = $this->path . $filename;
                    
                    if (file_exists($xml_file)) 
                    {
                        $xml = simplexml_load_file($xml_file);
                    } 
                    else 
                    {
                        exit('Error al intentar abrir el fichero '.$xml_file);
                    }

                    /* Recorremos el XML */ 
                    $total = $xml->count();
                    $count=0; 
                    $err = 0;
                    foreach ($xml->ActividadSocio as $actividad) 
                        {
                        $percent = round($count/$total*100,2)."%";
                        $multiplo10 = $count % 10;

                        if ($multiplo10 == 0)
                            {
                                $this->refreshPG($count,$percent,$total,$percent);   
                            }
                        
                        if ($count==0)
                        {
                            $qry = "DELETE FROM actividades WHERE cli_idCliente = " . $actividad->cfg_idCliente;
                            $resultado = $this->mysqli->query($qry);
                            //echo $qry;
                            //echo "</br>";
                        }
                        
                        $qry = "INSERT INTO actividades ".
                            "(soc_idSocio,
                            cli_idCliente,
                            act_nombre,
                            act_ultimoperiodopago,
                            act_ultimaact)".
                            " VALUES ($actividad->soc_idsocio, ".
                            "$actividad->cfg_idCliente,".
                            "'$actividad->Actividad', ".
                            "'$actividad->UltimoPeriodoPago', ".
                            "'$actividad->FechaAct' ".
                            ")";
                            
                        if (!$this->mysqli->query($qry))
                        {
                            $err++;
                            echo $this->mysqli->error . "\n";
                        };
                        
                        // Incrementamos 
                        $count++;
                    }
                    
                    echo "-------------------------------------------</br>";
                    echo " ACTIVIDADES POR SOCIOS </br> ";
                    echo "-------------------------------------------</br>";
                    echo "Total de Actividades importadas: $count </br>";
                    echo "Total de errores: $err  </br>";
                    echo "------------------------------------------- </br>";
                                        
                    $inserts = $count - $err;
                    return $err;
                }

            public function import_Cuotas($filename)
                {  
                    set_time_limit(1500);
                    
                    if (!(file_exists($filename))) 
                    {
                        exit('Error al intentar abrir el fichero '.$filename);
                    }
                    
                    //Eliminar los pendientes para ese cliente id 
                    $qry = "DELETE FROM cuotas WHERE cli_idCliente = " . $_SESSION['ClienteId'] . " AND cso_estado = 1";                
                    if (!$this->mysqli->query($qry))
                                {
                                    echo $this->mysqli->error . "\n";
                                    echo "<br>";
                                    echo $qry;
                                    echo "<br>";
                                };
                    
                    //Eliminar los pagos pendientes que no se cerraron 
                    $qry = "DELETE FROM pago WHERE cli_idCliente = " . $_SESSION['ClienteId'] . " AND pag_estado = 0";
                    if (!$this->mysqli->query($qry))
                                {
                                    echo $this->mysqli->error . "\n";
                                    echo "<br>";
                                    echo $qry;
                                    echo "<br>";
                                };

                    //Abrir el archivo
                    $archivo = fopen($filename, "r");
                    $lineas = 0;
                    $Cliente_id = $_SESSION['ClienteId'];
                    //----------------------------------------------------------------
                    //Contamos las lineas a procesar
                    while (($datos = fgetcsv($archivo, ",")) == true) 
                        {
                            $lineas++;
                        }
                    //Cerramos el archivo
                    fclose($archivo);
                    //----------------------------------------------------------------
                    //Abrir el archivo
                    $archivo = fopen($filename, "r");
                    mb_convert_encoding($archivo, 'ISO-8859-1', 'UTF-8');
                    $total = $lineas;
                    $err = 0;
                    $linea = 0;
                    //----------------------------------------------------------------
                    //Procesamiento de archivos
                    while (($datos = fgetcsv($archivo, ",")) == true) 
                        {
                            $linea++;

                            $percent = round($linea/$total*100,2)."%";
                            $multiplo10 = $linea % 10;

                            if ($multiplo10 == 0)
                            {
                                $this->refreshPG($linea,$percent,$total,$percent);   
                            }
                            
                            $socio = utf8_encode($datos[5]); 
                            $cuotadesc = utf8_encode($datos[3]); 
                                                        
                            $qry = "INSERT INTO cuotas 
                            (cso_idcuotadetalle,
                            cli_idcliente,
                            soc_idsocio,
                            cso_descripcion,
                            cso_periodo,
                            cso_socio,
                            cso_importe,
                            cso_estado,
                            cso_actualizacion,
                            cso_fechavenc,
                            cso_idbancocabecera
                            )
                            VALUES 
                            ($datos[0],
                            $Cliente_id,
                            $datos[2],
                            '$cuotadesc',
                            '$datos[4]',
                            '$socio',
                            $datos[6],
                            $datos[7],
                            now(),
                            $datos[8],
                            $datos[9])";
                            
                            if (!$this->mysqli->query($qry))
                                {
                                    $err++;
                                    echo $this->mysqli->error . "\n";
                                    echo "<br>";
                                    echo $qry;
                                    echo "<br>";
                                };
                            
                        }
                    //Cerramos el archivo
                    fclose($archivo);
                                        
                    echo "-------------------------------------------</br>";
                    echo " CUOTAS IMPORTADAS </br> ";
                    echo "-------------------------------------------</br>";
                    echo "Total de Actividades importadas: $linea </br>";
                    echo "Total de errores: $err  </br>";
                    echo "------------------------------------------- </br>";
                                        
                    $inserts = $count - $err;
                    return $err;
                }
            
            public function import_Pines($filename, &$inserts)
                {  
                    
                    set_time_limit(1500);
                    $filename = "PIN" . $filename;
                    $xml_file = $this->path . $filename;

                    if (file_exists($xml_file)) 
                    {
                        $xml = simplexml_load_file($xml_file);
                    } 
                    else 
                    {
                        exit('Error al intentar abrir el fichero '.$xml_file);
                    }

                    /* Recorremos el XML */ 
                    $count=0; 
                    $err = 0;
                    foreach ($xml->PinesSocio as $pines) 
                    {
                      
                      if ($count==0)
                      {
                        $qry = "DELETE FROM pines WHERE cli_idCliente = " . $pines->cfg_idCliente;
                        $resultado = $this->mysqli->query($qry);
                      }
                      
                      
                      $qry = "INSERT INTO pines ".
                        "(soc_idSocio,
                          cli_idCliente,
                          pin_pin,
                          pin_ultimaact)".
                        " VALUES ($pines->soc_idsocio, ".
                        "$pines->cfg_idCliente,".
                        "'$pines->Pin', ".
                        "'$pines->FechaAct' ".
                        ")";
                        
                        if (!$this->mysqli->query($qry))
                        {
                            $err++;
                            echo $this->mysqli->error . "\n";
                        };

                    // Incrementamos 
                        $count++;
                    }
                    
                    echo "-------------------------------------------</br>";
                    echo " PINES POR SOCIOS </br> ";
                    echo "-------------------------------------------</br>";
                    echo "Total de Pines importados: $count </br>";
                    echo "Total de errores: $err  </br>";
                    echo "------------------------------------------- </br>";
                                        
                    $inserts = $count - $err;
                    return $err;
                }
            
            private function refreshPG($i, $percent,$total)
                {
                    // Javascript for updating the progress bar and information
                    echo '<script language="javascript">
                    document.getElementById("progress").innerHTML="<div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" style=\"width:'.$percent.';background-color:#2DB5FF;\">&nbsp;</div>";
                    document.getElementById("information").innerHTML="'.$i.' / '.$total.' filas ('.$percent.') procesadas.";
                    </script>';
                    $this->flushN();
                }

            private function flushN()
                {
                    // This is for the buffer achieve the minimum size in order to flush data
                    echo str_repeat(' ',1024*64);
                    // Send output to browser immediately
                    flush();
                    // Sleep one second so we can see the delay
                    //sleep(1);
                }


        }
?>      