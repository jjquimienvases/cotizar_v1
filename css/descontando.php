<?php
  $servidor="localhost";
  $nombreBd="cotpruebas";
  $usuario="root";
  $pass="";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);


  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }

$code = $_POST['cotizacion'];
$nuevostock = 0;
$totalstock = 0;

$consulta =  $conexion->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$code'");
while ($o = $consulta->fetch_object()){
  if (floatval($nuevostock)==0) {
    $nuevostock = floatval($o->order_item_quantity);
  }

  $consulta3 = $conexion->query("SELECT stock FROM producto WHERE id = '{$o->item_code}'");
  $stock = floatval($consulta3->fetch_row()[0]);
  $nuevostock = $stock-$o->order_item_quantity;

  if($consulta3){
   $sql1="UPDATE producto SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";
   $did = $conexion->query($sql1);
  }else{

  }
}
    echo $did;
