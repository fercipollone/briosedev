<?php 
     
  $claveant = $_POST["claveant"];
  $clave = $_POST["clave"];

  require_once("../models/clsUser.php");
  $usuario = new clsUser();

  $resp = $usuario->CambiarClave($_SESSION['UsuarioId'],$claveant,$clave);
  $usuario->closeCNX();
        
  if ($resp)
    {
      $pag_estado = 2;
      $style = "callout callout-success";
      $titulo = "Cambio exitoso";
      $mensaje = "Su contraseña se ha cambiado con éxito.";
    }
  else
    {
      $pag_estado = 2;
      $style = "callout callout-warning";
      $titulo = "No pudimos cambiar la clave";
      $mensaje = "La contraseña anterior no coincide con la que tenemos en nuestra base de datos. Vuelva a intentarlo.";
    }
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Notificación del pago
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Perfil</a></li>
        <li class="active">-</li>
      </ol>
    </section>
<!-- ******************************************************************************************************************************** -->
<section class="content">
      
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-bullhorn"></i>

            <h3 class="box-title">Notificación</h3>
        </div>
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $LogoFullPath; ?>" alt="logo">
            <h3 class="profile-username text-center"><?php echo $_SESSION['ClienteNombre'];?></h3>
            <p class="text-muted text-center"><?php echo "Su club le agradece por realizar la gestión a traves de esta plataforma." ?></p>
            
            <div class="<?php echo $style; ?>">
            <h4><?php echo $titulo; ?></h4>
            <p><?php echo $mensaje;?></p>
            </div>
            <?php 
            if ($resp) 
              {
                echo "<a href='panel.php?panel=socio' class='btn btn-block btn-default'><b>Volver a la pagina principal</b></a>";
              }
            else
              {
                echo "<a href='panel.php?panel=clave' class='btn btn-block btn-default'><b>Volver ingresar la clave</b></a>";
              }
            ?>
            
        </div>
        <!-- /.box-body -->
        </div>
    </div>
      <!-- /.row (main row) -->    
    </section>
<!-- ******************************************************************************************************************************** -->

