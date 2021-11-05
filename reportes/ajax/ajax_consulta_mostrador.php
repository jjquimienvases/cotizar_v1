<?php
$sql = "";
$punto = ['mostradorjj', 'mostradord1', 'mostrador_ibague_1', 'mostrador_ibague_2'];
$metodo_de_pagos = ['bancolombia', 'davivienda', 'efectivo', 'credito', 'datafono'];

  $date = date("Y-m-d");
// $date = "2021-03-10";
$total_efectivo = 0;
$total_datafono = 0;
$total_bancolombia = 0;
$total_davivienda = 0;
$montox = [];
$value_f = 0;
$value_d = 0;
$value_b = 0;
$value_dv = 0;
$suma = 0;

//consulta de las efectivas punto principal
if($fecha_inicio == ""){
    
    $sql_efectivo = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) = '$date' AND punto_venta = 'mostradorjj'");
//consultando pagos multiples
$sql_multiples = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) = '$date'");
//consultando cierre de caja
$sql_cierre_caja = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) = '$date' AND punto_venta = 'mostradorjj' ");
//callcenter mostrador =
$sql_call_mostrador = $con->query("SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE fo.order_date LIKE '%$date%' AND fm.estado = 'finalizado'");
    
}else{
    $sql_efectivo = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradorjj' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostradorjj'");
//consultando pagos multiples
$sql_multiples = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final'");
//consultando cierre de caja
$sql_cierre_caja = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostradorjj' ");
//callcenter mostrador =
$sql_call_mostrador = $con->query("SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND fm.estado = 'finalizado'");
}

//configurando informacion
//efectivo
foreach ($sql_efectivo as $data_efectivo) {
    $totalTax = $data_efectivo['order_total_after_tax'];
    $totalDue = $data_efectivo['order_total_amount_due'];
    $montox = $totalDue;
    if ($totalDue == 0) {
        $montox = $totalTax;
    }
    $metodo_de_pago = $data_efectivo['metodo_de_pago'];
    $total_efectivo += $montox;
}
foreach ($sql_datafono as $data_datafono) {
    $totalTax = $data_datafono['order_total_after_tax'];
    $totalDue = $data_datafono['order_total_amount_due'];
    $montox = $totalDue;
    if ($totalDue == 0) {
        $montox = $totalTax;
    }
    $metodo_de_pago = $data_datafono['metodo_de_pago'];
    $total_datafono += $montox;
}
foreach ($sql_bancolombia as $data_bancolombia) {
    $totalTax = $data_bancolombia['order_total_after_tax'];
    $totalDue = $data_bancolombia['order_total_amount_due'];
    $montox = $totalDue;
    if ($totalDue == 0) {
        $montox = $totalTax;
    }
    $metodo_de_pago = $data_bancolombia['metodo_de_pago'];
    $total_bancolombia += $montox;
}
foreach ($sql_davivienda as $data_davivienda) {
    $totalTax = $data_davivienda['order_total_after_tax'];
    $totalDue = $data_davivienda['order_total_amount_due'];
    $montox = $totalDue;
    if ($totalDue == 0) {
        $montox = $totalTax;
    }
    $metodo_de_pago = $data_davivienda['metodo_de_pago'];
    $total_davivienda += $montox;
}


foreach($sql_abonos as $data_abono ){
    $metodo_de_pago_abono = $data_abono['metodo_de_pago'];
    $abono = $data_abono['nuevo_abono'];
    if($metodo_de_pago_abono == "efectivo" ){
        $total_efectivo = $total_efectivo + $abono;
    }else if($metodo_de_pago_abono == "bancolombia"){
        $total_bancolombia = $total_bancolombia + $abono;  
    }else if($metodo_de_pago_abono == "davivienda"){
        $total_davivienda = $total_davivienda + $abono;
    }else if($metodo_de_pago_abono == "datafono"){
        $total_datafono = $total_datafono + $abono;
    }
}

foreach($sql_call_mostrador as $data_cm){
    $monto = $data_cm['monto'];
    $metodo_pago_call = $data_cm['metodo_de_pago'];
    if($metodo_pago_call == "efectivo" ){
        $total_efectivo = $total_efectivo + $monto;
    }else if($metodo_pago_call == "bancolombia"){
        $total_bancolombia = $total_bancolombia + $monto;  
    }else if($metodo_pago_call == "davivienda"){
        $total_davivienda = $total_davivienda + $monto;
    }else if($metodo_pago_call == "datafono"){
        $total_datafono = $total_datafono + $monto;
    }
}

 
// foreach ($sql_multiples as $data_multiple){
    
// }

foreach($sql_cierre_caja as $data_cierre){
    $efectivo = $data_cierre['efectivo'];
    $bancolombia = $data_cierre['bancolombia'];
    $davivienda = $data_cierre['davivienda'];
    $datafono = $data_cierre['datafono'];
}


//valores finales
$suma = $total_datafono + $total_bancolombia + $total_efectivo + $total_davivienda;
$suma_caja = $efectivo + $bancolombia + $davivienda + $datafono;

?>