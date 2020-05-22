<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
  $informe = $_GET['i'];    
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Información 
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Listados</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">
      <!-- ******************************************************************************************************************************** -->
      <section class="content">
      <div class="row">
        <div class="col-md-12">
           <p>Si lo esta viendo desde un movil le recomendamos girar la pantalla para un mejor experiencia.</p>
        </div>

        <div class="col-md-12">
        <?php
          switch ($informe) 
        {
          //Usuarios Socios ---------------------------------------
          case "usu":
            include "Paneles/lstcliusuarios.php";
            break;
          case "soc":
            include "Paneles/lstclisocios.php";
            break;
          case "pag":
            include "Paneles/lstclipagos.php";
            break;
          case "cuot":
            include "Paneles/lstclicuotas.php";
            break;
          case "msu":
            include "Paneles/ABMSocioUsuario.php";
            break;
          default:
            echo "sin informe";
            break;
        }
  ?>

        </div>

      </div>

      <!-- /.row (main row) -->    
    </section>
       