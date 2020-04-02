<?php
//CREATE USER 'fer'@'localhost' IDENTIFIED WITH mysql_native_password BY 'fer';
//GRANT ALL PRIVILEGES ON *.* TO 'fer'@'localhost' WITH GRANT OPTION;

class cnx 
{
    protected $mysqlicnx;
    protected $query;
    
    public function conectar()
        {
            
            //SERVER 
            //$servername = "66.206.4.138";
            //$servername = "localhost";
            //$database = "briolitedb";
            //$username = "briod2019";
            //$password = "Pass@briod2019";
            //$username = "briolite";
            //$password = "Pass@briolite";
            //XAMPP
            $servername = "localhost";
            $database = "briosedev";
            $username = "fer";
            $password = "fer";
            
            //Create connection con mysqli
            $this->mysqlicnx = new mysqli($servername,  $username, $password, $database);
            if ($this->mysqlicnx->connect_errno) 
                {
                    echo "Falló la conexión a MySQL: (" . $this->mysqlicnx->connect_errno . ") " . $this->mysqlicnx->connect_error; 
                }
            return $this->mysqlicnx; 
        }
    
    public function desconectar()
        {
            $this->mysqlicnx->close();  
        }
}
?>