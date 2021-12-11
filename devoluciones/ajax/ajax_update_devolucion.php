<?php

// include '../conexion.php';
// $conexion = conectar();
$conexion = new mysqli('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');
$punto_venta = "";
$date = DATE('Y-m-d');
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];
$order_id = $_POST["order_id"];
$order_item_quantity = $_POST["order_item_quantity"];
$order_item_id = $_POST["order_item_id"];
$order_item_unitario = $_POST["order_item_unitario"];
$order_item_final_amount = $_POST["order_item_final_amount"];
$order_receiver_name = $_POST['order_receiver_name'];
$cedula = $_POST['cedula'];
$punto_v = $_POST['metodopago'];
   if($punto_v == "mostradorjj"){
    $punto_venta = "producto";
   }else if($punto_v == "mostradord1"){
    $punto_venta = "producto_d1";
   }else if($punto_v == "bancolombia"){
    $punto_venta = "producto_av";
   }else if($punto_v == "mostrador_ibague_1"){
    $punto_venta = "productos_ibague";
   }else if($punto_v == "mostrador_ibague_2"){
    $punto_venta = "productos_ibague2";
   }

 //obteniendo valores
  

 $sql_get_data = $conexion->query("SELECT * FROM factura_orden_producto WHERE item_code = $item_code AND order_id = $order_id");

 foreach($sql_get_data as $data_pro){
   $order_quantity = $data_pro['order_item_quantity'];

 }

 $total_tt = $order_item_quantity * $order_item_unitario;
 $total_merch = $order_quantity - $order_item_quantity;
 $nuevo_total_items = $total_merch * $order_item_unitario;

   $sql_credito_cliente = $conexion->query("SELECT * FROM clientes WHERE cedula = $cedula");
   foreach($sql_credito_cliente as $data){
       $credito = $data['credito'];
    }
    $nuevo_credito = $credito + $total_tt;

   $sql_ver_stock = $conexion->query("SELECT * FROM $punto_venta WHERE id = $item_code");
   foreach($sql_ver_stock as $data_){
       $stock_actual = $data_['stock'];
    }
    $nuevo_stock = $stock_actual + $order_item_quantity;

   $sql_cotizacion_total = $conexion->query("SELECT * FROM factura_orden WHERE order_id = $order_id");
   foreach($sql_cotizacion_total as $data_o){
       $order_total_before_tax = $data_o['order_total_before_tax'];
       $order_total_after_tax = $data_o['order_total_after_tax'];
    }
    $nuevo_before_tax = $order_total_before_tax - $total_tt;
    $nuevo_after_tax = $order_total_after_tax - $total_tt;

   


// print_r($nuevo_stock);


// exit;

try {
    //SQL PARA SUBIR A LA TABLA DE DEVOLUCIONES (ALLI VA A QUEDAR REGISTRADO DICHA DEVOLUCION);
    $sql_insert_devolucion = $conexion->query("INSERT INTO devolucion (order_id, cliente, cedula, item_code, item_name, item_quantity, item_total_amount, punto_venta) 
    VALUES ($order_id,'$order_receiver_name','$cedula',$item_code,'$item_name',$order_item_quantity,$order_item_final_amount,'$punto_venta')");
 
  
//   SQL PARA DAR EL SALDO A FAVOR DEL CLIENTE
    $sql_update_saldo = $conexion->query("UPDATE clientes SET credito = $nuevo_credito WHERE cedula = $cedula");
//    SQL PARA CARGAR EL INVENTARIO DE LA BODEGA EN LA QUE SE DEVOLVIO
    $sql_actualizar_stock = $conexion->query("UPDATE $punto_venta SET stock = $nuevo_stock WHERE id = $item_code");
//   SQL ACTUALIZAR TOTAL DE LA COTIZACION
    $sql_actualizar_order = $conexion->query("UPDATE factura_orden SET order_total_before_tax = $nuevo_before_tax, order_total_after_tax = $nuevo_after_tax WHERE order_id = $order_id");
   
    if($order_item_quantity == $order_quantity){
        //   SQL PARA BORRAR EL ITEM DE LA COTIZACION
        $sql_delete_item = $conexion->query("DELETE FROM factura_orden_producto WHERE order_item_id = $order_item_id");
    }else{
        //  SQL PARA ACTUALIZAR LA CANTIDAD DE ITEMS Y SU PRECIO TOTAL DEL
            $sql_update_item = $conexion->query("UPDATE factura_orden_producto SET order_item_quantity = $total_merch, order_item_final_amount = $nuevo_total_items WHERE order_item_id = $order_item_id");
    }



    if ($sql_insert_devolucion) {
        http_response_code(200);
        echo json_encode([
            "title" => "PERFECTO",
            "text" => "Este Producto fue agregado a tu inventario",
            "icon" => "success"
        ]);
       return;
    }
    // print_r($sql_insert_devolucion);
    echo $sql_insert_devolucion;
    return;
} catch (\Exception $err) {
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "err" => $err
    ]);
}
