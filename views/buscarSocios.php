<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    require_once("../models/clsPanelGlobal.php");
    require_once("../models/clsSocio.php");

    $indicador = new clsPanelGlobal(); 
    $socios = new clsSocio();
    $filtro = "";
    $filtroNum = "";
    $TipoFiltro = "";
    $Mensaje = "Buscar Personas: ";
     
    if(isset($_POST["TipoBusqueda"]))
    {
      $TipoFiltro = $_POST["TipoBusqueda"];
    }

   if(isset($_POST["busqueda"]))
    {
      $filtro = $_POST["busqueda"];
      echo "Post";
      echo $filtro; 
    }

    if(isset($_POST["numero"]))
    {
      $filtroNum = $_POST["numero"];
      echo "Post";
      echo $filtroNum; 
    }

    if(isset($_POST["result"]))
    {
      $filtroNum = $_POST["result"];
      echo "Post";
      echo $filtroNum; 
    }
    
    if(isset($_GET["id"]))
    {
      $filtro = $_GET["id"];
      echo "Get";
      echo $filtro; 
    }
    
    if ($filtroNum != "" )
    {
      $filtro = $filtroNum;
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
              //echo "Filtro: ";
              //echo $filtro; 
              //echo "</br>";

              //echo "Filtro Num: ";
              //echo  $filtroNum;
              //echo "</br>";

              //echo "QR POST result: ";
              //echo $_POST["result"];
              //echo "</br>";
            ?>

           <?php 
              if ($filtro == '' ) 
              {
                echo "<h3>$Mensaje</h3>"; 
              }
              else
              {
                $resultado = $socios->get_buscarSocio($_SESSION['ClienteId'],$filtro, $TipoFiltro);
                if ($resultado->num_rows == 1)
                {
                  $socio = $resultado->fetch_assoc();
                  include "Paneles/BoxSocio.php";
                  $socios->registrarLectura($_SESSION['ClienteId'], $socio['soc_idSocio'], $_SESSION['UsuarioId'], $habilitado);
                }

                if ($resultado->num_rows > 1)
                {
                  include "Paneles/TableSocio.php";
                  $resultado->free();
                } 
              }
              $socios->closeCNX();
            ?>  
        </div>

        <div class="col-md-6">
          <?php include "Paneles/BoxBusquedaSocio.php"; ?>
        </div>

      </div>

      <!-- /.row (main row) -->    
    </section>
       