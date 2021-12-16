<?php
 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];
 $order = $_POST['order'];

 $sql = $con->query("SELECT * FROM traspaso_producto_id WHERE transfer_id = $order ");

 foreach($sql as $data ){
   $bodega_entrada = $data['bodega_entrada'];
   $bodega_salida = $data['bodega_salida'];
   $item_code = $data['item_code'];
   $item_name = $data['item_name'];
   $item_quantity = $data['item_quantity'];

   $sql_bodega_entrada = $con->query("SELECT * FROM $bodega_entrada WHERE id = '$item_code'");
   foreach($sql_bodega_entrada as $data_e){
       $stock = $data_e['stock'];
   }
   $nuevo_stock_entrada = $stock + $item_quantity;
   $update_entrada = $con->query("UPDATE $bodega_entrada SET stock = $nuevo_stock_entrada WHERE id = '$item_code'");

   $sql_bodega_salida = $con->query("SELECT * FROM $bodega_salida WHERE id = '$item_code'");
   foreach($sql_bodega_salida as $data_s){
     $stock_s = $data_s['stock'];
   }
   $nuevo_stock_salida = $stock_s - $item_quantity;
   $update_salida = $con->query("UPDATE $bodega_salida SET stock = $nuevo_stock_salida WHERE id = '$item_code'");

   $update_info = $con->query("UPDATE traspaso_orden SET recibe = '$user', estado = 'finalizado' WHERE transfer_id = $order");
   $update_info_ = $con->query("UPDATE traspaso_producto_id SET item_status = 'finalizado' WHERE transfer_id = $order");

 }

 if($update_info){
     echo $order;
 }else{
     echo 0;
 }