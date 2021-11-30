<?php
include 'conexion.php';

$bodega_receiver_id = 0;
$bodega_send_id = 0;
$codigo = 0;
$info_adicional = "";
$estado = "Solicitud";

$time = time();


$fecha_solicitud = date("Y-m-d H:i:s", $time);

//aqui vamos a capturar los datos
 $producto = $_POST['producto'];
 $codigo = $_POST['codigo'];
 $cantidad = $_POST['cantidad'];

 $rol_usuario = $_POST['rol'];
 $bodega_destino = "producto_av";

 $solicita = $_SESSION['user'];


//consultas de insercion
$sqlInsertSolicitud = "INSERT INTO solicitud_productos (item_id, item_name, item_quantity, bodega_destino, solicitante, fecha_solicitud, asistente,fecha_aprobacion,estado)
VALUES ('$codigo','$producto','$cantidad','$bodega_destino','$solicita','$fecha_solicitud','$info_adicional','$info_adicional','$estado')";


$did = mysqli_query($conexion, $sqlInsertSolicitud);

echo $did;



 ?>
