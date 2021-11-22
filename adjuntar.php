<?php
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();

  $cliente = $_POST['cliente'];
  $cotizacion = $_POST['cotizacion'];
  $estado = $_POST['estadoactual'];
  $monto = $_POST['monto'];


  $sqlInsertar = "INSERT INTO pendientes (cotizacion, cliente, estado, monto)
  VALUES ('$cotizacion','$cliente','$estado','$monto')";

  $did = mysqli_query($conexion,$sqlInsertar);

  echo $did;
