<?php

// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();

session_start();
$usuario = $_SESSION['userid'];

$dato1 = "";
$dato2 = "";
$dato3 = "";
$dato4 = "";
$dato5 = "";
$dato6 = "";
$dato7 = "";
$dato8 = "";
$dato9 = "";



  $dato1=$_POST['codigos'];
  $dato2=$_POST['presentacions'];
  $dato3=$_POST['envases'];
  $dato4=$_POST['quantitys'];
  $dato5=$_POST['quantityPs'];
  $dato6=$_POST['prices'];
  $dato7=$_POST['totaless'];
  $dato8=$_POST['stocks'];
  $dato9=$_POST['stockenvases'];


  $sqlInsert = "INSERT INTO modal_info (user, codigo, presentacion, envase, gramos, cantidad, precio, total, stock, stockenvases)
   VALUES ('$usuario', '$dato1', '$dato2', '$dato3', '$dato4', '$dato5', '$dato6', '$dato7', '$dato8', '$dato9')";



  $did = mysqli_query($conexion,$sqlInsert);


  echo $did;





 ?>
