<?php

include '../conexion.php';

$response = new stdClass;

$order = $_POST['factura'];
$sql = "SELECT * FROM file_order_shop WHERE factura = $order";


$r = $con->query($sql);
if ($o = $r->fetch_object()) {
    $resultado = $o;
}
$response->resultado = $resultado;



echo json_encode($response);
