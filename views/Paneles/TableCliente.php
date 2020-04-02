<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Clientes encontrados</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>


    <div class="box-body">
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
        <!-- INICIO -->  
        
            <table id="TableClientes" class="table table-responsive table-bordered table-hover">
            <thead>
            <tr>
                <th widht="1%">Sel</th>
                <th widht="73%">Nombre</th>
                <th widht="5%">Id</th>
                <th widht="10%">Ult.Act.</th>
                <th widht="10%">Socios</th>
                <th widht="1%">Del</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 
            while ($fila = $resultado->fetch_assoc()) 
            {    
                echo "<tr>";

                    ?>

                    <td>    
                        <form action="panel.php?panel=clienteABM" method="post">
                            <input value="<?php echo $fila['cli_idCliente'] ?>" name="id" type="hidden">
                            <input value="editar" name="accion" type="hidden">
                            <button type="submit" class="btn btn-primary btn-sm">Ver</button>
                        </form>
                    </td>
                    <?php
                    echo "<td widht >". $fila['cli_Nombre'] . "</td>"; 
                    echo "<td>". $fila['cli_idCliente'] . "</td>"; 
                    echo "<td>". $fila['ultAct'] . "</td>"; 
                    echo "<td>". $fila['cantidad'] . "</td>"; 
                    echo "<td>";
                    ?>

                        <form action="panel.php?panel=clienteABM" method="post">
                            <input value="<?php echo $fila['cli_idCliente'] ?>" name="id" type="hidden">
                            <input value="eliminar" name="accion" type="hidden">
                            <button type="submit" class="btn btn-primary btn-danger">Del</button>
                        </form>
                        <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                    </td>
                </tr>
            <?php
            }
            ?>
            <tfoot>
                <th widht="1%">Sel</th>
                <th widht="73%">Nombre</th>
                <th widht="5%">Id</th>
                <th widht="10%">Ult.Act.</th>
                <th widht="10%">Socios</th>
                <th widht="1%">Del</th>
            </tfoot>
            </table>
        <!-- FIN -->
        </div>
    </div>
</div>

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
            $("#TableClientes").DataTable();
        });
     });
</script>
  