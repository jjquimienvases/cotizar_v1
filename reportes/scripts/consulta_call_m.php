<?php
// include '../../conexion.php';
include_once '../../clases/Consulta.php';
$c = new Consulta();

function getConsultaCallMostrador($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.bodega = 'mostrador principal' AND fm.estado = 'finalizado' ";
    $result = $c->find($sql);
    return $result;
}

function getConsultaCallMostradorPendiente($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.bodega = 'mostrador principal' AND fm.estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallMostradorNoRecoge($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.bodega = 'mostrador principal' AND fm.estado = 'no_recoge'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosCallMostrador($inicio, $fin,$metodo)
{
    global $c;
    // $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.estado LIKE '%Finalizado%'";
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.bodega = 'mostrador principal' AND fm.estado LIKE '%Finalizado%'";
    $result = $c->find($sql);
    return $result;
}