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
        <small>Identificación movíl de socios - IMS</small>
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
          <div>
           <?php 
                //echo "Periodo:" . $periodo;
                
                if ($periodo1 == "") 
                {
                  $resultado = $estadistica->get_lecturasPorCliente($_SESSION['ClienteId']);
                  if ($resultado->num_rows > 0)
                  {
                    include "Paneles/TableEstadistica.php";
                  }
                }
                else
                {
                  $resultado = $estadistica->get_lecturasPorPeriodo($_SESSION['ClienteId'], $periodo1);
                  if ($resultado->num_rows > 0)
                  {
                    include "Paneles/TableEstadisticaAccesos.php";
                  }
                };
                $resultado->free();
                $estadistica->closeCNX();
            ?>
            </div>  
          </div>

        <div class="col-md-6">
            <?php 
              //Grafico CharJS
              if ($periodo1 == "") 
                {
                  include "Paneles/CharEvoAccesos.php"; 
                }
              else
                {
                  include "Paneles/CharEvoAccesosPeriodo.php"; 
                }
            ?>  
        </div>


        <div class="col-md-6">
            <?php 
              //Grafico CharJS
              include "Paneles/CharJS.Donut.Habilitados.php"; 
            ?>  
        </div>
        
        <div class="col-md-6">
            <?php 
               if ($periodo1 == "") 
               {
                  $estadisticaU = new clsEstadistica();
                  $UsuariosLecturas  = $estadisticaU-> get_lecturasPorUsuarios($_SESSION['ClienteId'], $periodo1);
                  
                  if ($UsuariosLecturas->num_rows > 0)
                  {
                    include "Paneles/TableEstadisticaUsuarios.php";
                  }
                  $UsuariosLecturas->free();
                  $estadisticaU->CloseCNX();
               }  
            ?>  
        </div>
        
        <div class="col-md-6">
            <?php 
              
               if ($periodo1 != "") 
               {
                  $estadisticaNq = new clsEstadistica();
                  $UsuariosLecturas  = $estadisticaNq->get_lecturasPorUsuariosPeriodo($_SESSION['ClienteId'], $periodo1);
                  
                  if ($UsuariosLecturas->num_rows > 0)
                  {
                    include "Paneles/TableEstadisticaUsuarios.php";
                  }
                  $UsuariosLecturas->free();
                  $estadisticaNq->closeCNX();
               }  
            ?>  
        </div>


      <!-- /.row (main row) -->      
      </div>
    </section>