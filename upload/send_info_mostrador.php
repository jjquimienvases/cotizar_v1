<?php
  include('conexion.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cliente = $con->real_escape_string(htmlentities($_POST['title']));
    $nota = $con->real_escape_string(htmlentities($_POST['description']));
    $monto = $con->real_escape_string(htmlentities($_POST['monto']));
    $comercial = $con->real_escape_string(htmlentities($_POST['vendedor']));
    $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));
    $canal_v = $con->real_escape_string(htmlentities($_POST['canal_v']));
    $bodega = $con->real_escape_string(htmlentities($_POST['id_bodega']));
  }

//insert de la foto
  $nombreImg=$_FILES['imagen']['name'];
  $ruta=$_FILES['imagen']['tmp_name'];
  $destino="./imagenes/".$nombreImg;
  //insertar los datos en la tabla de mostrador

  $estado = "pendiente";
  if(copy($ruta, $destino)){
    $ins = $con->query("INSERT INTO call_punto_de_venta(order_id,cliente,comercial,monto,estado,notas,canal,bodega,ruta,imagen)
     VALUES ('$cot','$cliente','$comercial','$monto','$estado','$nota','$canal_v','$bodega','$destino','$nombreImg')");
  }

  if ($ins) {
    echo "Cotizacion agregada a pendientes mostrador :D, me encantas bebe";
  }else{
    echo "La cotizacion no se agrego correctamente";
  }
 ?>
