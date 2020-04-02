<?php
    $filtro = "";
    $filtroNum = "";

   if(isset($_POST["busqueda"]))
    {
      $filtro = $_POST["busqueda"];
      echo "Post";
      echo $filtro; 
    }

    if(isset($_POST["numero"]))
    {
      $filtroNum = $_POST["numero"];
      echo "Post";
      echo $filtroNum; 
    }

    if(isset($_POST["result"]))
    {
      $filtroNum = $_POST["result"];
      echo "Post";
      echo $filtroNum; 
    }
    
    if(isset($_GET["id"]))
    {
      $filtro = $_GET["id"];
      echo "Get";
      echo $filtro; 
    }
    
    if ($filtroNum != "" )
    {
      $filtro = $filtroNum;
    }
    
    echo "Filtro: ";
    echo $filtro; 
    echo "</br>";

    echo "Filtro Num: ";
    echo  $filtroNum;
    echo "</br>";

    echo "QR POST result: ";
    echo $_POST["result"];
    echo "</br>";

    echo "QR POST fer: ";
    echo $_POST["fer"];
    echo "</br>";

    echo "QR GET result: ";
    echo $_GET["result"];
    echo "</br>";

    echo "QR GET fer: ";
    echo $_GET["fer"];
    echo "</br>";
  ?>
