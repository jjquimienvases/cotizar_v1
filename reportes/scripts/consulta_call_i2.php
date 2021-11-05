<?php
include_once '../../clases/Consulta.php';
$c = new Consulta();

function getConsultaCallIbague2($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.estado LIKE '%Finalizado%' AND fm.bodega = 'ibague2'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaCallIbague2Pendiente($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.bodega = 'ibague2' AND fm.estado = 'pendiente'";
    $result = $c->find($sql);
    return $result;
}
function getConsultaCallIbague2NoRecoge($inicio, $fin) //ventas de call center en el mostrador principal
{
    global $c;
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fm.bodega = 'ibague2' AND fm.estado = 'no_recoge'";
    $result = $c->find($sql);
    return $result;
}

function getConsultaMetodosCallIbague2($inicio, $fin,$metodo)
{
    global $c;
    // $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fo.order_date) = '$date' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.estado LIKE '%Finalizado%'";
    $sql = "SELECT * FROM factura_orden fo INNER JOIN call_punto_de_venta fm ON fo.order_id = fm.order_id WHERE DATE(fm.order_date) BETWEEN '$inicio' AND '$fin' AND fo.metodo_de_pago LIKE '%$metodo%' AND fm.bodega = 'ibague2' AND fm.estado LIKE '%Finalizado%'";
    $result = $c->find($sql);
    return $result;
}