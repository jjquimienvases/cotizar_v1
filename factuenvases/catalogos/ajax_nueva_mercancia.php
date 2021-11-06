<?php

include "../../globals.php";


$item_id = $_POST['codigo'];
$item_name = $_POST['name'];
$item_unidad = $_POST['empaque'];
$item_new_q = $_POST['cantidad'];
$bodega = $_POST['bodega'];
$provider = $_POST['proveedor'];
$factura_number = $_POST['factura'];
$new_price = $_POST['precio'];
$fecha = DATE("Y-m-d h:m:s");

//AQUI COMIENZO MIS CONSULTAS SQL

$nuevo_stock = 0;
$bodegas_ = ['producto_av', 'producto', 'producto_d1', 'productos_ibague', 'productos_ibague2'];
for ($i = 0; $i < count($item_id); $i++) {

    //seleccionano stock actual
    $con_stock = $cnx->query("SELECT stock FROM $bodega[$i] WHERE id = $item_id[$i]");
    $stock = floatval($con_stock->fetch_row()[0]);
    $nuevo_stock = floatval($stock) + $item_new_q[$i];
    //actualizando stock
    //  $sql_update_s = $cnx->query("UPDATE $bodega[$i] SET stock = $nuevo_stock WHERE id = $item_id[$i]");
    //actualizando las demas bodegas

    $update_bodegas = $cnx->query("UPDATE producto SET gramo = $new_price[$i], unidad = '$item_inidad[$i]' WHERE id = $item_id[$i]");
    $update_bodegas_ = $cnx->query("UPDATE producto_d1 SET gramo = $new_price[$i], unidad = '$item_inidad[$i]' WHERE id = $item_id[$i]");
    $update_bodegas_1 = $cnx->query("UPDATE productos_ibague SET gramo = $new_price[$i], unidad = '$item_inidad[$i]' WHERE id = $item_id[$i]");
    $update_bodegas_2 = $cnx->query("UPDATE productos_ibague2 SET gramo = $new_price[$i], unidad = '$item_inidad[$i]' WHERE id = $item_id[$i]");
    $update_bodegas_3 = $cnx->query("UPDATE producto_av SET gramo = $new_price[$i], unidad = '$item_inidad[$i]' WHERE id = $item_id[$i]");


    //insertando ingreso 

    $sql_ingresos = ("INSERT INTO `ingresos`(`code`, `contratipo`, `cantidad`, `factura`, `Proveedor`, `order_date`) VALUES ($item_id[$i],'$item_name[$i]',$item_new_q[$i],'$factura_number[$i]','$provider[$i]','$fecha')");

    $execute = $cnx->query($sql_ingresos);
    if ($execute) {
        echo 1;
    } else {
        echo $sql_ingresos;
    }
}
