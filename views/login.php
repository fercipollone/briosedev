<!DOCTYPE html>
<html>

<?php 
  include("head.php");
  session_destroy();

  $rechazo = "";
  if(isset($_SESSION["RechazoLogin"]))
    { 
      $rechazo = "<p>{$_SESSION['RechazoLogin']}</p>";
    } 
?>

<body class="hold-transition login-page">
<div class="login-box" align="center">
  <img src="dist/img/logoBrio.jpg" class="img-circle img-thumbnail text_align:center" alt="User Image">
  <div class="login-logo">
    <b>Brio</b>Sede Virtual
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus credenciales para iniciar sesion</p>

    <form action="loginValidar.php" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="number" class="form-control" placeholder="Nro Documento" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
      </div>

      <?php echo($rechazo); ?>
    </form>

    <!-- <a href="#">Olvide mi password</a>-->
</div>
<hr>
  <div class="login-box-body">
    <form action="loginregistro.php" method="post">
      <p class="login-box-msg"><i class="icon fa fa-key"></i>&nbsp;Haga clic aquí para obtener sus credenciales</p>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
      </div>
    </form>
  </div>
  <div>
    <br/><p class="login-box-msg"><i class="icon fa fa-copyright"></i>&nbsp;2020 IT SPORT GROUP</p>
  </div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
