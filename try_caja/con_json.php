<?php
$conexion = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');

$id = $_POST['id'];

$sql = "SELECT * FROM factura_orden WHERE order_id='$id'";
$r = $conexion->query($sql);

if ($o = $r->fetch_object()) {
 $resultado = $o;
}
echo json_encode($resultado);
 ?>
