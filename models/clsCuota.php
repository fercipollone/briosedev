<?php 

    class clsCuota
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
            

            public function registrarPago($idCliente, $idSocio, $idUsuario, $habilitado)
                 {
                    $qry = "INSERT INTO lecturas(cli_idCliente, soc_idSocio, lec_FechaHora, usr_idUsuario, lec_habilitado) " . 
                    " Values( " .
                    "$idCliente,".
                    "$idSocio,". 
                    "now(),".
                    "$idUsuario,".
                    "$habilitado)";

                    $this->mysqli->query($qry);
                    //echo ($qry);
                 }
            

            public function buscarCuotaspendientes($idCliente, $idSocio, &$total, &$idpago)
                {
                    
                    $qry = "SELECT * FROM cuotas WHERE cso_estado = 1 AND soc_idSocio = {$idSocio} and cli_idCliente = {$idCliente} ORDER BY cso_socio, cso_descripcion";
                    $resultado = $this->mysqli->query($qry);
                    // Obtiene el total a pagar
                    $total = $this->totalcuotas($idSocio, $idCliente);
                    // genera u obtiene el idPago que concentra todas las cuotas. 
                    $idpago = $this->obtenerPago($idSocio, $idCliente, $total);
                    // actualiza las cuotas con el idPago
                    $this->asignaridPagoEnCuotas($idSocio, $idCliente, $idpago);
                    
                    return $resultado;
                }
            
            public function buscarCuotas($idCliente, $idSocio)
                {
                    
                    $qry = "SELECT * FROM cuotas WHERE soc_idSocio = {$idSocio} and cli_idCliente = {$idCliente} ORDER BY cso_socio, cso_descripcion";
                    $resultado = $this->mysqli->query($qry);                    
                    return $resultado;
                }

            public function buscarPagos($idCliente, $idSocio)
                {                    
                    $qry = "SELECT * FROM pagos WHERE pag_estado > 0 AND soc_idSocio = {$idSocio} and cli_idCliente = {$idCliente} ORDER BY pag_fechahora";
                    //echo $qry;
                    $resultado = $this->mysqli->query($qry);                    
                    return $resultado;
                }
            
            public function ActualizarPago($qry,$idpago,$pag_estado)
                {
                    //Ejecuto el UPDATE que viene dese mercadopagor.php para actualizar el PAGO
                    $this->mysqli->query($qry);

                    if ($pag_estado == 2)
                    {
                        //Hago el Update de las cuotas 
                        $qry = "UPDATE cuotas SET cso_estado = 2 WHERE pag_idpago = {$idpago}";
                        $this->mysqli->query($qry);
                    }
                    return true;
                }

            private function asignaridPagoEnCuotas($idSocio, $idCliente, $idpago)
                {
                    $qry = "UPDATE cuotas SET pag_idpago = {$idpago} WHERE cso_estado = 1 AND soc_idSocio = {$idSocio} and cli_idCliente = {$idCliente}";
                    $this->mysqli->query($qry);
                }
            
            
            private function obtenerPago($idSocio, $idCliente, $total)
                {
                    $qry = "SELECT pag_idpago FROM pagos WHERE pag_estado = 0 AND soc_idSocio = {$idSocio} AND cli_idCliente = {$idCliente}";
                    $resultado = $this->mysqli->query($qry);
                    $p = $resultado->fetch_assoc();
                    $idpago = $p['pag_idpago'];
                    
                    if ($p['pag_idpago']==NULL)
                        {
                            $qry = "INSERT pagos(soc_idsocio, cli_idcliente, pag_estado, pag_monto) VALUES ({$idSocio},{$idCliente},0,{$total})";
                            $this->mysqli->query($qry);
                            
                            $resultado->free();
                                                                                    
                            $qry = "SELECT pag_idpago FROM pagos WHERE pag_estado = 0 AND soc_idSocio = {$idSocio} AND cli_idCliente = {$idCliente}";
                            $resultado = $this->mysqli->query($qry);
                            $p = $resultado->fetch_assoc();
                        }
                    
                    $idpago = $p['pag_idpago'];
                    $resultado->free();
                        
                    return $idpago;
                }

            private function totalcuotas($idSocio, $idCliente)
                {
                    $qry = "SELECT sum(cso_importe) as total FROM cuotas WHERE cso_estado = 1 AND soc_idSocio = {$idSocio} AND cli_idCliente = {$idCliente}";
                    $resultadototal = $this->mysqli->query($qry);
                    $t = $resultadototal->fetch_assoc();
                    $total = $t['total'];
                    $resultadototal->free();
                    return $total;
                }

            public function SeleccionarPeriodosPagos($idCliente)
                {                    
                    $qry = "SELECT periodopago, count(distinct pago_id) as cantidad, count(cuotadetalle_id) as cuotas, sum(importe) as total FROM vw_pagos WHERE cliente_id = {$idCliente} and estadopago_id = 2 GROUP BY periodopago ORDER BY periodopago DESC";
                    //echo $qry;
                    $resultado = $this->mysqli->query($qry);                    
                    return $resultado;
                }
            
            public function PagosxPeriodo($idCliente, $periodo, &$cantidad)
                {                    
                    $qry = "SELECT count(pago_id) as cantidad FROM vw_pagos WHERE cliente_id = {$idCliente} AND periodopago = {$periodo} AND estadopago_id = 2";
                    $resultadototal = $this->mysqli->query($qry);
                    $t = $resultadototal->fetch_assoc();
                    $cantidad = $t['cantidad'];
                    $resultadototal->free();
                                        
                    $qry = "SELECT * FROM vw_pagos WHERE cliente_id = {$idCliente} AND periodopago = {$periodo} AND estadopago_id = 2 ";
                    $resultado = $this->mysqli->query($qry);                    
                    return $resultado;
                }
            
            public function ExportPagos($idCliente, $periodo, $file)
                {                    
                    #OPTIONALLY ENCLOSED BY '"'
                    
                    $qry="
                    SELECT * INTO OUTFILE '{$file}'
                    FIELDS TERMINATED BY ',' 
                    LINES TERMINATED BY '\\n'
                    FROM vw_pagos
                    WHERE cliente_id = {$idCliente} AND periodopago = {$periodo}
                    ";          
                    
                    echo $qry;
                    //$resultado = $this->mysqli->query($qry);                    
                    //return $resultado;
                }
         }
?>      