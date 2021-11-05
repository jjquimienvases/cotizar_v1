<?php
include '../conexion.php';
session_start();
$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
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

$pendiente = "pendiente";

//la consulta se encarga de actualizar el estado de una cotizacion e items

 $sql = $con->query("SELECT * FROM traspaso_orden WHERE bodega_entrada = '$bodega_entrada' AND estado = '$pendiente'");

 if($sql){
     foreach($sql as $data){
       $transfer_id = $data['transfer_id'];
       $sql_update_order = $con->query("UPDATE traspaso_orden SET estado = 'solicitud' WHERE transfer_id = $transfer_id");
       $sql_update_items = $con->query("UPDATE traspaso_producto_id SET item_status = 'solicitud' WHERE transfer_id = $transfer_id");

       if($sql_update_items){
           echo $transfer_id;
       }else{
           echo 0;
       }
     }
 }else{
     echo 0;
 }