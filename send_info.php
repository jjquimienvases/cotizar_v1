<?php
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');
include 'conectar.php';
$conexion = conectar();


$proveedor = $_POST['proveedor'];
$producto = $_POST['producto'];
$precio = $_POST['precio'];

$sqlInsertar = "INSERT INTO proveedor_producto (proveedor_id, producto_id, precio) VALUES ('$proveedor','$producto','$precio')";
 $did = mysqli_query($conexion,$sqlInsertar);

echo $did;
  ?>
