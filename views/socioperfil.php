<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsSocio.php");
    $socios = new clsSocio();
  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Perfil del Socio 
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Perfil</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">
      <!-- ******************************************************************************************************************************** -->
      <section class="content">
      <div class="row">
        <div class="col-md-6">
           <?php 
                $resultado = $socios->get_buscarSocio($_SESSION['ClienteId'], $_SESSION['SocioId'], 'id');
                if ($resultado->num_rows > 0)
                {
                  $socio = $resultado->fetch_assoc();
                  include "Paneles/BoxSocio.php";
                  $socios->registrarLectura($_SESSION['ClienteId'], $socio['soc_idSocio'], $_SESSION['UsuarioId'], $habilitado);
                }
                $resultado->free();
                $socios->closeCNX();
            ?>  
        </div>

        <div class="col-md-6">
          <?php include "Paneles/BoxPagoSocio.php"; ?>
        </div>

      </div>

      <!-- /.row (main row) -->    
    </section>
       