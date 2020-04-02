<?php 

    class clsPanelGlobal
        {
            protected $db;
            protected $users;
            protected $mysqli;
            protected $indicador;

            public function __construct()
                 {
                     require_once("../models/cnx.php");
                     require_once("../models/indicador.php");
                     $this->db = new cnx(); 
                     $this->mysqli = $this->db->conectar();  
                     $this->indicador = new indicador();
                 }
                 
            public function TablaUsuarios()
                {  
                    $qry = "SELECT * FROM vw_usuarios "; // WHERE usr_email = '{$username}' and usr_clave = '{$password}'";
                    $resultado = $this->mysqli->query($qry);  
                    $code = "Count:" . $resultado->num_rows;
                    if ($resultado->num_rows > 0)
                        {
                            $code = $this->indicador->TableBox("Tabla de Usuarios", $resultado);
                        }
                    
                        return $code;
                }

            public function BoxesPrincipales()
            {
                $code = "<div class=\"row\">";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(10966,100,"Personas","small-box bg-aqua","fa fa-users","-");
                $code .=  "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(4211,100,"Personas Activas","small-box bg-green","fa fa-users","Más info");
                $code .= "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(6755,100,"Personas NO Activas","small-box bg-red","fa fa-users","Más info");
                $code .= "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .=  $this->indicador->Box(38,100,"Promedio Edad","small-box bg-green","fa fa-user-o","-");
                $code .= "</div>";
                $code .= "</div>";    
                
                return $code;
            }

            public function BoxesPrincipalesSociosActivos()
            {
                $code = "<div class=\"row\">";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(4211,100,"Activos","small-box bg-aqua","fa fa-users","-");
                $code .=  "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(1119,100,"Titulares","small-box bg-green","fa fa-user-o","Más info");
                $code .= "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .= $this->indicador->Box(2031,100,"Miembros","small-box bg-blue","fa fa-users","Más info");
                $code .= "</div>";
                $code .= "<div class=\"col-lg-3 col-xs-6\">";
                $code .=  $this->indicador->Box(1061,100,"Socios Únicos","small-box bg-yellow","fa fa-user-o","-");
                $code .= "</div>";
                $code .= "</div>";    
                
                return $code;
            }
         }

?>      