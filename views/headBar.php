
<?php 

  if (!isset($_SESSION['ClienteLogo']))
  {
    header('Location: login.php');
  }

  $LogoName = $_SESSION['ClienteLogo']; 
  $LogoPath = "dist/img/";
  $LogoFullPath = $LogoPath . $LogoName;
?>
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/logoBrio.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> <?php echo $_SESSION['ClienteNombre'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/logoBrio.jpg" class="img-circle" alt="User Image">
                <p>
                <?php echo $_SESSION['ClienteNombre'];?>
                  <small>Usuario: <?php echo $_SESSION['UsuarioNombre'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                  <a href="login.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          -->
        </ul>
      </div>