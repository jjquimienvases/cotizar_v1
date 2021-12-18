<?php
include '../conexion.php';
session_start();
$user = $_SESSION['user'];
$id_rol = $_SESSION['id_rol'];
$bodega_entrada = "";
if ($id_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($id_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}

$sql_ = $conexion->query("SELECT * FROM order_solicitud WHERE sede = '%$bodega_entrada%' AND estado = 'pendiente'");
$existencia = mysqli_num_rows($sql_);
$order_date = DATE("Y-m-d H:i:s");

if ($existencia == 0) {
    $sql_insert = $conexion->query("INSERT INTO order_solicitud (sede,estado_solicitud,order_date)VALUES('$bodega_entrada','pendiente','$order_date')");
    if ($sql_insert) {
        $last_insert = mysqli_insert_id($conexion);
        $sql_insert_item = $conexion->query("INSERT INTO order_solicitud_items (order_id,item_code,item_name,item_quantity)VALUES($last_insert,$item_code,'$item_name',$item_quantity)");
    } else {
        echo 0;
    }
} else {

    foreach ($sql_ as $data) {
        $order_id = $data['order_id'];
        $sql_insert_item = $conexion->query("INSERT INTO order_solicitud_items (order_id,item_code,item_name,item_quantity)VALUES($order_id,$item_code,'$item_name',$item_quantity)");
    }
}

if ($sql_insert_item) {
    echo 1;
} else {
    echo 0;
}
