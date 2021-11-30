<?php 
include '../conexion.php';
$codigo = $_POST["codigo"];
$json = array();
$sql = $con->query("SELECT * FROM files WHERE order_id = $codigo LIMIT 1"); 
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["data_modal"] = $row;

echo json_encode($json);
