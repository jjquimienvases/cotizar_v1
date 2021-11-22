<?php
 include 'conectar.php';
 $conexion = conectar();

  $cotizacion = $_POST['aprobar'];
  $abono = $_POST['nuevo_abono']; //400
  $metodo_de_pago = $_POST['metodo']; //efectivo
  $restante = $_POST['restante'];  //400
  $deuta_total = "";
  $fecha = date("d-m-Y h:m:s");
  $status = "";

  $estado = "";

  if($abono >= $restante){
      $nuevo_abono = 0;
      $deuta_total = $_POST['total_due'];
      $estado ="completo";
      $status ="finalizado";
  }else{
       $nuevo_abono = $restante - $abono;  
       $deuta_total = $nuevo_abono;
       $estado = "pendiente";  
       $status = "pendiente";  
  }   

 


  
//   if($nuevo_abono < $restante){
//      $estado = "pendiente";  
//   }else{
//      $estado ="completo";
//   }

  $upload = $conexion ->query("UPDATE order_abono SET restante = '$nuevo_abono', abono = '$abono', order_date = '$fecha', metodo_de_pago = '$metodo_de_pago', estado = '$estado' WHERE order_id = $cotizacion");
  $upload_cotizacion = $conexion ->query("UPDATE factura_orden SET order_total_amount_due = '$nuevo_abono', order_amount_paid = '$deuta_total', estado = '$status'  WHERE order_id = $cotizacion");
  if($upload){
    echo "funciona";
    header('Location: try_caja/index.php');
  }else{
    echo "no funciona";
    header('Location: review_abono.php');
  }
?>
