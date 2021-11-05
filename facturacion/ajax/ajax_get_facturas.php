<?php 
// include '../conexion.php';
 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

$json = array();
$sql = $con->query("SELECT * FROM notificaciones WHERE estado LIKE '%pendiente%'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["data"] = $row;

echo json_encode($json);