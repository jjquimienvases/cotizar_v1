<?php

include '../conexion.php';


$fun = $_POST['key'];
if ($fun == "Q1") {
    $valor = $_POST['valor'];
    $sql = "SELECT * FROM factura_orden WHERE order_id = $valor";
    $r = $con->query($sql);
    $retornolosdatos = [];
    while ($o = $r->fetch_object()) {
        $retornolosdatos[] = $o;
    }
    $response->retornolosdatos = $retornolosdatos;
    echo json_encode($response);
} else if ($fun == "Q2") {
    $valor = $_POST['valor_'];
    $sql = "SELECT * FROM traspaso_orden WHERE transfer_id = $valor";
    $r = $con->query($sql);
    $retornolosdatos = [];
    while ($o = $r->fetch_object()) {
        $retornolosdatos[] = $o;
    }
    $response->retornolosdatos = $retornolosdatos;
    echo json_encode($response);
} 