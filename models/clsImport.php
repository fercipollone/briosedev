<?php 

    class clsImport
        {
            protected $db;
            protected $mysqli;

            public function __construct()
                 {
                     require_once("../models/cnx.php");
                     $this->db = new cnx(); 
                     $this->mysqli = $this->db->conectar();  
                 }
                
            public function closeCNX()
                 {
                    $this->db->desconectar();
                    $this->mysqli->close();   
                 }
            
                 public function import_Socios($filename, &$inserts)
                {  
                    
                    set_time_limit(1500);
                    //$file = $_GET['name'];

                    //$xml_file = "xml/" . $filename;
                    $xml_file = "C:\\Inetpub\\vhosts\\softwareclubes.com.ar\\cgi-bin\\xml\\" . $filename;

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
                    foreach ($xml->Socio as $socio) 
                    {
                        
                        //echo "Valor del count: " . $count; 

                        if ($count==0)
                        {
                        $qry = "DELETE FROM socio WHERE cli_idCliente = " . $socio->cli_IdCliente;
                        $resultado = $this->mysqli->query($qry);
                        
                        //echo "Eliminación para actualización: " . $resultado;
                        //echo "</br>";
                        //echo $qry;
                        //echo "</br>";
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
                            ecm_HabilitaAcceso)".
                        " VALUES ($socio->soc_idsocio, ".
                        "$socio->cli_IdCliente,".
                        "$socio->soc_nrosocio, ".
                        "'$socio->soc_apellidoynombre', ".
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
                        "$HabilitaAcceso".
                        ")";
                        
                        //echo "Ahora ejecutamos el INSERT en la BD";     
                        //echo "</br>";    
                        //echo $qry; 
                        
                        if (!$this->mysqli->query($qry))
                        {
                            $err++;
                        };
                        //echo $resultado;
                        //echo $socio->soc_nrosocio;
                        //echo "</br>";
                        //echo $socio->soc_apellidoynombre;
                        //echo "</br>";
                        //sleep(1);
                        //echo "Cantidad" . $count; 
                        //echo "</br>";

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

                    //$xml_file = "xml/" .  $filename;
                    $xml_file = "C:\\Inetpub\\vhosts\\softwareclubes.com.ar\\cgi-bin\\xml\\" . $filename;

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
                    foreach ($xml->ActividadSocio as $actividad) 
                    {
                      
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
                        
                        //echo "Ahora ejecutamos el INSERT en la BD";     
                        //echo "</br>";    
                        //echo $qry; 
                        
                        if (!$this->mysqli->query($qry))
                        {
                            $err++;
                        };
                        //echo $resultado;
                        //echo $socio->soc_nrosocio;
                        //echo "</br>";
                        //echo $socio->soc_apellidoynombre;
                        //echo "</br>";
                        //sleep(1);
                        //echo "Cantidad" . $count; 
                        //echo "</br>";

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
            
            public function import_Pines($filename, &$inserts)
                {  
                    
                    set_time_limit(1500);
                    $filename = "PIN" . $filename;

                    //$xml_file = "xml/" .  $filename;
                    $xml_file = "C:\\Inetpub\\vhosts\\softwareclubes.com.ar\\cgi-bin\\xml\\" . $filename;

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
            
            }
?>      