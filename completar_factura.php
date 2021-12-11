<?php

//   $servidor="ftp.profruver.com";
//   $nombreBd="profru_cotpruebas";
//   $usuario="profru_jjquimi";
//   $pass="LeinerM4ster";
//   $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
//  if ($conexion->connect_error) {
//   die("Connection failed: " . $conexion->connect_error);
//  }
 
 include 'conectar.php';
 $conexion = conectar();
 
  $id = $_POST['send'];

  $nuevoestado = "finalizado";
  $consulta ="UPDATE `notificaciones` SET `estado`= '$nuevoestado' WHERE cotizacion = $id";
  $conexion->query($consulta);

  header('Location: ver_facturas_pendientes.php');
 ?>
