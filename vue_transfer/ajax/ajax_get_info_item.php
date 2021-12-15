<?php
include '../conexion.php';
session_start();
$conexion = conectar();

include '../variables.php';
$item = $_POST['id'];
$json = array();
$sql = $conexion->query("SELECT * FROM $bodega_entrada WHERE id = '$item'");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["info_items"] = $row;

echo json_encode($json);
