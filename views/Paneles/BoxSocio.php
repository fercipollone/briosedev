<?php

  //echo strtotime(date("Ymd"));
  //echo "</br>";
  //echo time();
  //echo "</br>";
  //echo strtotime($socio['soc_fechatopehabilitacion']);
  //echo "</br>";
  
  //$fotoPath = "dist/img/socios/" . $socio['soc_foto'];
  $fotoPath = "dist/img/socios/" . $_SESSION['ClienteFotoPath'] . "/" . $socio['soc_foto'];
  //echo("fotopath:" . $fotoPath);

  //Ultimo Periodo Pago 
  $ultimoPeriodoPago = substr ($socio['soc_ultimoperiodopago'],4,2) . "/" . substr ($socio['soc_ultimoperiodopago'],0,4);

  if (!file_exists($fotoPath)) 
    {
      $fotoPath = "dist/img/socios/usuario.jpg";
    } 
    
  if (strtotime($socio['soc_fechatopehabilitacion']) >= strtotime(date("Ymd")))
    {
      $classEstado = "label label-success";
      $classImg = "online";
      $habilitado = 1;
      $leyenda = "INGRESO PERMITIDO";
      $bg = "bg-green";
    }
   else
    {
      $classEstado = "label label-danger";
      $classImg = "offline";
      $habilitado = 0;
      $leyenda = "NO HABILITADO PARA INGRESAR";
      $bg = "bg-red-active";
    } 
  
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del Socio</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
              <p class="<?php echo $classEstado; ?>"><?php echo ($socio['ses_descripcion'] . " - " .  $leyenda); ?></p>
              <p>&nbsp;</p>
              <p class="login-box-msg">
                <!-- <img src="dist/img/socios/20329530.jpg" class="img-circle img-socio text_align:center online" alt="Socio"> -->
                <!-- <img src="dist/img/socios/20329530.jpg" class="img-circle img-socio text_align:center offline" alt="Socio"> -->
                <img src="<?php echo $fotoPath; ?>" class="img-thumbnail img-socio text_align:center <?php echo $classImg; ?>" alt="Socio"> 
              </p>
              
              <h2 class="profile-username text-center"><?php echo $socio['soc_apellidoynombre']; ?></h2>
              <p class="text-muted text-center"><?php echo $socio['cat_descripcion']; ?></p>
              <p class=" <?php echo $bg; ?> text-muted text-center"><?php echo ("U.P.Pago: <b>" . $ultimoPeriodoPago . "</b>"); ?></p>
                            
              <ul class="nav nav-pills nav-stacked">
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Nro.Socio:<span class="pull-right"><?php echo $socio['soc_nrosocio']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Documento:<span class="pull-right"><?php echo $socio['soc_documento']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Domicilio:<span class="pull-right"><?php echo $socio['soc_domicilio']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Edad:<span class="pull-right"><?php echo $socio['soc_edad']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Fecha Maxima:<span class="pull-right"><?php echo $socio['soc_fechatopehabilitacion']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Fecha Ingreso:<span class="pull-right"><?php echo $socio['soc_fechaalta']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Actualizacion:<span class="pull-right"><?php echo $socio['soc_ultimaact']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Datos Adicionales:<span class="pull-right">&nbsp;</span></li>
              </ul>
              <h3 class="text-muted text-center"><?php echo $socio['soc_accesos']; ?></h3>


              <?php 
                if (strtotime($socio['soc_fechaAptoMedico']) >= strtotime(date("Ymd")))
                {
                  $classEstado = "label label-success";
                  $classImg = "online";
                  $habilitadoAM = 1;  
                  $leyendaAM = "INGRESO PERMITIDO";
                  $bg = "bg-green";
                }
              else
                {
                  $classEstado = "label label-danger";
                  $classImg = "offline";
                  $habilitadoAM = 0;
                  $leyendaAM = "NO HABILITADO PARA INGRESAR";
                  $bg = "bg-red-active";
                } 
                  $leyenda = $leyendaAM;
              ?>

              <p class="<?php echo $bg; ?> text-muted text-center"><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp;Apto Médico</p>
              <ul class="nav nav-pills nav-stacked">
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Estado:<span class="pull-right"><?php echo $socio['ecm_Descripcion']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Vencimiento:<span class="pull-right"><?php echo $socio['soc_fechaAptoMedico']; ?></span></li>
              </ul>
              
              <?php include "Paneles/BoxActividades.php" ?>   
        </div>
    </div>
      <!-- /.box-body -->


    
</div>