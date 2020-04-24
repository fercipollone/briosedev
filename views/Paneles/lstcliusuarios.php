<?php
  require_once("../models/clsListado.php");
  $est = new clsListado();
  $re = $est->listado_usuarios($_SESSION['ClienteId']);
?>
  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Usuarios</h3>

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
                  <th>Nombre</th>  
                  <th>Tipo Doc.</th>
                  <th>Nro. Doc.</th>
                  <th>Sexo</th>
                  <th>Usuario</th>
                  <th>Clave</th>
                  <th>Email</th>
                  <th>Habilitacion</th>
                </tr>
              </thead>
              
              <tbody>
                <?php
                    while ($c = $re->fetch_assoc()) 
                    {    
                    echo "<tr>";
                    echo "<td>{$c['soc_apellidoynombre']}</td>";
                    echo "<td>{$c['tid_idtipodocumento']}</td>";
                    echo "<td>{$c['soc_documento']}</td>";
                    echo "<td>{$c['soc_sexo']}</td>";
                    echo "<td>{$c['usr_Nombre']}</td>";
                    echo "<td>{$c['usr_Clave']}</td>";
                    echo "<td>{$c['usr_Email']}</td>";
                    echo "<td>{$c['hab_nombre']}</td>";
                    echo "</tr>";
                    }
                    $re->free();
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
                    sScrollX:       '100%',
                    bScrollCollapse: true,
                    paging:         true,
                    fixedHeader:    true                
                }
            );
        });
     });
</script>

<?php
 $est->closeCNX();
?>