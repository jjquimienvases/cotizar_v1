<?php

$con = new mysqli('localhost', 'root', '', 'cotpruebas');
session_start();

$cotizacion = $_POST['order_id'];
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['user'];
$date = DATE("Y-m-d H:i:s");
$id_rol = $_SESSION['id_rol'];
$metodo_pago =  'PayU';
// $metodo_pago =  $_POST['metodo_de_pago'];
//Consultando informacion del cliente
$sql_client = $con->query("SELECT * FROM factura_orden WHERE order_id = $cotizacion");

foreach ($sql_client as $data_c) {
    $cliente_name = $data_c['order_receiver_name'];
    $total = $data_c['order_total_after_tax'];
}


if ($id_rol == 4) {
    //primero vamos a cambiar el estado del pedido en el carrito 
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'transito' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'transito' WHERE order_id = $cotizacion";
    //vamos a solicitar la factura
    $sql_insert_files = "INSERT INTO files (title,description,order_id,estado,id_punto_venta,order_date) VALUES 
 ('$cliente_name','Venta ejecutada en el catalogo electronico',$cotizacion,'s_factura','call center','$date')";
    //vamos a insertar en factura modificada 
    $sql_insert_fm = "INSERT INTO factura_modificada (order_id,order_receiver_name, comercial, total, estado, metodopago, canal,order_date) VALUES 
 ($cotizacion,'$cliente_name','$user_name',$total,'s_factura','$metodo_pago','catalogo','$date')";
    //actualizamos el comercial de la cotizacion
    $sql_update_fo = "UPDATE factura_orden SET order_receiver_address = '$user_name', metodopago = 'bancolombia', metodo_de_pago = '$metodo_pago' WHERE order_id = $cotizacion";
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_1 = $con->query($sql_insert_files);
    $execute_2 = $con->query($sql_insert_fm);
    $execute_3 = $con->query($sql_update_fo);

    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
} else if ($id_rol == 7) {
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'transito' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'transito' WHERE order_id = $cotizacion";
    $sql_update_fo = "UPDATE factura_orden SET estado = 'pendiente',order_receiver_address = '$user_name', metodopago = 'mostrador_ibague_1', metodo_de_pago = '' WHERE order_id = $cotizacion";
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_3 = $con->query($sql_update_fo);
    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
} else if ($id_rol == 3) {
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'transito' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'transito' WHERE order_id = $cotizacion";
    $sql_update_fo = "UPDATE factura_orden SET estado = 'pendiente',order_receiver_address = '$user_name', metodopago = 'mostradord1', metodo_de_pago = '' WHERE order_id = $cotizacion";
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_3 = $con->query($sql_update_fo);
    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
} else if ($id_rol == 2) {
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'transito' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'transito' WHERE order_id = $cotizacion";
    $sql_update_fo = "UPDATE factura_orden SET estado = 'pendiente',order_receiver_address = '$user_name', metodopago = 'mostradorjj', metodo_de_pago = '' WHERE order_id = $cotizacion";
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_3 = $con->query($sql_update_fo);
    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
} 
//aun falta configurar el id de ibague 2 y confirmar que todo este funcionando correctamente




//  print_r($user_id);
//  print_r($_POST);
