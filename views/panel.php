
<?php 

$panel = "";
if (isset($_GET['panel']))
    {
		$panel = $_GET['panel'];
	}

switch ($panel) 
	{
		case "list":
			$page_content = 'listados.php';
			break;
		//Usuarios Socios ---------------------------------------
		case "socio":
			$page_content = 'socioperfil.php';
			break;
		case "mercado":
			#si cambia el nombre hay que cambiar en el template por la validacion del foward en el template.php
			$page_content = 'mercadopagor.php';
			break;
		case "cuotas":
			$page_content = 'sociocuotas.php';
			break;
		case "pagos":
			$page_content = 'sociopagos.php';
			break;
		case "clave":
			$page_content = 'sociocambioclave.php';
			break;
		case "clavec":
			$page_content = 'sociocambiarclave.php';
			break;
		//Usuarios Admin ----------------------------------------
		case "importcuotas":
			$page_content = 'importcuotasupload.php';
			break;
		case "import":
			$page_content = 'import.php';
			break;
		case "exportpagos":
			$page_content = 'pagosexport.php';
			break;
		case "estadisticas":
			$page_content = 'estadisticas.php';
			break;
		case "pagosdown":
			$page_content = 'pagosdown.php';
			break;
		//Super Usuarios ----------------------------------------
		case "estadisticasusuarios":
			$page_content = 'estadisticasusuarios.php';
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
		default:
			$page_content = 'default.php';
			break;
	}
	// **********************************************************************************************************
	include "template.php";
	// **********************************************************************************************************

/*
	$panel = $_GET['panel'];

	// **********************************************************************************************************
	if ($_SESSION['TipoUsuario']=='Socio')
		{
			switch ($panel) 
			{
				case "list":
					$page_content = 'listados.php';
					break;
				//Usuarios Socios ---------------------------------------
				case "socio":
					$page_content = 'socioperfil.php';
					break;
				case "mercado":
					$page_content = 'mercadopagor.php';
					break;
				case "cuotas":
					$page_content = 'sociocuotas.php';
					break;
				case "pagos":
					$page_content = 'sociopagos.php';
					break;
				default:
					$page_content = 'indicadoresGlobales.php';
					break;
			}
		}
	
	// **********************************************************************************************************
	if ($_SESSION['TipoUsuario']=='Admin')
		{
			switch ($panel) 
			{
				case "list":
					$page_content = 'listados.php';
					break;
				//Usuarios Admin ----------------------------------------
				case "importcuotas":
					$page_content = 'importcuotasupload.php';
					break;
				case "import":
					$page_content = 'import.php';
					break;
				case "exportpagos":
					$page_content = 'pagosexport.php';
					break;
				case "estadisticas":
					$page_content = 'estadisticas.php';
					break;
				case "pagosdown":
					$page_content = 'pagosdown.php';
					break;
				default:
					$page_content = 'indicadoresGlobales.php';
					break;
			}
		}
	
	// **********************************************************************************************************
	if ($_SESSION['TipoUsuario']=='SuperUsuario')
		{
			switch ($panel) 
			{
				case "list":
					$page_content = 'listados.php';
					break;
				//Super Usuarios ----------------------------------------
				case "estadisticasusuarios":
					$page_content = 'estadisticasusuarios.php';
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
				default:
					$page_content = 'indicadoresGlobales.php';
					break;
			}
		}
	// **********************************************************************************************************
	include "template.php";
	// **********************************************************************************************************
*/
?>

