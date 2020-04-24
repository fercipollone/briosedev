<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsEstadistica.php");

    $estadistica = new clsEstadistica();
    $periodo1 = "";
          
    if(isset($_POST["periodo"]))
    {
      $periodo1 = $_POST["periodo"];
    }

  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Estadisticas 
        <small>Sede Virtual - SV</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Estadisticas de Uso</a></li>
        <li class="active">-</li>
      </ol>
    </section>

    <!-- ******************************************************************************************************************************** -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
            <?php 
              include "Paneles/CharEvoPagos.php"; 
            ?>  
        </div>

        <div class="col-md-6">
            <?php 
              //Grafico CharJS
              include "Paneles/DonutTasaPeriodo.php"; 
            ?>    
        </div>
      </div>
    </section>