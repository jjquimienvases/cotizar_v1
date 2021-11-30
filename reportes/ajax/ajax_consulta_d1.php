<?php



  $date = date("Y-m-d");
// $date = "2021-03-10";
$total_efectivo_d1 = 0;
$total_datafono_d1 = 0;
$total_bancolombia_d1 = 0;
$total_davivienda_d1 = 0;
$montox_d1_f = [];
$montox_d1_d = [];
$montox_d1_b = [];
$montox_d1_dv = [];
$montox_d1 = [];
$suma_d1 = 0;


if($fecha_inicio == ""){
//consulta de las efectivas punto principal
$sql_efectivo_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradord1' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradord1' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradord1' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = 'mostradord1' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos_d1 = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) = '$date' AND punto_venta = 'mostradord1'");
//consultando pagos multiples
$sql_multiples_d1 = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) = '$date'");
//consultando cierre de caja
$sql_cierre_caja_d1 = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) = '$date' AND punto_venta = 'mostradord1' ");
//configurando informacion
}else{
    //consulta de las efectivas punto principal
$sql_efectivo_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradord1' AND metodo_de_pago = 'efectivo' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_datafono_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradord1' AND metodo_de_pago = 'datafono' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_bancolombia_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradord1' AND metodo_de_pago = 'bancolombia' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");
$sql_davivienda_d1 = $con->query("SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND metodopago = 'mostradord1' AND metodo_de_pago = 'davivienda' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente' ");

//consultando abonos
$sql_abonos_d1 = $con->query("SELECT * FROM file_abono WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostradord1'");
//consultando pagos multiples
$sql_multiples_d1 = $con->query("SELECT * FROM metodos_de_pago mp INNER JOIN factura_orden fo ON mo.order_id = fo.order_id WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final'");
//consultando cierre de caja
$sql_cierre_caja_d1 = $con->query("SELECT * FROM finish_day WHERE DATE(order_date) BETWEEN '$fecha_inicio' AND '$fecha_final' AND punto_venta = 'mostradord1' ");
//configurando informacion
}



//efectivo
foreach ($sql_efectivo_d1 as $data_efectivo_d1) {
    $totalTax_d1_f = $data_efectivo_d1['order_total_after_tax'];
    $totalDue_d1_f = $data_efectivo_d1['order_total_amount_due'];
    $montox_d1_f = $totalDue_d1_f;
    if ($totalDue_d1_f == 0) {
        $montox_d1_f = $totalTax_d1_f;
    }

    $metodo_de_pago_d1 = $data_efectivo_d1['metodo_de_pago'];
    $total_efectivo_d1 += $montox_d1_f;
}

foreach ($sql_datafono_d1 as $data_datafono_d1) {
    $totalTax_d1_d = $data_datafono_d1['order_total_after_tax'];
    $totalDue_d1_d = $data_datafono_d1['order_total_amount_due'];
    $montox_d1_d = $totalDue_d1_d;
    if ($totalDue_d1_d == 0) {
        $montox_d1 = $totalTax_d1_d;
    }
    $metodo_de_pago_d1 = $data_datafono_d1['metodo_de_pago'];
    $total_datafono_d1 += $montox_d1_d;
}

foreach ($sql_bancolombia_d1 as $data_bancolombia_d1) {
    $totalTax_d1_b = $data_bancolombia_d1['order_total_after_tax'];
    $totalDue_d1_b = $data_bancolombia_d1['order_total_amount_due'];
    $montox_d1_b = $totalDue_d1_b;
    if ($totalDue_d1 == 0) {
        $montox_d1_b = $totalTax_d1_b;
    }
    $metodo_de_pago_d1 = $data_bancolombia_d1['metodo_de_pago'];
    $total_bancolombia_d1 += $montox_d1_b;
}
foreach ($sql_davivienda_d1 as $data_davivienda_d1) {
    $totalTax_d1_dv = $data_davivienda_d1['order_total_after_tax'];
    $totalDue_d1_dv = $data_davivienda_d1['order_total_amount_due'];
    $montox_d1_dv = $totalDue_d1_dv;
    if ($totalDue_d1_dv == 0) {
        $montox_d1_dv = $totalTax_d1_dv;
    }
    $metodo_de_pago_d1 = $data_davivienda_d1['metodo_de_pago'];
    $total_davivienda_d1 += $montox_d1_dv;
}


    foreach($sql_abonos_d1 as $data_abono_d1 ){
        $metodo_de_pago_abono_d1 = $data_abono_d1['metodo_de_pago'];
        $abono_d1 = $data_abono_d1['nuevo_abono'];
        if($metodo_de_pago_abono_d1 == "efectivo" ){
            $total_efectivo_d1 = $total_efectivo_d1 + $abono_d1;
        }else if($metodo_de_pago_abono_d1 == "bancolombia"){
            $total_bancolombia_d1 = $total_bancolombia_d1 + $abono_d1;  
        }else if($metodo_de_pago_abono_d1 == "davivienda"){
            $total_davivienda_d1 = $total_davivienda_d1 + $abono_d1;
        }else if($metodo_de_pago_abono_d1 == "datafono"){
            $total_datafono_d1 = $total_datafono_d1 + $abono_d1;
        }
       
    }



// foreach ($sql_multiples as $data_multiple){
  
// }

foreach($sql_cierre_caja_d1 as $data_cierre){
    $efectivo_d1 = $data_cierre['efectivo'];
    $bancolombia_d1 = $data_cierre['bancolombia'];
    $davivienda_d1 = $data_cierre['davivienda'];
    $datafono_d1 = $data_cierre['datafono'];
}


//valores finales
// $suma_d1 = $total_efectivo_d1;
$suma_d1 = $total_datafono_d1 + $total_bancolombia_d1 + $total_efectivo_d1 + $total_davivienda_d1;
$suma_caja_d1 = $efectivo_d1 + $bancolombia_d1 + $davivienda_d1 + $datafono_d1;

?>