<?php 

  if (!isset($_SESSION['ClienteLogo']))
  {
    header('Location: login.php');
  }

  $LogoName = $_SESSION['ClienteLogo']; 
  $LogoPath = "dist/img/";
  $LogoFullPath = $LogoPath . $LogoName;
?>

<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo $LogoFullPath; ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Brio Software Club</p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Paneles</li>
    
    <!-- <li class="active"><a href="panel.php?panel=global"><i class="fa fa-users"></i> <span>Info. Global</span></a></li> -->
    <!-- <li class="active"><a href="panel.php?panel=socios"><i class="fa fa-users"></i> <span>Socios General</span></a></li> -->
    <?php 
    //--------------------------------------------------------------------------------------------------------------------------------
    //  USUARIO COMUN 
    //--------------------------------------------------------------------------------------------------------------------------------
    if ($_SESSION['SuperUsuario']==0) 
    {
    ?>
      <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>Información</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="panel.php?panel=socios">Perfil</a></li>
          <li><a href="panel.php?panel=socios">Cuotas</a></li>
        </ul>
      </li>  

    <li>
        <a href="login.php"><i class="fa fa-close"></i><span>Cerrar Sessión</span></a>
    </li>
  
    <?php  
    //--------------------------------------------------------------------------------------------------------------------------------
    //  USUARIO SUPERUSUARIO
    //--------------------------------------------------------------------------------------------------------------------------------
    }
      else
    {
    ?>
      <li class="treeview">
        <a href="#"><i class="fa fa-database"></i> <span>Administración</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li><a href="panel.php?panel=clientes">Clientes</a></li>
          <li><a href="panel.php?panel=usuarios">Usuarios</a></li>
        </ul>

      </li>

      <li class="treeview">
        <a href="#"><i class="fa fa-bar-chart"></i> <span>Estadisticas</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="panel.php?panel=estadisticas">Accesos</a></li>
      </ul>
    </li>
  
    <li class="treeview">
      <a href="#"><i class="fa fa-database"></i> <span>Datos</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="panel.php?panel=import">Importar Datos</a></li>
        <!-- <li><a href="ImportXML.php?name=<?php //echo ($_SESSION['ClienteXMLFileName']) ?>">Actualizar Socios</a></li> -->
      </ul>
    </li>

    <?php
    }
    ?>

      


    
  <!-- <li><a href="panel.php?panel=actividades"><i class="fa fa-futbol-o"></i><span>Actividades</span></a></li> -->
    
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>