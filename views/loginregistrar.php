<?php
    
    $tipodocumento = htmlspecialchars($_POST["tipodocumento"]); 
    $sexo = htmlspecialchars($_POST["sexo"]); 
    $documentonro = htmlspecialchars($_POST["documentonro"]); 
    $email = htmlspecialchars($_POST["email"]); 
    $clave = htmlspecialchars($_POST["clave"]); 
    
    /*
    echo("Tipo Documento: " . $tipodocumento);
    echo("Documento: " . $documentonro);
    echo("sexo: " . $sexo);
    echo("email: " . $email);
    echo("clave: " . $clave);
    */
    
    require_once("../models/clsUser.php");
    
    $user = new clsUser();
    $resp = $user->ValidarUsuarioNuevo($tipodocumento, $documentonro, $sexo, $respuesta, $email, $clave, $color, $titulo);
    $user->closeCNX();
?>

<!DOCTYPE html>
<html>

<?php 
  include("head.php");
  session_destroy();
?>

<body class="hold-transition login-page">
<div class="login-box" align="center">
  <img src="dist/img/logoBrio.jpg" class="img-circle img-thumbnail text_align:center" alt="User Image">
  <div class="login-logo">
    <b>Brio</b>Sede Virtual
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Resultado de la solicitud de credenciales</p>

    <div class="<?php echo($color);?>">
        <h4><?php echo($titulo);?></h4>
        <?php echo($respuesta);?>
    </div>

    <form action="login.php" name="RF" id="RF" method="post" onsubmit="return validateForm()">
    
      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Volver al incio de sesión</button>
      </div>

    </form>

    <!-- <a href="#">Olvide mi password</a>-->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>


</body>
</html>