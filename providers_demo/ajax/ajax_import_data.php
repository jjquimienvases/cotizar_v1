<?php
include '../conexion.php';

$order = $_POST['orders'];
$bodega = $_POST['bodega'];
$factura = $_POST['factura'];
$proveedor = $_POST['provider'];
$result = $_POST['result_'];
$estado = "credito";
$total = 0;
$demo_total = str_replace("$", "", $result);
$total_demo = str_replace(",", "", $demo_total);
$total = floatval($total_demo);
$file = $_FILES['file']['name'];
$ruta=$_FILES['file']['tmp_name'];
/* $destino= __DIR__.DIRECTORY_SEPARATOR."files".DIRECTORY_SEPARATOR.$file;
 */$destino = "../files/".$file;


 $directorio = '../files/';

 $nombre=$_FILES['file']['name'];
 $guardado=$_FILES['file']['tmp_name'];
 
 $ImageName = $_FILES['file']['name'];
 $fileElementName = 'file';
 $path = '/var/www/html/our-project/providers_demo/files/'; 
 $location = $path . $_FILES['file']['name']; 
 move_uploaded_file($_FILES['file']['tmp_name'], $location); 

 $subir_archivo = $directorio.basename($_FILES['file']['name']);

if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
  $ins = "INSERT INTO `file_order_shop`(`order_id`, `proveedor`, `url_pdf`, `file_name`, `file_ruta`, `bodega`, `estado`,`factura`, `result`) 
  VALUES ($order,'$proveedor','$file','','','$bodega','$estado',$factura,$total)";
 $execute = $con->query($ins);
if ($execute) {
 
  echo "success";
} else {
  echo $ins;
}
}else{
  echo "no cargo la imagen";
}

 /* if(!file_exists('archivo')){
	mkdir('archivo',0777,true);
	if(file_exists('archivo')){
		if(move_uploaded_file($guardado, 'archivo/'.$nombre)){
			echo "Archivo guardado con exito";
		}else{
			echo "Archivo no se pudo guardar";
		}
	}
}else{
	if(move_uploaded_file($guardado, 'archivo/'.$nombre)){
		echo "Archivo guardado con exito";
	}else{
		echo "Archivo no se pudo guardar";
	}
} */

return;


$subir_archivo = $directorio.basename($_FILES['file']['name']);

if(move_uploaded_file($_FILES['file']['tmp_name'], $subir_archivo)){
  $ins = "INSERT INTO `file_order_shop`(`order_id`, `proveedor`, `url_pdf`, `file_name`, `file_ruta`, `bodega`, `estado`,`factura`, `result`) 
  VALUES ($order,'$proveedor','$file','','','$bodega','$estado',$factura,$total)";
 $execute = $con->query($ins);
if ($execute) {
 
  echo "success";
} else {
  echo $ins;
}
}else{
  echo "no cargo la imagen";
}
  


