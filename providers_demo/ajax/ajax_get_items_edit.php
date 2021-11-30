<?php
include '../conexion.php';

header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
      $order = $_POST['order'];
      $estado = "solicitud";
      
      $sql = $con->query("UPDATE order_shop_id SET estado = '$estado' WHERE order_id = $order");
      $sql_items = $con->query("UPDATE order_shop_products SET estado = '$estado' WHERE order_id = $order");
      if($sql){
       echo $sql_items;
      }else{ 
          echo 0;
      }  
      break;

      case 'Q2':
      $order = $_POST['order'];
        $sql = "SELECT osp.id,osp.order_id, osi.proveedor, osp.item_name, osp.cantidad, osp.item_unitario, osp.item_total FROM order_shop_id osi INNER JOIN order_shop_products osp ON osi.order_id = osp.order_id WHERE osi.order_id = $order"; 
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

        echo json_encode($response);
    break;
}