<?php 
    /*
    collection_id=24596116
    collection_status=approved
    external_reference=null
    payment_type=credit_card
    merchant_order_id=1269935139
    preference_id=191146329-7a3c3709-3524-410a-a457-1a15b54efcaf
    site_id=MLA
    processing_mode=aggregator
    merchant_account_id=null
    */

    if(!isset($_GET["collection_status"]))
        {
            $style = "callout callout-warning";
            $titulo = "UPS ! Algo falló";
            $mensaje = "esperabamos la comunicación oficial desde Mercado Pago";
        }
    else
        {
            if($_GET["status"]=="fail")
                {
                    $style = "callout callout-warning";
                    $titulo = "UPS ! Algo falló";
                    $mensaje = "Por favor reintente nuevamente pagar o bien cambie su forma de pago.";
                }
            else
                {
                    $status = $_GET["status"];
                    $idPago = $_GET["idpago"];
                    $collection_id = $_GET["collection_id"];
                    $collection_status = $_GET["collection_status"];
                    $external_reference = $_GET["external_reference"];
                    $payment_type = $_GET["payment_type"];
                    $merchant_order_id = $_GET["merchant_order_id"];
                    $preference_id = $_GET["preference_id"];
                    $site_id = $_GET["site_id"];
                    $processing_mode = $_GET["processing_mode"];
                    $merchant_account_id = $_GET["merchant_account_id"];

                    if (($collection_status == 'approved') && ($status == 'ok'))
                        {
                            $pag_estado = 2;
                            $style = "callout callout-success";
                            $titulo = "Pago exitoso";
                            $mensaje = "Su pago resulto exitosos bajo el ID de Mercado Pago: {$collection_id}.";
                        }
                    else
                        {
                            switch ($status) {
                                case 'ok':
                                    $pag_estado = 2;
                                    $style = "callout callout-success";
                                    $titulo = "Pago exitoso";
                                    $mensaje = "Su pago resulto exitosos bajo el ID de Mercado Pago: {$collection_id}.";
                                    break;
                                case 'fail':
                                    $pag_estado = 0;
                                    $style = "callout callout-warning";
                                    $titulo = "UPS ! Algo falló";
                                    $mensaje = "Por favor reintente nuevamente pagar o bien cambie su forma de pago.";
                                    break;
                                case 'pending':
                                        $pag_estado = 1;
                                        $style = "callout callout-success";
                                        $titulo = "Pago pendiente";
                                        $mensaje = "Su pago esta en estado pendiente bajo el ID de Mercado Pago: {$collection_id}.";
                                        break;
                                default:
                                    $pag_estado = 1;
                                    $style = "callout callout-success";
                                    $titulo = "Pago pendiente";
                                    $mensaje = "Su pago esta en estado pendiente bajo el ID de Mercado Pago: {$collection_id}.";
                            } 
                        }
                    
                    //echo($now);
                    //pag_fechahora = {$now},

                    $qry = "UPDATE pagos SET
                    pag_codigo = '{$collection_status}',
                    pag_estado = {$pag_estado},
                    pag_codigomp = '{$collection_status}',
                    pag_collection_id = '{$collection_id}',
                    pag_payment_type = '{$payment_type}',
                    pag_merchant_order_id = '{$merchant_order_id}',
                    pag_preference_id = '{$preference_id}',
                    pag_site_id = '{$site_id}',
                    pag_processing_mode = '{$processing_mode}',
                    pag_merchant_account_id = '{$merchant_account_id}'
                    WHERE pag_idpago = '{$idPago}'";

                    require_once("../models/clsCuota.php");
                    $cuota = new clsCuota();

                    $cuota->ActualizarPago($qry,$idPago,$pag_estado);
                    $cuota->closeCNX();
                    
                    /*
                    require_once("../models/clsSocio.php");
                    $socio = new clsSocio();
                    $cuota->ActualizarEstado($qry,$idPago,$pag_estado);
                    $cuota->closeCNX();
                    */

                }
        }
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Notificación del pago
        <small>Sede Virtual - Brio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Perfil</a></li>
        <li class="active">-</li>
      </ol>
    </section>
<!-- ******************************************************************************************************************************** -->
<section class="content">
      
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-bullhorn"></i>

            <h3 class="box-title">Notificación</h3>
        </div>
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $LogoFullPath; ?>" alt="logo">
            <h3 class="profile-username text-center"><?php echo $_SESSION['ClienteNombre'];?></h3>
            <p class="text-muted text-center"><?php echo "Su club le agradece por realizar la gestión a traves de esta plataforma." ?></p>
            <p class="text-muted text-center"><?php echo "Recuerde que los datos se van a actualizar una vez que el club procese los datos." ?></p>

            <div class="<?php echo $style; ?>">
            <h4><?php echo $titulo; ?></h4>
            <p><?php echo $mensaje;?></p>
            </div>

            <a href="panel.php?panel=socio" class="btn btn-block btn-default"><b>Volver a la pagina principal</b></a>
        </div>
        <!-- /.box-body -->
        </div>
    </div>
      <!-- /.row (main row) -->    
    </section>
<!-- ******************************************************************************************************************************** -->

