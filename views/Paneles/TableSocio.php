<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Socios encontrados</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>


    <div class="box-body">
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
        <!-- INICIO -->  
        
            <table id="TableSocios" class="table table-responsive table-bordered table-hover">
            <thead>
            <tr>
                <th widht="10%">Nro</th>
                <th widht="85%">Nombre</th>
                <th widht="5%">Sel</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 
            while ($fila = $resultado->fetch_assoc()) 
            {    
                echo "<tr>";
                    echo "<td widht >". $fila['soc_nrosocio'] . "</td>"; 
                    echo "<td>". $fila['soc_apellidoynombre'] . "</td>"; 
                    //echo "<td>". $fila['soc_idSocio'] . "</td>"; 
                    echo "<td>";
                    ?>
                    
                    <form action="panel.php?panel=socios" method="post">
                        <input value="<?php echo $fila['soc_idSocio'] ?>" name="busqueda" type="hidden">
                        <input value="id" name="TipoBusqueda" type="hidden">
                        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                    </form>
                    
                    <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                    
                    <?php

                    echo "</td>";
                echo "</tr>";
            }
            ?>
            <tfoot>
            <tr>
                <th>Nro</th>
                <th>Nombre</th>
                <th>Sel</th>
            </tr>
            </tfoot>
            </table>
        <!-- FIN -->
        </div>
    </div>
</div>

  