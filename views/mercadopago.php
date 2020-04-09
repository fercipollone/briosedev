<?php 
    
    $total = $_POST["total"];
    $idPago = $_POST["idpago"];
    //Public key:TEST-2dfe9093-45b9-4d51-a62d-4cb902900fa3
    //Access token:TEST-4894412528296064-032019-3e678973a1d197c23968b58e589b5edb-191146329

    include_once("../vendor/autoload.php");

    //MercadoPago\SDK::setClientId("4894412528296064");
    //MercadoPago\SDK::setClientSecret("teJqTVnT9XmmPfuJTLnKPLFzXVzZIvBp");

    MercadoPago\SDK::setAccessToken('TEST-4894412528296064-032019-3e678973a1d197c23968b58e589b5edb-191146329');

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();
    $urlback = "https://softwareclubes.com.ar/briosedev/views/panel.php?panel=mercado&idpago={$idPago}";

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = $_SESSION['ClienteNombre'] . ' PAGO CUOTAS SOCIO ' . $_SESSION['SocioNombre'] .  $total;
    $item->quantity = 1;
    $item->unit_price = $total;
    $preference->items = array($item);
    $preference->back_urls = array(
        "success" => "{$urlback}&status=ok",
        "failure" => "{$urlback}&status=fail",
        "pending" => "{$urlback}&status=pending"
    );
    $preference->auto_return = "approved";
    $preference->save();
    
    //echo "<a href='$preference->sandbox_init_point'>PAGAR</a>";
    header('Location:'.$preference->sandbox_init_point,true,301);
?>

