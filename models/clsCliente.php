<?php 

    class clsCliente
        {
            protected $db;
            protected $users;
            protected $mysqli;

               /* Atajo todos los envio de los POST */
            public $cli_idcliente;
            public $cli_Nombre;
            public $cli_Logo;
            public $cli_FechaFundacion;
            public $cli_FotoPath;
            public $cli_XMLFileName;

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
                 }
            

            public function get_clientes()
                 {
                    $qry = "SELECT * FROM vw_clientes ORDER BY cli_Nombre";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;
                 }

            public function get_cliente($idCliente)
                 {
                    $qry = "SELECT * FROM cliente WHERE cli_idCliente = " . $idCliente;
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;
                 }

            
            /*
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
            */
            

         }

?>      