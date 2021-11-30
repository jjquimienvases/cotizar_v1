<?php

 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];

 
 //variables e informacion
 $id_proveedor = intval($_POST['id_proveedor']);
 $proveedor = $_POST['proveedor'];
 $costo = floatval($_POST['costo']);
 $item_code = $_POST['item_id'];
 $item_name = $_POST['producto_name'];
 $quantity = $_POST['cantidad'];
 $resultado = floatval($_POST['resultado']);
 $estado = "solicitud";
 $date = DATE("Y-m-d H:i:s");




 //consultando si existe un traspaso abierto   
$sql_consulta = ("SELECT * FROM order_shop_id WHERE id_proveedor = $id_proveedor AND estado LIKE '%solicitud%' ORDER BY order_date DESC LIMIT 1");
$execute_consulta = $con->query($sql_consulta);
$existencias = mysqli_num_rows($execute_consulta);


if ($existencias != 0) {
    foreach ($execute_consulta as $data) {
        $order = $data['order_id'];
        $total_registrado = $data['result'];
        $nuevo_result = $total_registrado + $resultado;
        $sql_insert_item = $con->query("INSERT INTO `order_shop_products`(`order_id`, `id_proveedor`, `item_id`, `item_name`, `cantidad`,`estado`, `item_unitario`, `item_total`, `order_date`) 
        VALUES ($order,$id_proveedor,$item_code,'$item_name',$quantity,'$estado',$costo,$resultado,'$date')");
}
    if ($sql_insert_item) {
        $update = $con->query("UPDATE order_shop_id SET result = $nuevo_result WHERE order_id = $order");
        echo "i_a";
    } else {
        echo 0;
    }
} else {
    $sql_insert  = $con->query("INSERT INTO `order_shop_id`(`id_proveedor`, `proveedor`, `user_create`, `estado`, `result`, `order_date`) 
 VALUES ($id_proveedor,'$proveedor','$user','$estado',$resultado,'$date')");

    $last_insert = mysqli_insert_id($con);
    $sql_insert_item = "INSERT INTO `order_shop_products`(`order_id`, `id_proveedor`, `item_id`, `item_name`,`cantidad` ,`estado`, `item_unitario`, `item_total`, `order_date`) 
 VALUES ($last_insert,$id_proveedor,$item_code,'$item_name',$quantity,'$estado',$costo,$resultado,'$date')";
    $execute = $con->query($sql_insert_item);

  
    if ($execute) {
        echo $last_insert;
    } else {
        echo 0;
    }
}
