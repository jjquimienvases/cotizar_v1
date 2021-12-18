<?php

include '../conexion.php';

$id = $_POST['id'];
$order_id = $_POST['order_id'];

$sql = $con->query("INSERT INTO factura_id (id,order_id) VALUES ($id,$order_id)");

if ($sql) {
    echo $sql;
} else {
    echo 0;
}
