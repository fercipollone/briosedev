<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
  $Mensaje = "";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Importación de Socios 
        <small>Sede Virtual - SV</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Actualizacion de Información</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">          
  
  <?php include "Paneles\CtrlPG.php";  ?>  

  <div class="row">
    <div class="col-md-12">
        <?php include "ImportXml.php";  ?>
    </div>
  </div>
        
  <?php echo '<script language="javascript">document.getElementById("information").innerHTML="Proceso finalizado"</script>';?>
</section>
       