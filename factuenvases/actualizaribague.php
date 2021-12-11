<?php
  $servidor="ftp.profruver.com";
  $nombreBd="profru_cotpruebas";
  $usuario="profru_jjquimi";
  $pass="LeinerM4ster";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);


  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  $vendedor = $_POST['vendedor'];
  $cliente = $_POST['cliente'];
  $cotizacion = $_POST['cotizacion'];
  $total = $_POST['total'];
  $estadoactual = $_POST['estadoactual'];
  $metodo = $_POST['metodop'];

  // if(isset($cotizacion, $total)){

  $nuevostock = 0;

  $totalstock = 0;
// $verificar_usuario = $conexion->query("SELECT * FROM factura_ibague WHERE order_id = '$cotizacion'");
// if($conexion->num_rows($verificar_usuario)>0){
// echo '<script type="text/javascript"> alert("Esta cotizacion ya fue finalizada"); window.location="bodega.php";</script>';
// exit;
// }
  $consulta =  $conexion->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'");
  while ($o = $consulta->fetch_object()){
    if (floatval($nuevostock)==0) {
      $nuevostock = floatval($o->order_item_quantity);
    }


  $consulta3 = $conexion->query("SELECT stock FROM productos_ibague WHERE id = '{$o->item_code}'");
  $stock = floatval($consulta3->fetch_row()[0]);

  $nuevostock = $stock-$o->order_item_quantity;

  if($consulta3){
    $sql1="UPDATE productos_ibague SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";
    $sql="INSERT INTO cotizacion_ibague (order_id, cliente, comercial, estado, pago, total) VALUES ('$cotizacion','$cliente','$vendedor','$estadoactual','$metodo','$total')";

    $conexion->query($sql1);
    $conexion->query($sql);

    echo '<script> alert("Estamos actualizando el stock"); window.location="ibaguecaptura.php";</script>';
  }else{
    '<script> alert("NO FUNCIONA"); </script>';
}




  // if ($a = $consulta3->fetch_object()){
  //   $stockactual = (float) $a->stock;

  // $stockactual = $conexion->query($consulta3);
    // $cantidad1 = $stockactual;
  // $verificar_usuario = "SELECT * FROM cotizacion_ibague WHERE order_id = '$cotizacion'";
//     if($result->num_rows($verificar_usuario)>0){
//     echo '<script type="text/javascript"> alert("Esta cotizacion ya fue finalizada"); window.location="mostrador.php";</script>';
//     exit;
// }
  // $consulta = "SELECT item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  // $consulta2 = "SELECT order_item_quantity FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  // $cantidad1 = $conexion->query($consulta2);
  // $consulta3 = "SELECT stock FROM productos_ibague WHERE id = '$resultado'";
  // $stockactual = $conexion->query($consulta3);
  //formula
    // $cantidadNueva = abs($cant - $cantidad1);
    // echo $cantidadNueva;
  // }
}

  //     $sql="INSERT INTO cotizacion_ibague (order_id, cliente, comercial, estado, pago, total) VALUES ('$cotizacion','$cliente','$vendedor','$estadoactual','$metodo','$total')";
  //     $result = $conexion->query($sql);
  //
  //     $consulta =  $conexion->query("SELECT order_item_quantity FROM factura_orden_producto WHERE order_id = '$cotizacion'");
  //     if ($o = $consulta->$conexion->fetch_object()) {
  //     $cant = (float) $o->order_item_quantity;
  //     $consulta2 = "SELECT item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  //     $resultado = $conexion->query($consulta2);
  //     // $consulta2 = "SELECT order_item_quantity FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  //     // $cantidad1 = $conexion->query($consulta2);
  //     $consulta3 = "SELECT stock FROM productos_ibague WHERE id = '$resultado'";
  //     $stockactual = $conexion->query($consulta3);
  //     $cantidad1 = $stockactual->fetch_row($stockactual);
  //     // $verificar_usuario = "SELECT * FROM cotizacion_ibague WHERE order_id = '$cotizacion'";
  // //     if($result->num_rows($verificar_usuario)>0){
  // //     echo '<script type="text/javascript"> alert("Esta cotizacion ya fue finalizada"); window.location="mostrador.php";</script>';
  // //     exit;
  // // }
  //     // $consulta = "SELECT item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  //     // $consulta2 = "SELECT order_item_quantity FROM factura_orden_producto WHERE order_id = '$cotizacion'";
  //     // $cantidad1 = $conexion->query($consulta2);
  //     // $consulta3 = "SELECT stock FROM productos_ibague WHERE id = '$resultado'";
  //     // $stockactual = $conexion->query($consulta3);
  //     //formula
  //     $cantidadNueva = abs($cant - $cantidad1[0]);
  //     echo $cantidadNueva;
  //   }
      ?>

      <?php
//     if($cantidadNueva){
//        $sql1="UPDATE productos_ibague SET stock ='$cantidadNueva' WHERE id = '$resultado'";
//     echo '<script type="text/javascript"> alert("Estado actualizado correctamente"); window.location="mostrador.php";</script>';
// }else{
//     die("Error".mysqli_error($conn));
// }

// }

?>
