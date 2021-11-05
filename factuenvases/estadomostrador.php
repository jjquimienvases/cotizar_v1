<?php
 
include 'conectan.php';


  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  $vendedor = $_POST['vendedor'];
  $cliente = $_POST['cliente'];
  $cotizacion = $_POST['cotizacion'];
  $total = $_POST['total'];
  $estadoactual = $_POST['estadoactual'];
  $metodo = $_POST['metodop'];



  $nuevostock = 0;

  $totalstock = 0;

  $consulta =  $conexion->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'");
  while ($o = $consulta->fetch_object()){
    if (floatval($nuevostock)==0) {
      $nuevostock = floatval($o->order_item_quantity);
    }


  $consulta3 = $conexion->query("SELECT stock FROM productos_ibague WHERE id = '{$o->item_code}'");
  $stock = floatval($consulta3->fetch_row()[0]);

  $nuevostock = $stock-$o->order_item_quantity;
  if($consulta3){
    $sql1="UPDATE producto SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";

    $conexion->query($sql1);

    echo '<script> alert("Estamos actualizando el stock"); window.location="../listamostrador.php";</script>';
  }else{
    '<script> alert("NO FUNCIONA"); </script>';
} if($cotizacion){
  $sql="INSERT INTO cotizacion_mostrador (order_id, cliente, comercial, estado, pago, total) VALUES ('$cotizacion','$cliente','$vendedor','$estadoactual','$metodo','$total')";
  $conexion->query($sql);
  echo '<script> alert("Estamos actualizando el stock"); window.location="../listamostrador.php";</script>';
}else{
  '<script> alert("NO FUNCIONA"); </script>';
}
}

      ?>
