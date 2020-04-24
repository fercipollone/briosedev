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
    <p class="login-box-msg">Ingreses sus datos para obtener las credenciales</p>

    <form action="loginregistrar.php" name="RF" id="RF" method="post" onsubmit="return validateForm()">
      <!--
      <div class="form-group has-feedback">
        <input name="email" type="text" class="form-control" placeholder="Nro de Socio">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      -->   
      <div class="form-group has-feedback">

        <select id="cars" name="tipodocumento" id="tipodocumento" class="form-control" required>
          <p class="login-box-msg">Tipo de Documento</p>
          <option value="1">Documento Nacional de Identidad</option>
          <option value="2">Libreta Cívica</option>
          <option value="3">Libreta Enrolamiento</option>
          <option value="4">Documento Extranjero</option>
          <option value="5">CUIT</option>
          <option value="6">CUIL</option>
          <option value="7">Pasaporte</option>
        </select>
      </div>

      <div class="form-group has-feedback">
        <div class="form-item js-form-item form-type-radio js-form-type-radio form-item-sexo js-form-item-sexo radio"> 
          <label for="edit-sexo-f" class="control-label option"><input data-drupal-selector="edit-sexo-f" class="form-radio" type="radio" id="sexo" name="sexo" value="F" required /><span></span> Femenino</label>
          <label for="edit-sexo-m" class="control-label option"><input data-drupal-selector="edit-sexo-m" class="form-radio" type="radio" id="sexo" name="sexo" value="M" checked /><span></span> Masculino</label>
        </div>
      </div>

      <div class="form-group has-feedback">
        <input name="documentonro" id="documentonro" type="number" min="100000" max="90000000" class="form-control" placeholder="Nro de Documento" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="email" id="email" type="email" class="form-control" placeholder="Correo Electronico" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input name="clave" id="clave" type="password" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="reclave" id="reclave" type="password" class="form-control" placeholder="Repetir Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <div class="g-recaptcha" data-sitekey="6LfFfuMUAAAAAGpgx9G3bMqMDSO483cjtCPtIJFh"></div>
      </div>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
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

<script>
    function validateForm() {
      var documentonro = document.forms["RF"]["documentonro"].value;
      re = /^([0-9])*$/;
            
      if(!re.test(documentonro)){
          alert("Solo números, al menos seis digitos");
          document.forms["RF"]["documentonro"].focus();
          return false;
      }

      var email = document.forms["RF"]["email"].value;
      
      if (email != "") {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if(!re.test(email)){
              alert("Formato de Email no valido");
              document.forms["RF"]["email"].focus();
              return false;
          }
      }
      
      var clave = document.forms["RF"]["clave"].value;
      var reclave = document.forms["RF"]["reclave"].value;

      re = /^\w+$/;
      if(!re.test(clave)) {
        alert("La clave no puede utilizar caracteres especiales!");
        document.forms["RF"]["clave"].focus();
        return false;
      }

      if(clave.length < 4) {
        alert("La clave debe contener al menos 4 caracteres");
        document.forms["RF"]["clave"].focus();
        return false;
      }

      /*  
      re = /[0-9]/;
      if(!re.test(clave)) {
        alert("La clave contener al menos un número");
        document.forms["RF"]["clave"].focus();
        return false;
      }
      */
        
      if (clave != reclave) {          
          alert("Las confirmación de la clave debe ser igual a la clave");
          document.forms["RF"]["clave"].focus();
          return false;
      }
  }
</script>

</body>
</html>
