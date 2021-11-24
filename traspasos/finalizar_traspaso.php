<?php
// function conectar(){
//   $servidor="173.230.154.140";
//   $nombreBd="cotizar";
//   $usuario="cotizar";
//   $pass="LeinerM4ster";
//   $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
//   if ($conexion->connect_error) {
//     die("Connection failed: " . $conexion->connect_error);
//   }
//   return $conexion;
// }


$conexion = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

//  if ($conexion->connect_error) {
//     die("Connection failed: " . $conexion->connect_error);
//   }else{
//       echo "joder";
//   }
// return;

session_start();

$nombre = $_SESSION['user'];

$stocks = 0;
$id = $_POST['id'];
$bodega_salida = $_POST['bodega_salida'];
$bodega_destino = $_POST['bodega_entrada'];
$cantidad = $_POST['cantidad'];
$id_item = $_POST['id_codigo'];

// var_dump($bodega_destino);
// return;

if (isset($_POST['id'])) {
  $result = $conexion->query("SELECT * FROM $bodega_salida WHERE id = $id_item");
  while ($valor_stock = mysqli_fetch_array($result)) {
    $demo = $valor_stock['stock'];
  }

  $stock = floatval($demo);
} else {
  echo "OKAY";
}
// stock bodega destino
if (isset($_POST['id'])) {

  $stock_destino = 0;
  $demo2 = 0;
  $r = $conexion->query("SELECT * FROM $bodega_destino WHERE id = $id_item");

  print_r($r);
  while ($stock_d = mysqli_fetch_array($r)) {
    $demo2 = $stock_d['stock'];
  }
  $stock_destino = floatval($demo2);
} else {
  echo "OKAY";
}

$nuevostockdestino = 0;
$nuevostocksalida = 0;

$nuevostocksalida = $stock - $cantidad;
$nuevostockdestino = $stock_destino + $cantidad;


if (isset($_POST['id'])) {
  $sql = "UPDATE $bodega_salida SET stock = $nuevostocksalida WHERE id = $id_item";
  $conexion->query($sql);
} else {
  echo "NO FUNCIONA LA ACTUALIZACION DEL STOCK DE LA BODEGA SALIDA";
}

if (isset($_POST['id'])) {


  $sql2 = "UPDATE $bodega_destino SET stock = $nuevostockdestino WHERE id = $id_item";
  $conexion->query($sql2);

  $nuevoestado = "Finalizado";
  $consulta = "UPDATE `traspasos` SET `estado`= '$nuevoestado' WHERE id = '$id'";
  $conexion->query($consulta);

  $mysql = "UPDATE `traspasos` SET `aprueba` = '$nombre' WHERE codigo = '$id'";
  $conexion->query($mysql);

  //   echo '<script> alert("ESTE TRASPASO SE EFECTUO CORRECTAMENTE"); window.location="bodega.php";</script>';

  header('Location: efectuar_traspaso.php');
} else {
  echo '<script> alert("ESTE TRASPASO SE EFECTUO CORRECTAMENTE");</script>';
}
