<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Lecturas realizadas en el periodo <?php echo $periodo1 ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
        <!-- INICIO -->  
        
            <table id="TableEstadistica" class="table">
            <thead>
            <tr>
                <th widht="20%">NDía</th>
                <th widht="20%">Día</th>
                <th widht="15%">Socios</th>
                <th widht="15%">Lect</th>
                <th widht="15%">H</th>
                <th widht="15%">NH</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 

            $TotalLecturas = 0;
            $TotalHabilitados = 0;
            $TotalNoHabilitados = 0;
            $TotalSocios = 0;

            while ($fila = $resultado->fetch_assoc()) 
            {    
                echo "<tr>";
                    echo "<td widht >". $fila['ndia'] . "</td>"; 
                    echo "<td>". $fila['nrdia'] . "</td>"; 
                    echo "<td>". $fila['Socios'] . "</td>"; 
                    echo "<td>". $fila['LecturasTotales'] . "</td>"; 
                    echo "<td>". $fila['Habilitados'] . "</td>"; 
                    echo "<td>". $fila['NoHabilitados'] . "</td>"; 
                    //echo "<td>". $fila['soc_idSocio'] . "</td>"; 
                    echo "<td>";
                    ?>
                    <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                    
                    <?php

                    echo "</td>";
                echo "</tr>";

                $TotalNoHabilitados = $TotalNoHabilitados + $fila['NoHabilitados'];
                $TotalLecturas =  $TotalLecturas + $fila['LecturasTotales'];
                $TotalHabilitados = $TotalHabilitados + $fila['Habilitados'];
                $TotalSocios = $TotalSocios + $fila['Socios'];

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
            </tr>
            </tfoot>
            </table>
        <!-- FIN -->
        </div>
    </div>
</div>

  