<?php
// include '../../conexion.php';
include_once '../../clases/Consulta.php';
$c = new Consulta();

function getConsultaMostrador($punto, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago = '$punto' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
 if($punto == "bancolombia"){
         $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";
    }
    $result = $c->find($sql);
    return $result;
}
  function getConsultaNewAbono($punto, $inicio, $fin){
        global $c;
        $sql = "SELECT * FROM factura_orden fo INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) BETWEEN '$inicio' AND '$fin' AND fo.metodopago = '$punto' AND fo.estado != 'solicitud anular' AND fo.estado != 'anulado' AND fo.estado != 'pendiente'";
        if($punto == "bancolombia"){
             $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) BETWEEN '$inicio' AND '$fin' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";
        }
        $result = $c->find($sql);
        return $result;
    }


function getConsultaMostradorPendientes($punto, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago = '$punto' AND estado LIKE '%pendiente%'";

    $result = $c->find($sql);
    return $result;
}

function getConsultaMostradorAnular($punto, $inicio, $fin)
{
    global $c;
    // $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago LIKE '%$punto%' AND estado LIKE '%anulado%' OR estado LIKE '%solicitud anular%'";
        $sql = "SELECT * FROM  factura_orden fo INNER JOIN solicitud_anular sa ON fo.order_id = sa.order_id WHERE fo.metodopago = '$punto' AND (fo.estado LIKE '%solicitud anular%' OR fo.estado LIKE '%anulado%') AND DATE(fo.order_date) BETWEEN '$inicio' AND '$fin'";

    $result = $c->find($sql);
    return $result;
}

function getConsultaMostradorDescuentos($punto, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago = '$punto' AND order_tax_per != 0 AND order_tax_per != ''";
    $result = $c->find($sql);
    return $result;
}

function getConsultaUsuarios($comerciales, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND order_receiver_address LIKE '%$comerciales%' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
    if($comerciales == "velasco"){
    $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$inicio' AND '$fin' AND (fm.estado LIKE '%solicitud%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fo.order_receiver_address LIKE '%$comerciales%' ";
    }
    $result = $c->find($sql);
    return $result;
}

function getConsultaDescuentos($punto, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago = '$punto' AND order_tax_per != '' || order_tax_per != 0 AND estado != 'anulado' AND estado != 'pendiente'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodos($punto, $metodo, $inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND metodopago = '$punto' AND metodo_de_pago LIKE '%$metodo%' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
    if($punto == "bancolombia"){
     $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.metodopago LIKE '%$metodo%' AND (fo.estado != 'pendiente')";

    }
    $result = $c->find($sql);
    return $result;
}

function getConsultaAbonos($inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM order_abono WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin' AND estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaNovedades($punto,$inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM novedades_gastos WHERE (DATE(order_date) BETWEEN '$inicio' AND '$fin') AND punto_venta = '$punto'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosMultiples($inicio, $fin)
{
    global $c;
    $sql = "SELECT * FROM metodos_de_pago WHERE DATE(order_date) BETWEEN '$inicio' AND '$fin'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCierreCaja($punto, $inicio, $fin)
{
    global $c, $date;
    $sql = "SELECT * FROM finish_day WHERE punto_venta = '$punto' AND DATE(order_date) BETWEEN '$inicio' AND '$fin'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCanal($punto, $canal,$inicio, $fin)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) BETWEEN '$inicio' AND '$fin' AND fo.metodopago = '$punto' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE  '%$canal%'";
    $result = $c->find($sql);
    return $result;
}

// function getConsultaCall()
// {
//     global $c, $date;
//     $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE fm. LIKE '%mostrador%' AND fo.order_date LIKE '%$date%'";
//     $result = $c->find($sql);
//     return $result;
// }
