<?php 
include '../../globals.php';

$json = array();
$sql = $cnx->query("SELECT * FROM notificaciones WHERE estado LIKE '%pendiente%'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["data"] = $row;

echo json_encode($json);