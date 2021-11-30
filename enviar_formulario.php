<?php
include 'conectar.php';
$conexion = conectar();
// include_once 'config.inc.php';
$comercial = $_POST['vendedor'];
$cotizacion = $_POST['cotizacion'];
$cliente = $_POST['cliente'];
$pago = $_POST['codigo'];
$factura = $_POST['factura'];
$estado = $_POST['estadoactual'];
$metodo = $_POST['metodo'];
$total = $_POST['monto'];
$nuevostock = 0;
$totalstock = 0;


    $sqlInsertarPeticion="INSERT INTO bodegaAV (order_id, factura, comercial, estado, pago)
    VALUES ('$cotizacion', '$factura', '$comercial', '$estado', '$pago')";
$did = mysqli_query($conexion,$sqlInsertarPeticion);

$sqlAprobar = "INSERT INTO factura_modificada (order_id, order_receiver_name, comercial, total, estado, metodopago, code, codigo)
VALUES ('$cotizacion','$cliente','$comercial','$total','$estado','$metodo','$pago','$factura')";
$did = mysqli_query($conexion,$sqlAprobar);


echo $did;
