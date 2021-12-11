<?php
 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
$bodega_entrada = "";
$estado = "solicitud";
$date = date("Y-m-d h:i:s");
if ($user_rol == 2) {
    $bodega_entrada = "producto";
} else if ($user_rol == 3) {
    $bodega_entrada = "producto_d1";
} else if ($user_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($user_rol == 4) {
    $bodega_entrada = "producto_av";
} else if ($user_id == 27) {
    $bodega_entrada = "productos_ibague2";
} else if ($user_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}




$sql_insert = "INSERT INTO `traspaso_producto_id`(`id`, `transfer_id`, `item_code`, `item_name`, `item_quantity`, `bodega_entrada`, `bodega_salida`, `item_status`, `order_date`) 
 VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])";