<?php
    require_once("../models/clsUser.php");
    $clsUser = new clsUser();

    if(!isset($_POST["idsocio"]))
        {
            echo "No hay datos para mostrar";
            echo "<br>";
            echo "<br>";
            echo "<a href='panel.php?panel=list&i=usu'>Volver al listado</a>"; 
            die();
        }

    $idsocio = $_POST["idsocio"];
    $idcliente = $_POST["idcliente"];

    //echo "Socio_id: " . $idsocio;
    //echo "<br>";
    //echo "Cliente_id: ".$idcliente;

    if (isset($_POST["accion"]))
        {
            $email = $_POST["email"];
            $clsUser->cambiaremail($email, $idcliente, $idsocio, $respuesta);
            echo $respuesta;
        }

    $usuario = $clsUser->get_UsuarioSocio($idcliente, $idsocio);
    $d = $usuario->fetch_assoc();
?>
  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Modificar Usuario</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
      </div>
      
      <div class="box-body">
          
        <form role="form" id="RF" name="RF" action="panel.php?panel=list&i=msu" method="post" onsubmit="return validateForm()">
      
            <div class="form-group">
                <label for="socio">Socio</label>
                <input type="text" class="form-control" id="socio" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['soc_apellidoynombre'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="tipodoc">Tipo Doc.</label>
                <input type="text" class="form-control" id="tipodoc" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['tid_idtipodocumento'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="nrodoc">Nro. Doc</label>
                <input type="text" class="form-control" id="nrodoc" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['soc_documento'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo</label>
                <input type="text" class="form-control" id="sexo" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['soc_sexo'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['usr_Nombre'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $d['usr_Email'];?>">
            </div>

            <div class="form-group">
                <label for="habilitacion">Habilitacion</label>
                <input type="text" class="form-control" id="habilitacion" placeholder="Ingrese Apellido Nombre" value="<?php echo $d['hab_nombre'];?>" readonly>
            </div>

            <div class="box-footer">
                <input value="<?php echo $idcliente ?>" name="idcliente" id="idcliente" type="hidden">
                <input value="<?php echo $idsocio ?>" name="idsocio" id="idsocio" type="hidden">
                <input value="save" name="accion" id="accion" type="hidden">
                <button type="submit" class="btn btn-primary btn-success btn-lg">&nbsp;&nbsp;&nbsp;GUARDAR&nbsp;&nbsp;&nbsp;</button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-primary btn-lg" onClick="window.history.back()">CANCELAR</button>
            </div>
        
        </form>
    </div>
<?php
 $usuario->free();
 $clsUser->closeCNX();
?>

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