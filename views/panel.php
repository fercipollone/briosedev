<?php 
	$panel = $_GET['panel'];

	switch ($panel) 
	{
		//Usuarios Socios ---------------------------------------
		case "socio":
			$page_content = 'socioperfil.php';
			break;
		//Super Usuarios ----------------------------------------
		case "estadisticas":
			$page_content = 'estadisticas.php';
			break;
		case "estadisticasusuarios":
			$page_content = 'estadisticasusuarios.php';
			break;
		case "import":
			$page_content = 'import.php';
			break;
		case "socios":
			$page_content = 'buscarSocios.php';
			break;
		case "clientes":
			$page_content = 'clientes.php';
			break;
		case "clienteABM":
				$page_content = 'clientesABM.php';
				break;
		case "usuarios":
			$page_content = 'usuarios.php';
			break;
		case "mercado":
			$page_content = 'mercadopago.php';
		default:
			$page_content = 'indicadoresGlobales.php';
			break;
	}
	include "template.php";

	/*
		case "sociosqr":
		$page_content = 'buscarSociosqr.php';
		break;
	*/
?>

