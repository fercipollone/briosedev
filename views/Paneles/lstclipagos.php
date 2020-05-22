<?php
  require_once("../models/clsListado.php");
  $est = new clsListado();
  $re = $est->listado_pagos($_SESSION['ClienteId']);
?>
  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Pagos</h3>

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
                  <th>Fecha Pago</th>  
                  <th>Periodo</th>
                  <th>Socio</th>
                  <th>Nro.Doc.</th>
                  <th>MP ID</th>
                  <th>Estado</th>
                  <th>Monto</th>
                </tr>
              </thead>
              
              <tbody>
                <?php
                    while ($c = $re->fetch_assoc()) 
                    {    
                    echo "<tr>";
                    echo "<td>{$c['fechapago']}</td>";
                    echo "<td>{$c['periodopago']}</td>";
                    echo "<td>{$c['socionombre']}</td>";
                    echo "<td>{$c['documento']}</td>";
                    echo "<td>{$c['mercadopago_id']}</td>";
                    echo "<td>{$c['estaodopago']}</td>";
                    echo "<td class='text-right'>{$c['pagomonto']}</td>";
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
                </tr>
              </tfoot>
              
            </table>
            
          </div>
      </div>
  </div>
  
<?php include "Paneles/datatableopt.html"; ?>