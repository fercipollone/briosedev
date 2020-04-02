<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsEstadistica.php");

    $periodo = "";
    $idusuario = "";
          
    if(isset($_POST["periodo"]))
    {
      $periodo = $_POST["periodo"];
    }
  
    if(isset($_POST["usuario"]))
    {
      $idusuario = $_POST["usuario"];
    }
    else
    {
      //Hacer el redirect a estadisticas
      $idusuario = 7;
    }

    if(isset($_POST["usuarionombre"]))
    {
      $usuarionombre = $_POST["usuarionombre"];
    }
    else
    {
      //Hacer el redirect a estadisticas
      $idusuario = 7;
      $usuarionombre = "sin nombre";
      header("Location: panel.php?panel=estadisticas");
    }


  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Estadisticas del Usuario <?php echo $usuarionombre; ?>
        <small>Identificación movíl de socios - IMS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Estadisticas de Uso del usuario <?php echo $usuarionombre; ?></a></li>
        <li class="active">-</li>
      </ol>
    </section>

    <!-- ******************************************************************************************************************************** -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
           <div>
           <?php 
                $estadistica = new clsEstadistica();
                if ($periodo == "")
                {
                  $UsuariosLecturas = $estadistica->get_lecturasPorPeriodoUsuarios($_SESSION['ClienteId'], $idusuario);
                
                  if ($UsuariosLecturas->num_rows > 0)
                  {
                    include "Paneles/TableEstadisticaUsuariosPeriodo.php";
                  };
                  $UsuariosLecturas->free();
                }
                else
                {
                  $periodo1 = $periodo;
                  $resultado = $estadistica->get_lecturasPorPeriodoUsuario($_SESSION['ClienteId'], $periodo, $idusuario);
                  if ($resultado->num_rows > 0)
                  {
                    include "Paneles/TableEstadisticaAccesos.php";
                  }
                  $resultado->free();
                }
                $estadistica->closeCNX();
            ?>
            </div>  
        </div>

        <div class="col-md-6">
            <?php 
              if ($periodo == "")
              {
                include "Paneles/CharEvoAccesosUsuarios.php"; 
              }
              else
              {
                include "Paneles/CharEvoAccesosUsuarioPeriodo.php"; 
              }
            ?>  
        </div>

      <!-- /.row (main row) -->      
      </div>

      
    </section>
       