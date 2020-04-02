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
        
            <table id="TableUsuarios" class="table table-responsive table-bordered table-hover">
            <thead>
            <tr>
                <th widht="29%">Nombre</th>
                <th widht="30%">Email</th>
                <th widht="20%">Cliente</th>
                <th widht="5%">Hab.Cert.</th>
                <th widht="5%">Hab.Temp.</th>
                <th widht="5%">Hab.Emba.</th>
                <th widht="5%">Super Usuario</th>
                <th widht="1%">Sel</th>
            </tr>
            </thead>

            <tbody>
            
            <?php 
            while ($fila = $resultado->fetch_assoc()) 
            {    
                echo "<tr>";
                    echo "<td widht >". $fila['usr_Nombre'] . "</td>"; 
                    echo "<td>". $fila['usr_Email'] . "</td>"; 
                    echo "<td>". $fila['cli_Nombre'] . "</td>"; 
                    echo "<td>". $fila['usr_HabilitaCertMed'] . "</td>"; 
                    echo "<td>". $fila['usr_HabilitaTempPileta'] . "</td>"; 
                    echo "<td>". $fila['usr_HabilitaEmbarque'] . "</td>"; 
                    echo "<td>". $fila['usr_SuperUsuario'] . "</td>"; 
                    echo "<td>";
                    ?>
                    
                    <form action="panel.php?panel=usuario" method="post">
                        <input value="<?php echo $fila['usr_idUsuario'] ?>" name="busqueda" type="hidden">
                        <input value="id" name="Mod" type="hidden">
                        <button type="submit" class="btn btn-primary btn-sm">Ver</button>
                    </form>
                    
                    <!-- <a href="panel.php?panel=socios&id=<?php //echo $fila['soc_idSocio'] ?>"><i class="fa fa-search"></i></a>-->
                    
                    <?php

                    echo "</td>";
                echo "</tr>";
            }
            ?>
            <tfoot>
            <tr>
                <th widht="29%">Nombre</th>
                <th widht="30%">Email</th>
                <th widht="20%">Cliente</th>
                <th widht="5%">Hab.Cert.</th>
                <th widht="5%">Hab.Temp.</th>
                <th widht="5%">Hab.Emba.</th>
                <th widht="5%">Super Usuario</th>
                <th widht="1%">Sel</th>
            </tr>
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
            $("#TableUsuarios").DataTable();
        });
     });
</script>

