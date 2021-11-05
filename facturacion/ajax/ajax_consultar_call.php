<?php 
 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

$json = array();
$status = "s_factura";
$status2 = "pendiente";

$sql = $con->query("SELECT * FROM files WHERE estado = '$status' OR estado = '$status2'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["target"] = $row;

echo json_encode($json);