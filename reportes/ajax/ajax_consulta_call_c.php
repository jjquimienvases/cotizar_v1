<?php
//  $con = new mysqli ('localhost', 'root', '', 'cotpruebas');
   $date = date("Y-m-d");
 $total_call = 0;
 $sql = $con->query("SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.estado != 'pendiente'");

 foreach ($sql as $data_call){
     $metodo_pago = $data_call['metodo_de_pago'];
     $AfterTax = $data_call['order_total_after_tax'];
     $DueTotal = $data_call['order_total_amount_due']; 
     $montox_call = $DueTotal;
     if($DueTotal == 0){
     $montox_call = $AfterTax;
     } 
   $total_call += $montox_call;
 }

 