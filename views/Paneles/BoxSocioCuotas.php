<?php
  require_once("../models/clsCuota.php");
  $cuota = new clsCuota();
  $cuotas = $cuota->buscarCuotas($_SESSION['ClienteId'],$_SESSION['Cuotas_Socio_id']);

  if ($cuotas->num_rows > 0)
  {
?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Listado de cuotas</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <!-- Cuadro de Datos -->
            <div class="box-footer no-padding">  
            <br>
              <!-- INICIO -->  
              <table id="cuotas" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th>Socio</th>  
                    <th>Cuota</th>
                    <th>Estado</th>
                    <th>Periodo</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
                     while ($c = $cuotas->fetch_assoc()) 
                     {
                      $estado = "Pendiente";
                      if ($c['cso_estado'] == 2)
                        {
                          $estado = "Pagada";     
                        }     
                      echo "<tr>";
                      echo "<td>{$c['cso_socio']}</td>";
                      echo "<td>{$c['cso_descripcion']}</td>";
                      echo "<td>{$estado}</td>";
                      echo "<td>{$c['cso_periodo']}</td>";
                      echo "<td class=\"text-right\">{$c['cso_importe']}</td>";
                      echo "</tr>";
                     }
                     $cuotas->free();
                  ?>
                </tbody>
                
              </table>

              <!--<form action="panel.php?panel=socios" method="post">-->
              
            </div>
        </div>
    </div>
  
    <!-- DATA TABLE -->
<script>
    function addLoadEvent(func) { 
    var oldonload = window.onload; 
    if (typeof window.onload != 'function') { 
        window.onload = func; 
    } else { 
        window.onload = function() { 
        if (oldonload) { 
            oldonload(); 
        } 
        func(); 
        } 
    } 
    }

    addLoadEvent(function() {
        $(function () {
            $("#cuotas").DataTable(
                {
                    "language": 
                    {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_",
                        "sInfoEmpty":      "Registros del 0 al 0 de un total de 0",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    scrollY:        '50vh',
                    bScrollCollapse: true,
                    paging:         false,
                    fixedHeader:    false,                
                    sScrollX:       '100%',
                }
            );
        });
     });
</script>

<?php
  //cierre del if del count
 }
 else
 {
  include "Paneles/BoxSocioSC.php"; 
 }
 $cuota->closeCNX();
?>