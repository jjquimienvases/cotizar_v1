<?php
$conexion=mysqli_connect('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas'); 
session_start();
$nombre = $_SESSION['user'];


  $bodega_receiver_id = 1;
  $bodega_send_id = 1;
  $codigo = 0;
  $info_adicional = "";
  $estado = "Finalizado";
 //aqui vamos a capturar los datos
  $producto = $_POST['producto'];
  $id = $_POST['codigo'];
  $cantidad = $_POST['cantidad'];
  $bodegaSend = $_POST['envia'];
  $bodegaReceiver = $_POST['recibe'];
  $solicita = $_POST['solicita'];



//seleccionando el stock de la bodega salida
if(isset($_POST['codigo'])){
  $result= $conexion ->query("SELECT * FROM $bodegaSend WHERE id = $id");
 while ($valor_stock = mysqli_fetch_array($result)) {
   $demo = $valor_stock['stock'];
 }
  // $conexion->query($result);
  $stock = floatval($demo);
}else{
  echo "OKAY";
}

//seleccionando stock de la bodega entrada

if(isset($_POST['codigo'])){

  $resulta= $conexion ->query("SELECT * FROM $bodegaReceiver WHERE id = $id");
 while ($valor_stock_destino = mysqli_fetch_array($resulta)) {
   $demo_destino = $valor_stock_destino['stock'];
 }
}else{
  echo "OKAY";
}


$nuevostockdestino = 0;
$nuevostocksalida = 0;

$nuevostocksalida = $demo - $cantidad;
$nuevostockdestino = $demo_destino + $cantidad;

if (isset($_POST['codigo'])) {
  $sql = "UPDATE $bodegaSend SET stock = $nuevostocksalida WHERE id = $id";
  $conexion->query($sql);
}else{
  echo "NO FUNCIONA LA ACTUALIZACION DEL STOCK DE LA BODEGA SALIDA";
}

if (isset($_POST['codigo'])) {
  $sql2 = "UPDATE $bodegaReceiver SET stock = $nuevostockdestino WHERE id = $id";
  $conexion->query($sql2);

// echo "Funciona";

}else{
echo "no Funciona";
}



$sqlInsertSolicitud = "INSERT INTO traspasos (codigo, producto, cantidad, bodega_salida, bodega_entrada, solicita, estado,aprueba, empaca,id_rol_bodega_salida,id_rol_bodega_entrada)
VALUES ('$id','$producto','$cantidad','$bodegaSend','$bodegaReceiver','$solicita','$estado','$info_adicional','$info_adicional','$bodega_send_id','$bodega_receiver_id')";
 if ($sql2) {
   $did = mysqli_query($conexion, $sqlInsertSolicitud);

 $mysql = "UPDATE `traspasos` SET `aprueba` = '$nombre' WHERE codigo = $id";
 $conexion->query($mysql);


 $mysqls = "UPDATE `traspasos` SET `empaca` = '$nombre' WHERE codigo = $id";
 $conexion->query($mysqls);

}
echo $did;
 ?>
