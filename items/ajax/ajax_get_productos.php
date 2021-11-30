<?php 
// include '../conexion.php';
// $con = new mysqli ('localhost', 'root', '', 'cotpruebas');

include '../conexion.php';
session_start();
$id_rol = $_SESSION['id_rol'];
$id_user  = $_SESSION['userid'];
$json = array();

if($id_user == 27){
    $sql = $conexion->query("SELECT * FROM productos_ibague2 ORDER BY id ASC");
}else if($id_rol == 7){
    
      $sql = $conexion->query("SELECT * FROM productos_ibague ORDER BY id ASC");
  
}else if($id_rol == 2){
    $sql = $conexion->query("SELECT * FROM producto ORDER BY id ASC");
}else if($id_rol == 3){
    $sql = $conexion->query("SELECT * FROM producto_d1 ORDER BY id ASC");
}else if($id_rol == 4){
    $sql = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
}else{
    $sql = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
}
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["data"] = $row;

echo json_encode($json);