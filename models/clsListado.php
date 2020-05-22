<?php 

    class clsListado
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
            
            public function listado_usuarios($cliente_id)
                {  
                    $qry = "SELECT soc_apellidoynombre, soc_documento, soc_sexo, tid_idtipodocumento, usr_Nombre, usr_Clave, usr_Email, hab_nombre, cli_idCliente, soc_idsocio FROM vw_sociosusuario WHERE cli_idCliente = {$cliente_id} AND usr_Nombre is not null ORDER BY soc_apellidoynombre";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }
            
            public function listado_socios($cliente_id)
                {  
                    $qry = "SELECT soc_apellidoynombre, soc_documento, soc_sexo, tid_idtipodocumento, usr_Nombre, usr_Clave, usr_Email, hab_nombre, cli_idCliente, soc_idsocio FROM vw_sociosusuario WHERE cli_idCliente = {$cliente_id} ORDER BY soc_apellidoynombre";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }
            
            public function listado_pagos($cliente_id)
                {  
                    $qry = "SELECT DISTINCT fechapago, periodopago, socionombre, documento, mercadopago_id, estaodopago, pagomonto FROM vw_pagos WHERE cliente_id = {$cliente_id} AND mercadopago_id is not null ORDER BY fechapago DESC ";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                            
                }
            
            public function listado_cuotas($cliente_id)
                {  
                    $qry = "SELECT fechapago, periodopago, socionombre, documento, mercadopago_id, estaodopago, pagomonto, socio, descripcion, periodo, importe FROM vw_pagos WHERE cliente_id = {$cliente_id} AND mercadopago_id is not null ORDER BY fechapago DESC";
                    $resultado = $this->mysqli->query($qry);  
                    return $resultado;                               
                }
            
         }

?>      