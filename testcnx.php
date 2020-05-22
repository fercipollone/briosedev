<?php

$servername = "localhost";
$database = "briosedev";
$username = "fer";
$password = "fer";

//Create connection con mysqli
$mysqli = new mysqli($servername,  $username, $password, $database);
// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
else
  {
    echo "Coneción exitosa: " . $mysqli -> stat;;
  }

echo "<br>";
$qry = "SELECT * FROM pagos";
echo($qry);
echo "<br>";
$resultado = $mysqli->query($qry);

while ($c = $resultado->fetch_assoc()) 
{
    echo "pag_idpago: " . $c['soc_idsocio'];
    echo "<br>";
}
$resultado->free();
$mysqli -> close();
?>