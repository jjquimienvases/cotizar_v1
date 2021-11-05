<?php



  $date = date("Y-m-d");
// $date = "2021-03-10";
$total_efectivo_ib1 = 0;
$total_datafono_ib1 = 0;
$total_bancolombia_ib1 = 0;
$total_davivienda_ib1 = 0;
$montox_ib_f = [];
$montox_ib_d = [];
$montox_ib_b = [];
$montox_ib_dv = [];
$montox_ib = [];
$suma_ib1 = 0;

if($fecha_inicio == ""){

//consulta de las efectivas punto principal
$sql_efectivo_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos_ib1 = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) = '$date' AND punto_venta = 'mostrador_ibague_1'");
//consultando pagos multiples
$sql_multiples_ib1 = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) = '$date'");
//consultando cierre de caja
$sql_cierre_caja_ib1 = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) = '$date' AND punto_venta = 'mostrador_ibague_1' ");
}else{
   //consulta de las efectivas punto principal
$sql_efectivo_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda_ib1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostrador_ibague_1' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos_ib1 = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostrador_ibague_1'");
//consultando pagos multiples
$sql_multiples_ib1 = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final'");
//consultando cierre de caja
$sql_cierre_caja_ib1 = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostrador_ibague_1' "); 
}
//configurando informacion



//efectivo
foreach ($sql_efectivo_ib1 as $data_efectivo_ib1) {
    $totalTax_ib_f = $data_efectivo_ib1['order_total_after_tax'];
    $totalDue_ib_f = $data_efectivo_ib1['order_total_amount_due'];
    $montox_ib_f = $totalDue_ib_f;
    if ($totalDue_ib_f == 0) {
        $montox_ib_f = $totalTax_ib_f;
    }

    $metodo_de_pago_ib = $data_efectivo_ib1['metodo_de_pago'];
    $total_efectivo_ib1 += $montox_ib_f;
}

foreach ($sql_datafono_ib1 as $data_datafono_ib1) {
    $totalTax_ib_d = $data_datafono_ib1['order_total_after_tax'];
    $totalDue_ib_d = $data_datafono_ib1['order_total_amount_due'];
    $montox_ib_d = $totalDue_ib_d;
    if ($totalDue_ib_d == 0) {
        $montox_ib_d = $totalTax_ib_d;
    }
    $metodo_de_pago_ib1 = $data_datafono_ib1['metodo_de_pago'];
    $total_datafono_ib1 += $montox_ib_d;
}

foreach ($sql_bancolombia_ib1 as $data_bancolombia_ib1) {
    $totalTax_ib_b = $data_bancolombia_ib1['order_total_after_tax'];
    $totalDue_ib_b = $data_bancolombia_ib1['order_total_amount_due'];
    $montox_ib_b = $totalDue_ib_b;
    if ($totalDue_ib_b == 0) {
        $montox_ib_b = $totalTax_ib_b;
    }
    $metodo_de_pago_ib1 = $data_bancolombia_ib1['metodo_de_pago'];
    $total_bancolombia_ib1 += $montox_ib_b;
}
foreach ($sql_davivienda_ib1 as $data_davivienda_ib) {
    $totalTax_ib_dv = $data_davivienda_ib['order_total_after_tax'];
    $totalDue_ib_dv = $data_davivienda_ib['order_total_amount_due'];
    $montox_ib_dv = $totalDue_ib_dv;
    if ($totalDue_ib_dv == 0) {
        $montox_ib_dv = $totalTax_ib_dv;
    }
    $metodo_de_pago_ib1 = $data_davivienda_ib['metodo_de_pago'];
    $total_davivienda_ib1 += $montox_ib_dv;
}


    foreach($sql_abonos_ib1 as $data_abono_ib1 ){
        $metodo_de_pago_abono_ib1 = $data_abono_ib1['metodo_de_pago'];
        $abono_ib1 = $data_abono_ib1['nuevo_abono'];
        if($metodo_de_pago_abono_ib1 == "efectivo" ){
            $total_efectivo_ib1 = $total_efectivo_ib1 + $abono_ib1;
        }else if($metodo_de_pago_abono_ib1 == "bancolombia"){
            $total_bancolombia_ib1 = $total_bancolombia_ib1 + $abono_ib1;  
        }else if($metodo_de_pago_abono_ib1 == "davivienda"){
            $total_davivienda_ib1 = $total_davivienda_ib1 + $abono_ib1;
        }else if($metodo_de_pago_abono_ib1 == "datafono"){
            $total_datafono_ib1 = $total_datafono_ib1 + $abono_ib1;
        }
       
    }



// foreach ($sql_multiples as $data_multiple){
  
// }

foreach($sql_cierre_caja_ib1 as $data_cierre){
    $efectivo_ib1 = $data_cierre['efectivo'];
    $bancolombia_ib1 = $data_cierre['bancolombia'];
    $davivienda_ib1 = $data_cierre['davivienda'];
    $datafono_ib1 = $data_cierre['datafono'];
}


//valores finales
// $suma_d1 = $total_efectivo_d1;
$suma_ib1 = $total_datafono_ib1 + $total_bancolombia_ib1 + $total_efectivo_ib1 + $total_davivienda_ib1;
$suma_caja_ib1 = $efectivo_ib1 + $bancolombia_ib1 + $davivienda_ib1 + $datafono_ib1;

?>