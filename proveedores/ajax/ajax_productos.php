<?php

include '../conexion.php';

$precio = $_POST['precio'];
$producto = $_POST['producto'];
$proveedor = $_POST['proveedor'];


$sqlExist = $conexion->query("SELECT * FROM proveedor_producto WHERE producto_id = '$producto' AND proveedor_id = '$proveedor'");
if (mysqli_num_rows($sqlExist) > 0) {
    $sqlUpdate = "UPDATE proveedor_producto SET precio = '$precio' WHERE producto_id = '$producto' AND proveedor_id = '$proveedor'";

    $did = mysqli_query($conexion, $sqlUpdate);
    // echo "<pre>";
    // print_r($sqlUpdate);
    // echo "</pre>";
    // exit;
} else {

    $sqlInsertar = "INSERT INTO proveedor_producto (proveedor_id, producto_id, precio) VALUES ('$proveedor','$producto','$precio')";

    // echo "<pre>";
    // print_r($sqlInsertar);
    // echo "</pre>";
    // exit;
    $did = mysqli_query($conexion, $sqlInsertar);
}
//aqui la consulta para asignar 



echo $did;
