
<?php

include 'conectar.php';
$conexion = conectar();
$lastInsertId = 0;
// $did = "";
//aqui recojo los datos de todos los name que estan en ese form
$usuario = $_POST['userId'];
$cliente = $_POST['companyName'];
$comercial = $_POST['address'];
$telefono = $_POST['tele'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$cedula = $_POST['cedula'];
$subtotal = $_POST['subTotal'];
$taxA = $_POST['taxAmount'];
$taxR = $_POST['taxRate'];
$totalAft = $_POST['totalAftertax'];
$amountP = $_POST['amountPaid'];
$amountD = $_POST['amountDue'];
$nota = $_POST['notes'];
$metodo = $_POST['metodopago'];
$email = $_POST['email'];
//productos

$codigo=(isset($_POST['productCode']))?$_POST['productCode']:"";
$contratipo=(isset($_POST['productName']))?$_POST['productName']:"";
$cantidad=(isset($_POST['quantity']))?$_POST['quantity']:"";
$unitario=(isset($_POST['unitario']))?$_POST['unitario']:"";
$resultado=(isset($_POST['result']))?$_POST['result']:"";
$stockactual=(isset($_POST['productStock']))?$_POST['productStock']:"";

$ejecutar = 1;
$ejecutando = $_POST['ejecutar'];
$normal = $_POST['normaldt'];
$nuevostock = 0;

//consulta para perfumeria Especial




$sqlInsertar = "INSERT INTO factura_orden (user_id, order_receiver_name, tel_client, direccion, ciudad, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note, metodopago,cedula,email)

VALUES ('$usuario', '$cliente', '$telefono', '$direccion', '$ciudad', '$comercial', '$subtotal', '$taxA', '$taxR', '$totalAft', '$amountP', '$amountD', '$nota', '$metodo','$cedula','$email')";

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

  } else {
      echo $did;
  }


if($normal != 0){

}else{

  $stockactual = $_POST['productStock'];
  $nuevostock = array();
  foreach ($stockactual as $key => $value) {$nuevostock[] = floatval($value - $cantidad[$key]);}

  // Descontar del inventario
   for ($i=0; $i < count ($codigo)  ; $i++) {
     $sql1="UPDATE producto_d1 SET stock ='$nuevostock[$i]' WHERE id = '$codigo[$i]'";
     mysqli_query($conexion,$sql1);
   }
}


// enviar no tificacion a katherin
  $solicitar = 0;
  $solicitar = $_POST['opciones'];
  $notificacion = "Crear factura";
  $correo = $_POST['email'];
  $cotizacion = $lastInsertId;
  $cliente = $_POST['companyName'];
  $estado = "pendiente";

  $sqlk="	INSERT INTO `notificaciones`(`tipo_notificacion`, `cotizacion`, `cliente`, `estado`,`email`)
  VALUES ('$notificacion','$cotizacion','$cliente','$estado','$correo')";
  if($solicitar == 1){
  	 mysqli_query($conexion,$sqlk);
  }else{

  }


// fin notificacion katherin


//aqui vamos a intentar perfumeria especiales
if($ejecutando != 1){
  return;
}else{

   $captura = "SELECT * FROM modal_info WHERE user = '$usuario'";
   $did = mysqli_query($conexion,$captura);

if (mysqli_num_rows($did) > 0) {
 while($filas = mysqli_fetch_array($did)){
   $codes[] = $filas["codigo"];
   $presentacion[] = $filas["presentacion"];
   $envase[] = $filas["envase"];
   $gramo[] = $filas["gramos"];
   $cantidads[] = $filas["cantidad"];
   $preciou[] = $filas["precio"];
   $totall[] = $filas["total"];
   $stockpe[] = $filas["stock"];
 }
} else {
 die("Error: No hay datos en la tabla seleccionada");
}
}
//INSERTANDO ESOS PRODUCTOS Especiales
if (isset($codes)) {

    for ($i=0; $i < count ($codes)  ; $i++) {
    $sqlInsertarEsencias = "INSERT INTO factura_orden_producto (order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount)
    VALUES ('$lastInsertId', '$codes[$i]', '$presentacion[$i]', '$cantidads[$i]', '$preciou[$i]', '$totall[$i]')";
    mysqli_query($conexion,$sqlInsertarEsencias);
    }


    }else{

  }

  $nuevostocks = 0;
  $stockactually = $stockpe;
  $nuevostocks = array();
  foreach ($stockactually as $key => $values) {$nuevostocks[] = floatval($values - $gramo[$key]);}

   for ($i=0; $i < count ($codes)  ; $i++) {
     $sql2="UPDATE producto SET stock ='$nuevostocks[$i]' WHERE id = '$codes[$i]'";
     mysqli_query($conexion,$sql2);
   }

   $not = 0;

  if(isset($lastInsertId)){
    $sql4 = "UPDATE modal_info SET user ='$not' WHERE user = '$usuario'";
    mysqli_query($conexion,$sql4);
  }



 ?>
