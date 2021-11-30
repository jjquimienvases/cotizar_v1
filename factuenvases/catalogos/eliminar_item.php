<?php
// $conexion = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');  

include_once 'conectar.php';
	$conexion= conectar();

  $code = $_POST['eliminar_items'];
 


  if (isset($code)) {
    $consulta_delete1 = $conexion -> query ("DELETE FROM producto WHERE id = $code");
    $consulta_delete2 = $conexion -> query ("DELETE FROM producto_av WHERE id = $code");
    $consulta_delete3 = $conexion -> query ("DELETE FROM producto_d1 WHERE id = $code");
    $consulta_delete4 = $conexion -> query ("DELETE FROM productos_ibague WHERE id = $code");
    
     header('Location: admin_productos.php');

    
  }else{
    echo "seleccionar un producto valido";
  }

 ?>
