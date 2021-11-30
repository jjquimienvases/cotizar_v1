<?php

// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');
include 'conectar.php';
$conexion = conectar();
session_start();
$lastInsertId = 0;


$usuario = $_POST['userId'];
$cliente = $_POST['companyName'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['tele'];
$cedula = $_POST['cedula'];
$comercial = $_POST['address'];
$subtotal = $_POST['subTotal'];
$taxA = $_POST['taxAmount'];
$taxR = $_POST['taxRate'];
$totalAft = $_POST['totalAftertax'];
$amountP = $_POST['amountPaid'];
$amountD = $_POST['amountDue'];
$nota = $_POST['notes'];
$metodo = $_POST['metodopago'];
//productos
$codigo = $_POST['productCode'];
$contratipo = $_POST['productName'];
$cantidad = $_POST['quantity'];
$unitario = $_POST['unitario'];
$resultado = $_POST['result'];
$stockactual = $_POST['productStock'];
$nuevostock = 0;
$nuevostock = floatval($stockactual[0] - $cantidad[0]);

$sqlInsertar = "INSERT INTO factura_orden (user_id, order_receiver_name, tel_client, direccion, ciudad, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note, metodopago,cedula)

VALUES ('$usuario', '$cliente', '$telefono', '$direccion', '$ciudad', '$comercial', '$subtotal', '$taxA', '$taxR', '$totalAft', '$amountP', '$amountD', '$nota', '$metodo','$cedula')";

 if(!empty($comercial) && !empty($cliente) && !empty($cedula)){
   $did = mysqli_query($conexion,$sqlInsertar);
   }else{
        echo "completar todos los campos";
   }


$lastInsertId = mysqli_insert_id($conexion);


if($did == 1){
  for ($i=0; $i < count ($codigo)  ; $i++) {
    $sqlInsertarProductos = "INSERT INTO factura_orden_producto (order_id, item_code, item_name, order_item_quantity, order_item_unitario, order_item_final_amount)
    VALUES ('$lastInsertId', '$codigo[$i]', '$contratipo[$i]', '$cantidad[$i]', '$unitario[$i]', '$resultado[$i]')";
    mysqli_query($conexion,$sqlInsertarProductos);
  }
    echo $lastInsertId;
} else {
    echo $did;
}



$nuevostock = 0;
$stockactual = $_POST['productStock'];
$nuevostock = array();
foreach ($stockactual as $key => $value) {$nuevostock[] = floatval($value - $cantidad[$key]);}



// Descontar del inventario
 for ($i=0; $i < count ($codigo)  ; $i++) {
   $sql1="UPDATE producto_d1 SET stock ='$nuevostock[$i]' WHERE id = '$codigo[$i]'";
   mysqli_query($conexion,$sql1);
 }



// enviar no tificacion a katherin
  $solicitar = 0;
  $solicitar = $_POST['opciones'];
  $notificacion = "Crear factura";
  $cotizacion = $lastInsertId;
  $cliente = $_POST['companyName'];
  $estado = "pendiente";

  $sqlk="	INSERT INTO `notificaciones`(`tipo_notificacion`, `cotizacion`, `cliente`, `estado`)
  VALUES ('$notificacion','$cotizacion','$cliente','$estado')";
  if($solicitar == 1){
  	 mysqli_query($conexion,$sqlk);
  }else{
     return false;
  }
// fin notificacion katherin



















 ?>
