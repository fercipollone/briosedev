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
      &nbsp;&nbsp;HOME
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Bienvenido</a></li>
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
            <p class="text-muted text-center"><?php echo "Bienvenido a la plataforma de autogestión de su club" ?></p>
            <?php 
            if ($_SESSION['TipoUsuario']=="Socio"){
                echo "<a href='panel.php?panel=socio' class='btn btn-block btn-default'><b>Ver su perfil</b></a>";
            } 
            ?>
        </div>
        <!-- /.box-body -->
        </div>
    </div>
      <!-- /.row (main row) -->    
    </section>
<!-- ******************************************************************************************************************************** -->

