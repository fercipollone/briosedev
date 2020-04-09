<?php

//datos del arhivo
$nombre_archivo = $_FILES['uploadedFile']['name'];
$tipo_archivo = $_FILES['uploadedFile']['type'];
$tamano_archivo = $_FILES['uploadedFile']['size'];

$path = 'import/'.$nombre_archivo;
$upload = false;

//compruebo si las características del archivo son las que deseo
if (!(strpos($tipo_archivo, "application/vnd.ms-excel")) && ($tamano_archivo < 100000)) 
	{
   		$mensaje = "La extensión o el tamaño de los archivos no es correcta ".$tipo_archivo;
	}
	else
	{
	   if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $path))
			{
				$mensaje = "El archivo ha sido cargado correctamente.";
				$upload = true;  
			}
		else
			{
      			$mensaje = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
   			}
	}

if ($upload)
	{
		$page_content = 'importcuotas.php';
		include "template.php";
	}
?>
