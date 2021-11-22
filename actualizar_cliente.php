<?php
// $conexion=mysqli_connect ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();

session_start();


$cliente = $_POST['companyName'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['tele'];
$cedula = $_POST['id_cedula'];
$comercial = $_POST['address'];
$email = $_POST['email'];




$did = "";
$insertar="";



$consultar_cliente= $conexion -> query ("SELECT count(*) as total from clientes WHERE cedula = '$cedula'");
$data=mysqli_fetch_assoc($consultar_cliente);




$sqlUpdate = "UPDATE clientes SET email = '$email', ciudad = '$ciudad', direccion = '$direccion' WHERE cedula = $cedula";
$sqlInsertar = "INSERT INTO clientes (nombres, cedula, direccion, ciudad, telefono, email) VALUES ('$cliente',$cedula,'$direccion','$ciudad',$telefono,'$email')";


if ($cuenta >= 1) {
  $did = mysqli_query($conexion, $sqlUpdate);

}else{


  $did = mysqli_query($conexion, $sqlInsertar);
}


echo $did;




 ?>
