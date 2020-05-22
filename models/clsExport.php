<?php 

    class clsExport
        {
            //protected $db;
            //protected $mysqli;
            protected $path;

            public function __construct()
                 {
                     //require_once("../models/cnx.php");
                     //$this->db = new cnx(); 
                     //$this->mysqli = $this->db->conectar();  
                     $this->path = "export/";
                    //$this->path = "C:\\Inetpub\\vhosts\\softwareclubes.com.ar\\cgi-bin\\xml\\";
                 }
                
            public function closeCNX()
                 {
                    //$this->mysqli->close();
                    //$this->db->desconectar();
                 }
            
            public function export_pagos($periodo)
                 {  
                    set_time_limit(3000);
                    $this->flushN();

                    $filename = $this->path.$_SESSION['ClienteNombre'].$periodo.'.csv';
                    
                    if (file_exists($filename)) 
                    {
                        unlink($filename);
                    } 
                    
                    $file = fopen($filename, "w");

                    require_once("../models/clsCuota.php");
                    $cuotas = new clsCuota();
                    $pagos = $cuotas->PagosxPeriodo($_SESSION['ClienteId'],$periodo,$total);    
                                        
                    $this->flushN();
                    
                    $count=0; 
                    $err = 0;
                    while ($pago = $pagos->fetch_assoc()) 
                    {
                        $percent = round($count/$total*100,2)."%";
                        $multiplo10 = $count % 10;

                        if ($multiplo10 == 0)
                            {
                                $this->refreshPG($count,$percent,$total,$percent);   
                            }
                        
                        $sep = ";";
                        $linea = $pago['periodopago'].$sep;
                        $linea = $linea . $pago['socio_id'].$sep;
                        $linea = $linea . $pago['fechapago'].$sep;
                        $linea = $linea . $pago['mercadopago_id'].$sep;
                        $linea = $linea . $pago['estadopago_id'].$sep;
                        $linea = $linea . $pago['estaodopago'].$sep;
                        $linea = $linea . $pago['cliente_id'].$sep;
                        $linea = $linea . $pago['cuotadetalle_id'].$sep;
                        $linea = $linea . $pago['descripcion'].$sep;
                        $linea = $linea . $pago['periodo'].$sep;
                        $linea = $linea . $pago['socio'].$sep;
                        $linea = $linea . $pago['importe'].$sep;
                        $linea = $linea . $pago['cuotaestado'].$sep;
                        $linea = $linea . $pago['bancocabecera_id'].$sep;
                        $linea = $linea . $pago['pago_id'].$sep;
        
                        fwrite($file, $linea . PHP_EOL);
                                                                    
                    // Incrementamos 
                        $count++;
                    }
                    
                    fclose($file);                  

                    echo "-------------------------------------------</br>";
                    echo " PAGOS {$periodo}</br> ";
                    echo "-------------------------------------------</br>";
                    echo "Total de cuotas exportados: $total </br>";
                    echo "Total de errores: $err </br>";
                    echo "------------------------------------------- </br>";
                    echo "<a href='{$filename}'>Descargar archivo </a>";
                    
                    $inserts = $count - $err;
                    
                    $pagos->free();
                    $cuotas->closeCNX();

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