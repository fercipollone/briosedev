<?php
    //$datos = $_POST["json"];
    //$json = $_GET["json"];
    //echo $json;
    //var_dump($datos);

    $json_url = "clientes.json";
    $json = file_get_contents($json_url);
    //$json = utf8_encode($json);
    $data = json_decode($json, TRUE);
    $hay = count($data[0]);
    echo $hay;
    
    if ($hay>0)
        {
            $clientes = $data[0];

            foreach($clientes as $cliente){
                   echo "<table>";
                   echo "<tr>";
                   echo "<td>$cliente[cli_Nombre]</td>";
                   echo "<td>$cliente[cli_Logo]</td>";
                   echo "<td>$cliente[cli_FechaFundacion]</td>";
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