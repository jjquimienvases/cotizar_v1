<?php



include '../conexion.php';

$id = $_GET['id'];
$json = array();
$sql = $con->query("SELECT * FROM traspaso_orden WHERE transfer_id = $id");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["tarjetas"] = $row;

echo json_encode($json);