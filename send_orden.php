
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
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$comercial = $_POST['address'];
$total = $_POST['subTotal'];
$nota = $_POST['notes'];
//productos
$codigo=(isset($_POST['productCode']))?$_POST['productCode']:"";
$contratipo=(isset($_POST['productName']))?$_POST['productName']:"";
$cantidad_caja=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$cantidad_numero=(isset($_POST['quantity']))?$_POST['quantity']:"";
$precio=(isset($_POST['price']))?$_POST['price']:"";
$resultado=(isset($_POST['result']))?$_POST['result']:"";

$sqlInsertar = "INSERT INTO orden_compra (user_id, order_receiver_name, direccion, ciudad, note, total)
VALUES ('$usuario', '$cliente', '$direccion', '$ciudad', '$nota', '$total')";
 if(!empty($cliente) && !empty($total)){
   $did = mysqli_query($conexion,$sqlInsertar);
   }else{
        echo "completar todos los campos";
   }

  $lastInsertId = mysqli_insert_id($conexion);

  if($did == 1){
      for ($i=0; $i < count ($codigo)  ; $i++) {
        $sqlInsertarProductos = "INSERT INTO orden_compra_productos (order_id, item_code, item_name, order_item_quantity, cantidad_numero, item_price, result)
        VALUES ('$lastInsertId', '$codigo[$i]', '$contratipo[$i]', '$cantidad_caja[$i]', '$cantidad_numero[$i]', '$precio[$i]', '$resultado[$i]')";
        mysqli_query($conexion,$sqlInsertarProductos);
      }
  }else {
      echo $did;
  }



 echo $did;

 ?>
