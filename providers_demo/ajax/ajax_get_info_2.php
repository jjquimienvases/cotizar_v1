<?php

include '../conexion.php';

$response = new stdClass;

        $order = $_POST['order'];
        $item_id = $_POST['item_id'];
        $sql = "SELECT * FROM order_shop_products
           WHERE order_id = $order AND item_id = $item_id ";

           
        $r = $con->query($sql);
        if ($o = $r->fetch_object()) {
            $resultado = $o;
        }
        $response->resultado = $resultado;



echo json_encode($response);
