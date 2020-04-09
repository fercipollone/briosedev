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
      <p><?php echo $_SESSION['ClienteNombre'];?></p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i><?php echo $_SESSION['TipoUsuario']; ?></a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <?php 
  switch ($_SESSION['SuperUsuario']) {
    case 0:
         //  USUARIO COMUN 
        include "Paneles/menusocio.html";
        break;
    case 1:
        //  USUARIO ADMIN
        include "Paneles/menuadmin.html";
        break;
    case 2:
        //  USUARIO SUPERUSUARIO
        include "Paneles/menusuperusuario.html";
        break;
  }
  ?>
    <!-- <li class="active"><a href="panel.php?panel=global"><i class="fa fa-users"></i> <span>Info. Global</span></a></li> -->
    <!-- <li class="active"><a href="panel.php?panel=socios"><i class="fa fa-users"></i> <span>Socios General</span></a></li> -->
  <?php  
    //--------------------------------------------------------------------------------------------------------------------------------
   
    //--------------------------------------------------------------------------------------------------------------------------------
    if ($_SESSION['SuperUsuario']==0) 
    {
    ?>
      
      
    <?php  
    //--------------------------------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------------------------------
    }
      else
    {
    ?>
      

    <?php
    }
    ?>
    
  


      


    
  <!-- <li><a href="panel.php?panel=actividades"><i class="fa fa-futbol-o"></i><span>Actividades</span></a></li> -->
    
  
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>