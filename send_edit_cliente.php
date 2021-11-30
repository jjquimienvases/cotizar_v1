<?php

// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');
include 'conectar.php';
$conexion = conectar();
session_start();
$usuario = $_SESSION['userid'];


  $dato1=$_POST['nombres'];
  $dato2=$_POST['ccs'];
  $dato3=$_POST['emails'];
  $dato4=$_POST['telefonos'];
  $dato5=$_POST['direccions'];
  $dato6=$_POST['ciudads'];


 $sqlUpdate = "UPDATE clientes SET cedula = '$dato2', nombres = '$dato1', direccion = '$dato5', telefono = '$dato4', ciudad = '$dato6', email = '$dato3' WHERE cedula = '$dato2'";




  $did = mysqli_query($conexion,$sqlUpdate);

  echo $did;


 ?>
