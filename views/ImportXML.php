<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsImport.php");

    $import = new clsImport();
    $err = 0;
    
    if(isset($_GET['name']))
    {
      $file = $_GET['name'];
    } 
    else
    {
      $file = $_SESSION['ClienteXMLFileName'];
    }
    
    //Importa los socios
    $inserted = 0;
    $err =  $import->import_Socios($file, $inserted);
    //Importa las actividades de los socios
    $inserted = 0;
    $err = $import->import_ActividadesSocios($file, $inserted);
    //Importa los Pines 
    $inserted = 0;
    $err = $import->import_Pines($file, $inserted);

    $import->closeCNX();

?>
