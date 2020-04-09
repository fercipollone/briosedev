<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsCliente.php");

    $Cliente = new clsCliente();
    $Mensaje = "Clientes: ";

  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Administración de Clientes
        <small>CRUD Clientes - IMS</small>
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
        <div class="col-12">
           <?php 
                $resultado = $Cliente->get_clientes();
                if ($resultado->num_rows > 0)
                {
                  include "Paneles/TableCliente.php";
                }
                //$resultado->free();
                //$Cliente->closeCNX();
            ?>  
        </div>
      </div>

      <!-- /.row (main row) -->    
    </section>
       