<?php 
include "../../globals.php";

$json = array();
$pendiente = "pendiente";
$sql = $cnx->query("SELECT * FROM notificaciones WHERE estado LIKE '%$pendiente%'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["tarjetas"] = $row;

echo json_encode($json);