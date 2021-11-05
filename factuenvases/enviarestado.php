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
$code = $_POST['code'];
$estadoactual = $_POST['estadoactual'];
$metodo = $_POST['metodop'];
$nombreImg=$_FILES['img']['name'];
$ruta=$_FILES['img']['tmp_name'];
$destino="../bodega/imagenes/".$nombreImg;
$nuevostock = 0;
$totalstock = 0;


$consulta =  $conexion->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$cotizacion'");
while ($o = $consulta->fetch_object()){
  if (floatval($nuevostock)==0) {
    $nuevostock = floatval($o->order_item_quantity);
  }


  $consulta3 = $conexion->query("SELECT stock FROM producto WHERE id = '{$o->item_code}'");
  $stock = floatval($consulta3->fetch_row()[0]);

  $nuevostock = $stock-$o->order_item_quantity;
  
  
  if($cotizacion){
    $sql="INSERT INTO factura_modificada (order_id, first_name, order_receiver_name, total, estado, metodopago, code, nombre, ruta) VALUES ('$cotizacion','$vendedor','$cliente','$total','$estadoactual','$metodo','$code','$nombreImg','$destino')";
    $conexion->query($sql);
    
 }

  if($consulta3){
    $sql1="UPDATE producto SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";

    $conexion->query($sql1);
         echo '<script> alert("Cotizacion y stock actualizados correctamente"); window.location="bodega.php";</script>';
  }else{
   '<script> alert("NO ESTA COMPILANDO LA FUNCION CONTACTAR EL DESARROLLADOR"); </script>';
 }
}

?>

