<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsSocio.php");

    $indicador = new clsPanelGlobal(); 
    $socios = new clsSocio();

   if(isset($_POST["busqueda"]))
    {
      $filtro = $_POST["busqueda"];
      echo "Post";
      echo $filtro; 
    }
    
    if(isset($_GET["id"]))
    {
      $filtro = $_GET["id"];
      echo "Get";
      echo $filtro; 
    }
    
    
  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Panel de Socios 
        <small>Identificación movíl de socios - IMS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Información social</a></li>
        <li class="active">-</li>
      </ol>
    </section>


<section class="content">

      <!-- ******************************************************************************************************************************** -->

      <section class="content">
      <div class="row">
        <div class="col-md-6">
           <?php 
              if ($filtro == '' ) 
              {
                echo "<h3>Resultado de las busquedas</h3>"; 
              }
              else
              {
                $resultado = $socios->get_buscarSocio(1,$filtro);
                if ($resultado->num_rows == 1)
                {
                  $socio = $resultado->fetch_assoc();
                  include "Paneles/BoxSocio.php";
                };

                if ($resultado->num_rows > 1)
                {
                  include "Paneles/TableSocio.php";
                }
                 
              }
            ?>  
        </div>

        <div class="col-md-6">
          <?php include "Paneles/BoxBusquedaSocio.php"; ?>
        </div>

        

      </div>

      
      <!-- /.row (main row) -->

    
    </section>
       