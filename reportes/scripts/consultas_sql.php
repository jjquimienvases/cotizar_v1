<?php
// include '../../conexion.php';
include_once '../../clases/Consulta.php';
$c = new Consulta();
// $date = "2021-03-10";+
$date = date("Y-m-d");

function getConsultaMostrador($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = '$punto' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
    if($punto == "bancolombia"){
         $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) LIKE '%$date%' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";
    }

    $result = $c->find($sql);
    return $result;
}

  function getConsultaNewAbono($punto){
        global $c, $date;
        $sql = "SELECT * FROM factura_orden fo INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) = '$date' AND fo.metodopago = '$punto' AND fo.estado != 'solicitud anular' AND fo.estado != 'anulado' AND fo.estado != 'pendiente'";
        if($punto == "bancolombia"){
             $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) LIKE '%$date%' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";
        }
        $result = $c->find($sql);
        return $result;
    }

// function getConsultaCallMostrador() //ventas de call center en el mostrador principal
// {
//     global $c, $date;
//     $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE fm.punto_pago LIKE '%mostrador%' AND fo.order_date LIKE '%$date%'";
//     $result = $c->find($sql);
//     return $result;
// }

function getConsultaCallMostrador() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE fo.order_date LIKE '%$date%' AND fm.bodega = 'mostrador principal' AND fm.estado = 'finalizado'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallMostradorPendiente() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE fo.order_date LIKE '%$date%' AND fm.bodega = 'mostrador principal' AND fm.estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallMostradorNoRecoge() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE fo.order_date LIKE '%$date%' AND fm.bodega = 'mostrador principal' AND fm.estado = 'no_recoge'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosCallMostrador($metodo)
{
    global $c, $date;
    // $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.estado LIKE '%Finalizado%'";
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.bodega = 'mostrador principal' AND fm.estado LIKE '%Finalizado%'";
    $result = $c->find($sql);
    return $result;
}

//consulta call ibague
function getConsultaCallIbague() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague' AND fm.estado LIKE '%finalizado%'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallIbaguePendiente() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE  DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague' AND fm.estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallIbagueNoRecoge() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE  DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague' AND fm.estado = 'no_recoge'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosCallIbague($metodo)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.bodega = 'ibague' AND  fm.estado LIKE '%Finalizado%'";
    $result = $c->find($sql);
    return $result;
}

//fin consulta call ibague

//inicio call center ibague 2
function getConsultaCallIbague2() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE  DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague2' AND fm.estado = 'finalizado'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallIbague2Pendiente() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE  DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague2' AND fm.estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallIbague2NoRecoge() //ventas de call center en el mostrador principal
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE  DATE(fm.order_date) = '$date' AND fm.bodega = 'ibague2' AND fm.estado = 'no_recoge'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosCallIbague2($metodo)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.bodega = 'ibague2' AND  fm.estado LIKE '%Finalizado%'";
    $result = $c->find($sql);
    return $result;
}

//fin call ibague 2
function getConsultaMostradorPendientes($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = '$punto' AND estado LIKE '%pendiente%'";
    if($punto == "bancolombia"){
    $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE fo.estado LIKE '%solicitud%' AND fo.order_date LIKE '%$date%'";
    }

    $result = $c->find($sql);
    return $result;
}

function getConsultaMostradorAnular($punto)
{
    global $c, $date;
    // $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago LIKE '%$punto%' AND estado LIKE '%anulado%' OR estado LIKE '%solicitud anular%'";
    $sql = "SELECT * FROM  factura_orden fo INNER JOIN solicitud_anular sa ON fo.order_id = sa.order_id WHERE fo.metodopago = '$punto' AND (fo.estado LIKE '%solicitud anular%' OR fo.estado LIKE '%anulado%') AND DATE(fo.order_date) = '$date'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMostradorDescuentos($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = '$punto' AND order_tax_per != 0 AND order_tax_per != ''";
    $result = $c->find($sql);
    return $result;
}

function getConsultaUsuarios($comerciales)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND order_receiver_address LIKE '%$comerciales%' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
     if($comerciales == "velasco"){
     $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) LIKE '%$date%' AND (fm.estado LIKE '%pendiente%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND order_receiver_address LIKE '%$comerciales%'";
     } 
    $result = $c->find($sql);
    return $result;
}

function getConsultaDescuentos($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = '$punto' AND order_tax_per != '' || order_tax_per != 0 AND estado != 'anulado' AND estado != 'pendiente'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodos($punto, $metodo)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden WHERE DATE(order_date) = '$date' AND metodopago = '$punto' AND metodo_de_pago LIKE '%$metodo%' AND estado != 'solicitud anular' AND estado != 'anulado' AND estado != 'pendiente'";
      if($punto == "bancolombia"){
     $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) = '$date' AND fo.metodopago = '$punto' AND fo.metodo_de_pago LIKE '%$metodo%' AND (fo.estado != 'pendiente')";
      }
    $result = $c->find($sql);
    return $result;
}

function getConsultaAbonos()
{
    global $c, $date;
    $sql = "SELECT * FROM order_abono WHERE DATE(order_date) = '$date' AND estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaNovedades($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM novedades_gastos WHERE DATE(order_date) LIKE '%$date%' AND punto_venta = '$punto'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosMultiples()
{
    global $c, $date;
    $sql = "SELECT * FROM metodos_de_pago WHERE DATE(order_date) = '$date'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCierreCaja($punto)
{
    global $c, $date;
    $sql = "SELECT * FROM finish_day WHERE punto_venta = '$punto' AND DATE(order_date) = '$date'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCanal($punto, $canal)
{
    global $c, $date;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodopago = '$punto' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%') AND fm.canal LIKE  '%$canal%'";
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
