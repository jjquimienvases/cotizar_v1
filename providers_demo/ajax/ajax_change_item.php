<?php

include '../conexion.php';

$sql = "";

//variables
$order = $_POST['item_order_id'];
$item_id = $_POST['code_item'];
$new_quantity = $_POST['order_item_quantity'];
$new_price = $_POST['item_unitary_price'];

$new_total = $new_price * $new_quantity;
//consultas
$sql_info = $con->query("SELECT * FROM order_shop_products WHERE item_id = $item_id AND order_id = $order");

foreach ($sql_info as $data) {
    $last_price = $data['item_unitario'];
    $last_quantity = $data['cantidad'];
}


$update_item = $con->query("UPDATE order_shop_products SET item_unitario = $new_price, item_total = $new_total, cantidad = $new_quantity WHERE order_id = $order AND item_id = $item_id ");


$insert_info = $con->query("INSERT INTO `shop_items_changes`(`order_id`, `item_id`, `last_quantity`, `new_quantity`, `last_price`, `new_price`) 
 VALUES ($order,$item_id,$last_quantity,$new_quantity,$last_price,$new_price)");

if ($update_item) {
    $sql_get_sum = $con->query("SELECT SUM(item_total) as Total FROM order_shop_products WHERE order_id = $order");
    foreach ($sql_get_sum as $data_sum) {
        $total_order = floatval($data_sum['Total']);
        $sql_update = $con->query("UPDATE order_shop_id SET result = $total_order WHERE order_id = $order");
    }
}

if($sql_update){
    echo $order;
}else{
    echo 0;
}
