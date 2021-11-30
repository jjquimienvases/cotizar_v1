<?php



include '../conexion.php';

$json = array();
$sql = $conexion->query("SELECT * FROM proveedor");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["tarjetas"] = $row;

echo json_encode($json);
