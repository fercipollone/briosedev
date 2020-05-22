<?php

//datos del arhivo
$nombre_archivo = $_FILES['uploadedFile']['name'];
$tipo_archivo = $_FILES['uploadedFile']['type'];
$tamano_archivo = $_FILES['uploadedFile']['size'];

$path = 'import/'.$nombre_archivo;
$upload = false;

//print_r($_FILES['uploadedFile']);
//echo "<br>";

//compruebo si las características del archivo son las que deseo
if (!($tipo_archivo == "application/vnd.ms-excel") && ($tamano_archivo < 100000)) 
//if (!(strpos($tipo_archivo, "application/vnd.ms-excel"))) 
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
else	
	{
		echo "Mensaje: ".$mensaje;
		echo "<br>";
		echo "Tipo Archivo: ".$tipo_archivo;
		echo "<br>";
		echo "Tamaño Archivo: ".$tamano_archivo;
		echo "<br>";
		echo "Nombre Archivo: ".$nombre_archivo;
	}
?>
