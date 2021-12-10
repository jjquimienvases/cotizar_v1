<?php
include '../conexion.php';
$conexion = conectar();

session_start();
$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];

if ($user_rol == 2) {
  $bodega_entrada = "producto";
  $bodega_salida = "producto";
} else if ($user_rol == 3) {
  $bodega_entrada = "producto_d1";
  $bodega_salida = "producto_d1";
} else if ($user_rol == 6) {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
} else if ($user_rol == 4) {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
} else if ($user_id == 27) {
  $bodega_entrada = "productos_ibague2";
  $bodega_salida = "productos_ibague2";
} else if ($user_rol == 7) {
  $bodega_entrada = "productos_ibague";
  $bodega_salida = "productos_ibague";
} else {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
}

$json = array();
if ($user_rol == 5 || $user_rol == 1) {
    $sql = $conexion->query("SELECT * FROM traspaso_orden WHERE estado != 'pendiente'   ORDER BY transfer_id DESC");
} else {
    $sql = $conexion->query("SELECT * FROM traspaso_orden WHERE estado != 'pendiente' AND bodega_salida = '$bodega_salida' OR bodega_entrada = '$bodega_entrada'  ORDER BY transfer_id DESC");
}
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["tarjetas"] = $row;

echo json_encode($json);
