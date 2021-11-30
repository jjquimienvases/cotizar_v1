<?php

include '../conexion.php';
header('Content-Type: application/json');
$response = new stdClass;

$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
        $id = $_POST['order'];
        $sql = "SELECT * FROM order_shop_id
                 WHERE order_id = $id";
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;
        break;
}

echo json_encode($response);
