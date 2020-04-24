<?php

    $email = htmlspecialchars($_POST["email"]); 
    $recaptcha = $_POST["g-recaptcha-response"];

    //echo "Respuesta de Captcha: ".$recaptcha;
 
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
      'secret' => '6LfFfuMUAAAAAAMOvGeIdWp0fTGWwKlgTyuA31Gf',
      'response' => $recaptcha
    );
    $options = array(
      'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    //echo "Respuesta de Captcha: ".$verify;
    $captcha_success = json_decode($verify);
    if ($captcha_success->success) {
      //Humano
      $captcha = true;

    } else {
      // Eres un robot!
      $captcha = false;
      
      header('Location: login.php');
      //die;
    }
    
    require_once("../models/clsUser.php");
    
    $user = new clsUser();
    $resp = $user->ValidarEmail($email, $titulo, $color, $respuesta);
    $user->closeCNX();
?>

<!DOCTYPE html>
<html>

<?php 
  include("headlogin.php");
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
        <br>
        <h4><?php echo($titulo);?></h4>
        <?php echo($respuesta);?>
        <br>
        &nbsp;
    </div>

    <form action="login.php" name="RF" id="RF" method="post" onsubmit="return validateForm()">
    
      <div class="form-group has-feedback">
        <br>
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