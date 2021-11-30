<?php
include '../conexion.php';


$id = $_POST['id'];
$order = $_POST['order'];
$nuevo_total = "";
$resultado = "";
$sql_consultando = $con->query("SELECT * FROM order_shop_products WHERE id = $id");

foreach ($sql_consultando as $data) {
    $result = $data['item_total'];
}

$sql_get_order = $con->query("SELECT * FROM order_shop_id WHERE id = $id");
foreach ($sql_get_order as $data_order) {
    $monto_order = $data_order['result'];
}

$resultado = $monto_order - $result;
//consultando existencias
$sql_consulta = ("SELECT * FROM order_shop_products WHERE order_id = $order AND estado LIKE '%solicitud%' ORDER BY order_date DESC LIMIT 1");
$execute_consulta = $con->query($sql_consulta);
$existencias = mysqli_num_rows($execute_consulta);

if($existencias == 0  || $existencias <= 1){
    $sql_items = $con->query("DELETE FROM order_shop_products WHERE id = $id");
    $sql_order = $con->query("DELETE FROM order_shop_id WHERE id = $order");
}else{
    $sql_items = $con->query("DELETE FROM order_shop_products WHERE id = $id");
    $update = $con->query("UPDATE order_shop_id SET result = $resultado WHERE order_id = $order");
}

if($sql_items){
    echo $sql_items;
}else{
    echo 0;
}
