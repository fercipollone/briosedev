<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsPanelGlobal.php");
    
    $Mensaje = "";
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Actualizacion de Información</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">
      <!-- ******************************************************************************************************************************** -->
      <section class="content">
      <div class="row">
        <div class="col-md-6">
            <?php  include "ImportXml.php";  ?>
            <?php
              //echo "Socios Actualizados: ";
              //echo "Inserto: " . $inserted;
              //echo "Errores: " . $err;

            ?>  
        </div>

      </div>

      <!-- /.row (main row) -->    
    </section>
       