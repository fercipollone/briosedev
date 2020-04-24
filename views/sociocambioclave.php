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
      &nbsp;&nbsp;Cambio de clave 
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Clave</a></li>
        <li class="active">-</li>
      </ol>
    </section>

<section class="content">
      <!-- ******************************************************************************************************************************** -->
      <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form action="panel.php?panel=clavec" name="RF" id="RF" method="post" onsubmit="return validateForm()">
                        
            <div class="form-group has-feedback">
              <input name="claveant" id="claveant" type="password" class="form-control" placeholder="Contraseña actual" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
              <input name="clave" id="clave" type="password" class="form-control" placeholder="Contraseña nueva" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <input name="reclave" id="reclave" type="password" class="form-control" placeholder="Repetir contraseña nueva" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Cambiar</button>
            </div>
          </form>
        </div>
      </div>

      <!-- /.row (main row) -->    
    </section>

<script>
    function validateForm() {      
      var claveant = document.forms["RF"]["claveant"].value;
      var clave = document.forms["RF"]["clave"].value;
      var reclave = document.forms["RF"]["reclave"].value;

      re = /^\w+$/;
      if(!re.test(claveant)) {
        alert("La clave no puede utilizar caracteres especiales!");
        document.forms["RF"]["claveant"].focus();
        return false;
      }

      if(claveant.length < 4) {
        alert("La clave debe contener al menos 4 caracteres");
        document.forms["RF"]["claveant"].focus();
        return false;
      }

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

      if (clave == claveant) {          
          alert("La nueva clave no puede ser igual que la anterior");
          document.forms["RF"]["clave"].focus();
          return false;
      }
  }
</script>