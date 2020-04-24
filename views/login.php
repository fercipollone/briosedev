<!DOCTYPE html>
<html>

<?php 
  include("headlogin.php");
  
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
        <input name="email" type="text" class="form-control" placeholder="Nro Documento" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
      </div>

      <?php echo($rechazo.'<br>'); ?>
      <a href="loginrecupero.php">Olvide mi clave</a>
    </form>
</div>
<hr>
  <div class="login-box-body">
    <form action="loginregistro.php" method="post">
      <p class="login-box-msg"><i class="icon fa fa-key"></i>&nbsp;Haga clic aquí para obtener sus credenciales</p>
      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
        <!--<br><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">¿Como registrarse?</button>-->
        <br><a class="btn btn-default" href="https://youtu.be/H0RpxIJX_r8" target="_blank">¿Como registrarse?</a>
      </div>
    </form>
  </div>
  <div>
    <br/><p class="login-box-msg"><i class="icon fa fa-copyright"></i>&nbsp;2020 IT SPORT GROUP</p>
  </div>
<!-- /.login-box -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ayuda</h4>
        </div>
        <div class="modal-body">
          <div class="modal-body" id="yt-player">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/H0RpxIJX_r8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">
    $('#modal-default').on('hidden.bs.modal', function () {
        callPlayer('yt-player', 'stopVideo');
    });
</script>

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
