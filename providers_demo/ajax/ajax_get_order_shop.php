<?php 
include '../conexion.php';
header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
       
/*     $sql = "SELECT osp.id,osp.order_id, osi.proveedor, osp.item_name, osp.cantidad, osp.item_unitario, osp.item_total FROM order_shop_id osi INNER JOIN order_shop_products osp ON osi.order_id = osp.order_id WHERE osi.estado LIKE '%solicitud%'"; 
 */    $sql = "SELECT * FROM order_shop_id WHERE estado != 'solicitud' ORDER BY order_date";  
    $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);