<?php 

    class clsEstadistica
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
                    $this->db->desconectar();
                    //$this->mysqli->close();   
                 }
            
            
            public function get_PagosPorCliente($idCliente)
                 {  
                     $qry = "SELECT periodopago as periodo, SUM(importe) as pagos FROM briosedev.vw_pagos WHERE estadopago_id = 2 AND cliente_id = ({$idCliente}) GROUP BY periodopago ORDER BY periodopago DESC;";
                     //$this->mysqli->store_result();
                     $resultado = $this->mysqli->query($qry);  
                     return $resultado;                            
                 }
            
            public function get_TasaPeriodo($idCliente, &$pendiente, &$cobrado)
                 {  
                    $pendiente = 0;
                    $cobrado = 0;

                    $qry = "SELECT sum(cso_importe) as TotalPendiente FROM cuotas WHERE cso_estado = 1 AND cli_idCliente = {$idCliente}";
                    $resultado = $this->mysqli->query($qry);
                     
                    if ($resultado->num_rows > 0)
                        {
                            $r = $resultado->fetch_assoc();
                            $pendiente = $r['TotalPendiente'];
                        }                      
                    
                    $resultado->free();

                    $qry = "SELECT SUM(importe) as TotalCobrado FROM briosedev.vw_pagos WHERE estadopago_id = 2 AND cliente_id = {$idCliente} AND periodopago = DATE_FORMAT(now(), '%Y%m');";
                    $resultado = $this->mysqli->query($qry);
                     
                    if ($resultado->num_rows > 0)
                        {
                            $r = $resultado->fetch_assoc();
                            $cobrado = $r['TotalCobrado'];
                        }                      
                    
                    $resultado->free();
                     
                    return TRUE;                            
                 }

            
            public function get_lecturasPorCliente($idCliente)
                {  
                    $qry = "call sp_LecturasPorCliente({$idCliente})";
                    //$this->mysqli->store_result();
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }
            
                public function get_lecturasPorPeriodo($idCliente, $periodo)
                {  
                    $qry = "call sp_LecturasPorPeriodo({$idCliente},'{$periodo}')";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }

                public function get_lecturasPorPeriodoUsuario($idCliente, $periodo, $idusuario)
                {  
                    //$qry = "SELECT usr_nombre as nombre, usr_idUsuario as id, count(*) as lecturas FROM briolitedb.vw_lecturas WHERE cli_idCliente = {$idCliente} AND Periodo = {$periodo} GROUP BY usr_idUsuario, usr_nombre ORDER BY lecturas DESC";
                    $qry = "SELECT ndia, nrdia, dia, count(distinct soc_idSocio) as Socios, count(*) as LecturasTotales, count(CASE WHEN lec_habilitado = 1 THEN 1 END ) as Habilitados, count(CASE WHEN lec_habilitado = 0 THEN 1 END ) as NoHabilitados FROM vw_lecturas WHERE  cli_idCliente = {$idCliente} AND Periodo = {$periodo}  AND usr_idUsuario = {$idusuario} GROUP BY 	ndia, nrdia, dia  ORDER BY 	nrdia ASC";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }

                public function get_lecturasPorClienteUsuarioPeriodo($idCliente, $periodo, $idusuario)
                {  
                    $qry = "call sp_LecturasPorClienteUsuarioPeriodo({$idCliente},'{$periodo}',{$idusuario})";
                    echo($qry);
                    $resultado = $this->mysqli->query($qry) or die($this->mysqli->error);  
                    return $resultado;                            
                }

                public function get_lecturasPorPeriodoUsuarios($idCliente, $idusuario)
                {  
                    $qry = "call sp_LecturasPorClienteUsuario({$idCliente}, {$idusuario} )";
                    $resultado = $this->mysqli->query($qry) or die($this->mysqli->error);  
                    return $resultado;                            
                }

                public function get_lecturasPorUsuarios($idCliente)
                {  
                    $qry = "SELECT usr_nombre as nombre, usr_idUsuario as id, count(*) as lecturas FROM vw_lecturas WHERE cli_idCliente = {$idCliente} GROUP BY usr_idUsuario, usr_nombre ORDER BY lecturas DESC";
                    $resultado = $this->mysqli->query($qry) or die($this->mysqli->error);  
                    return $resultado;                            
                }

                public function get_lecturasPorUsuariosPeriodo($idCliente, $periodo)
                {  
                    $qry = "SELECT usr_nombre as nombre, usr_idUsuario as id, count(*) as lecturas FROM briolitedb.vw_lecturas WHERE cli_idCliente = {$idCliente} AND Periodo = {$periodo} GROUP BY usr_idUsuario, usr_nombre ORDER BY lecturas DESC";
                    $resultado = $this->mysqli->query($qry) or die($this->mysqli->error);  
                    return $resultado;                            
                }

                
                
            
         }

?>      