<?php 
 
 include 'conexion.php';

 $order_id = $_POST['cotizaciones'];
 $ahorro = $_POST['ahorro'];
 $descuento = $_POST['total_desc'];
 $porcentaje = $_POST['porcentaje'];

 $sql = "UPDATE factura_orden SET order_tax_per = $porcentaje, order_total_amount_due = $descuento, order_total_tax = $ahorro WHERE order_id = $order_id";
 $execute = $con->query($sql);

 if($execute){
  echo $order_id;
 }else{
     echo 0;
 }
