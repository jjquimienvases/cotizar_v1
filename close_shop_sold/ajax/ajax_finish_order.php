<?php

include '../conexion.php';

session_start();

$cotizacion = $_POST['orders'];
$metodo_pago = $_POST['mpago'];
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['user'];
$date = DATE("Y-m-d H:i:s");
$id_rol = $_SESSION['id_rol'];

$punto_venta = ""; 
$bodega_d = "";
if($id_rol == 2){
$punto_venta = "mostradorjj";
$bodega_d = "producto";
}else if($id_rol == 3){
$punto_venta = "mostrador_d1";
$bodega_d = "producto_d1";
}else if($id_rol == 7){
$punto_venta = "mostrador_ibague_1";
$bodega_d = "productos_ibague";
}else if($id_rol == 4 || $id_rol == 5){
$punto_venta = "bancolombia";
$bodega_d = "producto_av";
}







# DEBE RECONOCER QUIEN ESTA ONLINE Y APARTIR DE ALLI, ACTUALIZAR EL ESTADO DE LOS ITEMS Y LA ORDEN DE COMPRA. SOLICITAR FACTURA, SI ES ALEJANDRA (SUBIRLO A FILES Y FACTURA MODIFICADA SIN DESCONTAR MERCANCIA) 
//Consultando informacion del cliente
$sql_client = $con->query("SELECT * FROM factura_orden WHERE order_id = $cotizacion");

foreach ($sql_client as $data_c) {
    $cliente_name = $data_c['order_receiver_name'];
    $total = $data_c['order_total_after_tax'];
    $email = $data_c['email'];
}



if ($id_rol != 4 || $id_rol != 1) {
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'finalizado' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'finalizado' WHERE order_id = $cotizacion";
    $sql_update_fo = "UPDATE factura_orden SET estado = 'finalizado',order_receiver_address = '$user_name', metodopago = 'mostradorjj', metodo_de_pago = '' WHERE order_id = $cotizacion";
    //solicitar la factura de la factura de la fact
    $sql_fact = $con->query("INSERT INTO notificaciones (tipo_notificacion,cotizacion,cliente,estado,email) VALUES ('factura_',$cotizacion,'$cliente_name','pendiente','$email')");
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_3 = $con->query($sql_update_fo);
    if ($execute) {
        $sql_i = $con->query("SELECT * FROM carrito_ WHERE order_id = $cotizacion");
        foreach ($sql_i as $data_i) :
            $item_code = $data_i['item_code'];
            $item_quantity = $data_i['item_quantity'];
            $gramos = $data_i['gramos'];
            $envase = $data_i['envase'];
            $item_category = $data_i['item_category'];
            $sql_stock = $con->query("SELECT * FROM $bodega_d WHERE id= $item_code");
            foreach ($sql_stock as $data_S) {
                $stock_actual = $data_S['stock'];
                $nuevo_stock = "";

                if ($gramos == "" || $gramos == 0) {
                    $nuevo_stock = $stock_actual - $item_quantity;
                    $update_s = $con->query("UPDATE $bodega_d SET stock= $nuevo_stock WHERE id= $item_code");
                    if ($update_s) {
                        echo $nuevo_stock;
                    } else {
                        echo 0;
                    }
                } else {
                    $sql_e = $con->query("SELECT * FROM $bodega_d WHERE id = $envase");
                    foreach ($sql_e as $data_e) {
                        $stock_e = $data_e['stock'];
                        $nuevo_stock = $stock_e - $item_quantity;
                        $update_s = $con->query("UPDATE $bodega_d SET stock= $nuevo_stock WHERE id= $envase");
                        if ($update_s) {
                            $sql_se = $con->query("SELECT * FROM $bodega_d WHERE id = $item_code");
                            foreach ($sql_se as $data_se) {
                                $stock_esencia = $data_se['stock'];
                                $nuevo_stock_s = $stock_esencia - $gramos;

                                $update_e = $con->query("UPDATE $bodega_d SET stock = $nuevo_stock_s WHERE id = $item_code");
                                if ($update_e) {
                                    echo $nuevo_stock_s;
                                } else {
                                    echo 0;
                                }
                            }
                        } else {
                            echo 0;
                        }
                    }
                }
            }
        endforeach;
    } else {
        echo 0;
    }
} else {
    //primero vamos a cambiar el estado del pedido en el carrito 
    $sql_update_cart_ = "UPDATE carrito_ SET item_status = 'finalizado' WHERE order_id = $cotizacion";
    $sql_update_order_cart_ = "UPDATE order_carrito SET estado = 'finalizado' WHERE order_id = $cotizacion";
    //vamos a solicitar la factura
 
    //vamos a insertar en factura modificada 


    //actualizamos el comercial de la cotizacion
    $sql_update_fo = "UPDATE factura_orden SET metodo_de_pago = '$metodo_pago' AND metodopago = '' WHERE order_id = $cotizacion";
    $execute = $con->query($sql_update_cart_);
    $execute_ = $con->query($sql_update_order_cart_);
    $execute_3 = $con->query($sql_update_fo);

    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
}
