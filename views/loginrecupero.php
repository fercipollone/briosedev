<!DOCTYPE html>
<html>

<?php 
  include("headlogin.php");
  session_destroy();
?>

<style>
  #rc-imageselect, .g-recaptcha {
  display: inline; //the most important
  }
  
  #rc-imageselect{
  max-width: 100%;
  }
  
  .g-recaptcha>div>div{
  width: 100% !important;
  height: 78px;
  transform:scale(0.77); //the code to rescale the captcha obtained in this page
  webkit-transform:scale(0.77);
  text-align: left;
  position: relative;
  }
</style>

<body class="hold-transition login-page">
<div class="login-box" align="center">
  <img src="dist/img/logoBrio.jpg" class="img-circle img-thumbnail text_align:center" alt="User Image">
  <div class="login-logo">
    <b>Brio</b>Sede Virtual
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingreses sus datos para obtener las credenciales</p>

    <form action="loginrecuperoe.php" name="RF" id="RF" method="post" onsubmit="return validateForm()">      

      <div class="form-group has-feedback">
        <input name="email" id="email" type="email" class="form-control" placeholder="Correo Electronico" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <div class="g-recaptcha" data-sitekey="6LfFfuMUAAAAAGpgx9G3bMqMDSO483cjtCPtIJFh"></div>
      </div>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Recuperar</button>
      </div>
    </form>

    <p class="login-box-msg"><a href="login.php">Regresar al login</a></p>

    <!-- <a href="#">Olvide mi password</a>-->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->

<script>
    function validateForm() {
      var email = document.forms["RF"]["email"].value;
      
      if (email != "") {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if(!re.test(email)){
              alert("Formato de Email no valido");
              document.forms["RF"]["email"].focus();
              return false;
          }
      }
  }
</script>

</body>
</html>
