<?php
include '../conectar.php';
$conexion = conectar();
$id = $_POST['id'];

$sql = "SELECT * FROM factura_orden WHERE order_id='$id'";
$r = $conexion->query($sql);

if ($o = $r->fetch_object()) {
 $resultado = $o;
}
echo json_encode($resultado);
 ?>
