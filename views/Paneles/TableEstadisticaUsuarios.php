<div class="box box-primary">
    
    <!-- ********************************************************************************************************************************************** -->
    <div class="box-header with-border">
        <h3 class="box-title">Usuarios</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    
    <!-- ********************************************************************************************************************************************** -->

    <div class="box-body">
    
        <!-- ********************************************************************************************************************************************** -->
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
        <!-- INICIO -->  
        
            <table id="TableEstadisticaUsuario" class="table">
            <thead>
            <tr>
                <th>Usu</th>
                <th>Lect</th>
                <th>Sel</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 

            $TotalLecturas = 0;

            while ($fila = $UsuariosLecturas->fetch_assoc()) 
            {    
                echo "<tr>";
                    echo "<td widht >". $fila['nombre'] . "</td>"; 
                    echo "<td>". $fila['lecturas'] . "</td>"; 
                    echo "<td>";
                    
                    $TotalLecturas =  $TotalLecturas + $fila['lecturas'];
                    ?>
                    
                    <form action="panel.php?panel=estadisticasusuarios" method="post">
                        <input value="<?php echo $fila['id']; ?>" name="usuario" type="hidden">
                        <input value="<?php echo $fila['nombre']; ?>" name="usuarionombre" type="hidden">
                        <input value="usuario" name="TipoBusqueda" type="hidden">
                        <button type="submit" class="btn btn-primary btn-sm">Ver</button>
                    </form>
                    
                    <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                    
                    <?php

                    echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Tot</th>
                    <th><?php echo $TotalLecturas; ?></th>
                    <th>-</th>
                </tr>
            </tfoot>
            </table>
        <!-- FIN -->
        </div>
        <!-- ********************************************************************************************************************************************** -->
    </div>
</div>

