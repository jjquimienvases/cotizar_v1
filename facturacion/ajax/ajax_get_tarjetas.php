<?php 
 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

$json = array();
$pendiente = "pendiente";
$sql = $con->query("SELECT * FROM notificaciones WHERE estado LIKE '%$pendiente%'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["tarjetas"] = $row;

echo json_encode($json);