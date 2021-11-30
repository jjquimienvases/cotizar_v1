<?php

// $mysqli2 = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();



$id = $_POST['send'];
$nuevoestado = "Cancelado";
$consulta ="UPDATE `pendientes` SET `estado`= '$nuevoestado' WHERE cotizacion = '$id'";
$did = $conexion->query($consulta);


echo $did;
header('Location: cotizaciones_pendientes_pago.php');

 ?>
