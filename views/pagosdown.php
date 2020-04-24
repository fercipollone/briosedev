<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    if (!isset($_GET['periodo']))
    {
      header('Location: login.php');
    }
    $periodo = $_GET['periodo'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Exportación de Pagos
        <small>Sede Virtual - SV</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Exporta el archivo con los pagos <?php echo $periodo; ?></a></li>
        <li class="active">-</li>
      </ol>
    </section>

    <section class="content">          

      <div class="row">
        <div class="col-md-12">  
          <?php 
              require_once("../models/clsExport.php");
              $export = new clsExport();	
              $export->export_pagos($periodo);
              $export->closeCNX();
          ?>
        </div>
      </div>
            
      <?php echo '<script language="javascript">document.getElementById("information").innerHTML="Proceso finalizado"</script>';?>
    </section>
  </div>  