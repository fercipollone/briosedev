<?php

  //Buscamos las actividades del Socio
  $actividades = $socios->get_buscarActividadesSocio($_SESSION['ClienteId'],$socio['soc_idSocio']);
  if ($actividades->num_rows > 0)
  {
    ?>
    <br>
    <p class="bg-gray text-muted text-center"><i class="fa fa-futbol-o" aria-hidden="true"></i>&nbsp;Actividades</p>
    <ul class="nav nav-pills nav-stacked">
    <?php
  }

  while ($act = $actividades->fetch_assoc()) 
    {    
  ?>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Actividad:<span class="pull-right"><?php echo $act['act_nombre']; ?></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Ult.Pago:<span class="pull-right"><b><?php echo $act['act_ultimoperiodopago']; ?></b></span></li>
                <li><i class="fa fa-circle-o text-blue">&nbsp;</i>Actualizacion:<span class="pull-right"><?php echo $act['act_ultimaact']; ?></span></li>
                <br>
  <?php 
    }

    if ($actividades->num_rows > 0)
    {
      echo "</ul>";
    }
    $actividades->free();
  ?>    
 

