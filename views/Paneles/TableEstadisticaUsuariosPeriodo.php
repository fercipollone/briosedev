<div class="box box-primary">
    
    <!-- ********************************************************************************************************************************************** -->
    <div class="box-header with-border">
        <h3 class="box-title">Lecturas realizadas por Usuarios en el periodo<?php echo $periodo; ?></h3>

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
                <th>Per</th>
                <th>Usu</th>
                <th>Soc</th>
                <th>Lect</th>
                <th>H</th>
                <th>NH</th>
                <th>Sel</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 

            $TotalLecturas = 0;
            $TotalHabilitados = 0;
            $TotalNoHabilitados = 0;
            $TotalSocios = 0;

            while ($fila = $UsuariosLecturas->fetch_assoc()) 
            {    
                echo "<tr>";
                    echo "<td widht >". $fila['Periodo'] . "</td>"; 
                    echo "<td>". $fila['usr_Nombre'] . "</td>"; 
                    echo "<td>". $fila['Socios'] . "</td>"; 
                    echo "<td>". $fila['LecturasTotales'] . "</td>"; 
                    echo "<td>". $fila['Habilitados'] . "</td>"; 
                    echo "<td>". $fila['NoHabilitados'] . "</td>"; 
                    echo "<td>";
                    
                    $TotalNoHabilitados = $TotalNoHabilitados + $fila['NoHabilitados'];
                    $TotalLecturas =  $TotalLecturas + $fila['LecturasTotales'];
                    $TotalHabilitados = $TotalHabilitados + $fila['Habilitados'];
                    $TotalSocios = $TotalSocios + $fila['Socios'];

                    ?>
                    
                    <form action="panel.php?panel=estadisticasusuarios" method="post">
                        <input value="<?php echo $fila['Periodo']; ?>" name="periodo" type="hidden">
                        <input value="<?php echo $fila['usr_Nombre']; ?>" name="usuarionombre" type="hidden">
                        <input value="periodo" name="TipoBusqueda" type="hidden">
                        <input value="<?php echo $idusuario ?>" name="usuario" type="hidden">
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
                    <th>&nbsp;</th>
                    <th><?php echo $TotalSocios; ?></th>
                    <th><?php echo $TotalLecturas; ?></th>
                    <th><?php echo $TotalHabilitados; ?></th>
                    <th><?php echo $TotalNoHabilitados; ?></th>
                    <th>-</th>
                </tr>
            </tfoot>
            </table>
        <!-- FIN -->
        </div>
        <!-- ********************************************************************************************************************************************** -->
    </div>
</div>

