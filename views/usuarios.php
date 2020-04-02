<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsUser.php");

    $Usuarios = new clsUser();
    $Mensaje = "Usuarios: ";

  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Administración 
        <small>CRUD Usuarios - IMS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Información de usuarios</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">
      <!-- ******************************************************************************************************************************** -->
      <section class="content">
      <div class="row">
        <div class="col-12">
           <?php 
                $resultado = $Usuarios->get_Usuarios();
                if ($resultado->num_rows > 0)
                {
                  include "Paneles/TableUsuarios.php";
                }
            ?>  
        </div>
      </div>

      <!-- /.row (main row) -->    
    </section>
       