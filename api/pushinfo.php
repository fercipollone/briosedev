<?php
    //$datos = $_POST["json"];
    //$json = $_GET["json"];
    //echo $json;
    //var_dump($datos);

    $json_url = "test.json";
    $json = file_get_contents($json_url);
    //$json = utf8_encode($json);
    $data = json_decode($json, TRUE);
    $hay = count($data["empleados"]);
    
    echo $hay;
    if ($hay>0)
        {
            $trabajadores = $data["empleados"];

            foreach($trabajadores as $empleado){
                   echo "<table>";
                   echo "<tr>";
                   echo "<td>$empleado[ID]</td>";
                   echo "<td>$empleado[Nombre]</td>";
                   echo "<td>$empleado[Ingreso]</td>";
                   echo "<td>$empleado[Puesto]</td>";
                   echo "</tr>";
                   echo "</table>";
             }
        }
    //echo "<pre>";
    //foreach ($data as $line) {
        //echo $line->{"cli_idCliente"};
        //print_r($line);
    //}
    //echo "</pre>";

?>