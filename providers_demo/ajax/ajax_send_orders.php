<?php 

include '../conexion.php';

 $sql = $con->query("SELECT * FROM order_shop_id WHERE estado LIKE '%solicitud%'");
 foreach ($sql as $data){
     $order = $data['order_id'];

     
     $sql_update = $con->query("UPDATE order_shop_id SET estado = 'pendiente' WHERE order_id = $order");
     $sql_items = $con->query("UPDATE order_shop_products SET estado = 'pendiente' WHERE order_id = $order");
 }

  if($sql_items){
     echo $sql_update;
 }else{
     echo 0;
 } 