<?php 

    class clsSocio
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
            

            public function registrarLectura($idCliente, $idSocio, $idUsuario, $habilitado)
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
            

            public function get_buscarActividadesSocio($idCliente, $idSocio)
                 {
                    $qry = "SELECT * FROM actividades WHERE soc_idSocio = {$idSocio} and cli_idCliente = {$idCliente} ORDER BY act_nombre";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;
                }

            public function get_buscarSocio($idCliente, $filtro, $TipoFiltro)
                {  
                    if (is_numeric($filtro)) 
                        {
                            if ($TipoFiltro == 'id')
                                {
                                    $this->get_buscarSocioPorId($idCliente, $filtro, $resultado);
                                    return $resultado;
                                }
                            else
                                {
                                    switch(true)
                                    {
                                        
                                        //case $this->get_buscarSocioPorId($idCliente, $filtro, $resultado) > 0:
                                        //    return $resultado;
                                        //    break;

                                        case $this->get_buscarSocioPorDocumento($idCliente, $filtro, $resultado) > 0:
                                            return $resultado;
                                            break;
                                        
                                        case $this->get_buscarSocioPorNroSocio($idCliente, $filtro, $resultado) > 0:
                                            return $resultado;
                                            break;             
        
                                        case $this->get_buscarSocioPorPin($idCliente, $filtro, $resultado) > 0:
                                            return $resultado;
                                            break; 

                                        default:
                                            $this->get_buscarSocioPorPines($idCliente, $filtro, $resultado);
                                            return $resultado;    
                                    }     
                                }
                            
                        }
                        else
                        { 
                            $this->get_buscarSocioPorNombre($idCliente, $filtro, $resultado);
                            return $resultado;                            
                         }

                    }
            
            private function get_buscarSocioPorNroSocio($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM socio WHERE soc_nrosocio = {$filtro} and cli_idCliente = {$idCliente} ORDER BY soc_apellidoynombre ";
                $resultado = $this->mysqli->query($qry);  
                return $resultado->num_rows;
            }

            private function get_buscarSocioPorDocumento($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM socio WHERE soc_documento = {$filtro} and cli_idCliente = {$idCliente} ORDER BY soc_apellidoynombre";
                $resultado = $this->mysqli->query($qry);  
                return $resultado->num_rows;
            }

            private function get_buscarSocioPorPin($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM socio WHERE soc_pin = {intval($filtro)} and cli_idCliente = {$idCliente} ORDER BY soc_apellidoynombre";
                $resultado = $this->mysqli->query($qry);
                return $resultado->num_rows;
            }

            private function get_buscarSocioPorPines($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM vw_sociospines WHERE pin_pin = {intval($filtro)} and cli_idCliente = {$idCliente}";
                $resultado = $this->mysqli->query($qry);
                return $resultado->num_rows;
            }

            private function get_buscarSocioPorId($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM socio WHERE soc_idSocio = {$filtro} and cli_idCliente = {$idCliente} ORDER BY soc_apellidoynombre";
                $resultado = $this->mysqli->query($qry);  
                return $resultado->num_rows;
            }

            private function get_buscarSocioPorNombre($idCliente, $filtro, &$resultado)
            {
                $qry = "SELECT * FROM socio WHERE soc_apellidoynombre like '%{$filtro}%' and cli_idCliente = {$idCliente} ORDER BY soc_apellidoynombre";
                $resultado = $this->mysqli->query($qry);  
                return $resultado->num_rows;
            }

            

         }

?>      