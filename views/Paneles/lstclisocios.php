<?php
  require_once("../models/clsListado.php");
  $est = new clsListado();
  $re = $est->listado_socios($_SESSION['ClienteId']);
?>
  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Socios Activos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
      </div>
      <div class="box-body">
          <!-- Cuadro de Datos -->
          <div class="box-footer no-padding">

            <!-- INICIO -->  
            <table id="cuotas" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>Editar</th>  
                  <th>Nombre</th>  
                  <th>Tipo Doc.</th>
                  <th>Nro. Doc.</th>
                  <th>Sexo</th>
                  <th>Usuario</th>
                  <th>Email</th>
                  <th>Habilitacion</th>
                </tr>
              </thead>
              
              <tbody>
                <?php
                    while ($c = $re->fetch_assoc()) 
                    {    
                    echo "<tr>";
                      echo "<td>";
                      ?>
                      
                      <form action="panel.php?panel=list&i=msu" method="post">
                          <input value="<?php echo $c['soc_idsocio'] ?>" name="idsocio" id="idsocio" type="hidden">
                          <input value="<?php echo $c['cli_idcliente'] ?>" name="idcliente" id="idcliente" type="hidden">
                          <button type="submit" class="btn btn-primary btn-sm">editar</button>
                      </form>
                      
                      <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                      
                      <?php

                      echo "</td>";
                      echo "<td>{$c['soc_apellidoynombre']}</td>";
                      echo "<td>{$c['tid_idtipodocumento']}</td>";
                      echo "<td>{$c['soc_documento']}</td>";
                      echo "<td>{$c['soc_sexo']}</td>";
                      echo "<td>{$c['usr_Nombre']}</td>";
                      echo "<td>{$c['usr_Email']}</td>";
                      echo "<td>{$c['hab_nombre']}</td>";
                    echo "</tr>";
                    }
                    $re->free();
                    $est->closeCNX();
                ?>
              </tbody>
              
              <tfoot>
                <tr>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                  <th class="text-right"></th>
                </tr>
              </tfoot>
              
            </table>
            
          </div>
      </div>
  </div>

<?php include "Paneles/datatableopt.html"; ?>
 
