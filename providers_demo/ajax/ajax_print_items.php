<?php
 include "../conexion.php";
/* header('Content-Type: application/json'); */
$response = new stdClass;
$fun = $_POST['key'];


$order = $_POST['order'];
$sql = "SELECT * FROM order_shop_products WHERE order_id = $order";
$r = $con->query($sql);
$retornolosdatos = [];
while ($o = $r->fetch_object()) {
    $retornolosdatos[] = $o;
}
$response->retornolosdatos = $retornolosdatos;
echo json_encode($response);
