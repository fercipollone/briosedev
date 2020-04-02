<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


<?php
    require_once("../models/clsCliente.php");

    $Cliente = new clsCliente();
    $Mensaje = "Clientes: ";
    $data = 0;
    
    /* Atajo todos los envio de los POST */
    if(isset($_POST["cli_idCliente"])){$Cliente->$cli_idcliente = $_POST["cli_idCliente"];}
    if(isset($_POST["cli_Nombre"])){$Cliente->$cli_Nombre = $_POST["cli_Nombre"];}
    if(isset($_POST["cli_Logo"])){$Cliente->$cli_Logo = $_POST["cli_Logo"];}
    if(isset($_POST["cli_FechaFundacion"])){$Cliente->$cli_FechaFundacion = $_POST["cli_FechaFundacion"];}
    if(isset($_POST["cli_FotoPath"])){$Cliente->$cli_FotoPath = $_POST["cli_FotoPath"];}
    if(isset($_POST["cli_XMLFileName"])){$Cliente->$cli_XMLFileName = $_POST["cli_XMLFileName"];}   
    /* Fin de los POST */

    if(isset($_POST["accion"]))
        {
            $accion = $_POST["accion"];
            $id = $_POST["id"];
            //$accion = "Accion: " . $filtro;
        }
    else
        {
            $accion = "nada";        
        }

    switch ($accion) {
        case "agregar":
            $accion = "insert";
            break;
        case "editar":
            /* Recupero de la base de datos el dato del cliente */
            $resultado = $Cliente->get_cliente($id);
            if ($resultado->num_rows > 0)
                {
                    $fila = $resultado->fetch_assoc();
                    $data = 1;
                    $accion = "update";
                }    
            break;
        case "eliminar":
            /* Elimino el registro que coincide con el ID */
            break;
        case "insert":
            $Cliente->Agregar();
            break;
        case "update":
            $Cliente->Actualizar();
            break;
        default:
            echo "NADA";
            break;
    }
    
?>

      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Administración de Clientes
        <small>CRUD Clientes - IMS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Información de clientes</a></li>
        <li class="active">-</li>
      </ol>
    </section>
    <?php echo "Accion:" . $accion; ?>
    <?php echo "Id:" . $id; ?>
    <!-- ******************************************************************************************************************************** -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Alta Cliente</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="panel.php?panel=clienteABM" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="cli_idCliente">Identificador</label>
                            <input 
                                type="number" class="form-control" id="cli_idCliente" placeholder="Ingrese el Id" 
                                <?php if ($data = 1){echo "value='" . $fila['cli_idCliente'] . "'";}?>
                            >
                                
                        </div>

                        <p class="help-block">Recuerde que el Id debe concordar con el cfg_idCliente en la Base de Brio</p>
                        
                        <div class="form-group">
                            <label for="cli_Nombre">Nombre</label>
                            <input 
                                type="text" class="form-control" id="cli_Nombre" placeholder="Ingrese el Nombre del Club" 
                                <?php if ($data = 1){echo "value='" . $fila['cli_Nombre'] . "'";}?>
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="cli_Logo">Logo</label>
                            <input 
                                type="text" class="form-control" id="cli_Logo" placeholder="Ingrese el nombre del archivo del logo" 
                                <?php if ($data = 1){echo "value='" . $fila['cli_Logo'] . "'";}?>
                            >
                        </div>

                        <div class="form-group">
                            <label for="cli_FechaFundacion">Fecha Fundación</label>
                            <input 
                                type="date" class="form-control" id="cli_FechaFundacion" placeholder="Ingrese la fecha de fundación DD/MM/AAAA" 
                                <?php if ($data = 1){echo "value='" . $fila['cli_FechaFundacion'] . "'";}?>
                            >
                        </div>

                        <div class="form-group">
                            <label for="cli_FotoPath">Directorio fotos</label>
                            <input 
                                type="text" class="form-control" id="cli_FotoPath" placeholder="nombre de la carpeta donde se alojan las fotos"
                                <?php if ($data = 1){echo "value='" . $fila['cli_FotoPath'] . "'";}?>
                            >
                        </div>

                        <div class="form-group">
                            <label for="cli_XMLFileName">Archivo de Datos XML</label>
                            <input 
                                type="text" class="form-control" id="cli_XMLFileName" placeholder="Nombre del archivo XML que sube la información" 
                                <?php if ($data = 1){echo "value='" . $fila['cli_XMLFileName'] . "'";}?>
                            >
                        </div>

                        <!--

                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">

                        <div class="checkbox">
                        <label>
                            <input type="checkbox"> Check me out
                        </label>
                        </div>

                        -->
                    </div>

                    <div class="box-footer">
                        <input value="<?php echo $fila['cli_idCliente'] ?>" name="id" type="hidden">
                        <input value="<?php echo $accion;?>" name="accion" type="hidden">
                        <button type="submit" class="btn btn-primary btn-success btn-lg">&nbsp;&nbsp;&nbsp;GUARDAR&nbsp;&nbsp;&nbsp;</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-primary btn-lg" onClick="window.history.back()">CANCELAR</button>
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
            <!-- End Form -->
        </div>
        <!-- /.box -->
    </section>
</div>