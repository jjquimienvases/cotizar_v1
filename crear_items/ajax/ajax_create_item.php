<?php

include '../conexion.php';
$conexion = conectar();
session_start();
$user = $_SESSION['user'];
$date = date('Y-m-d H:i:s');
$materia = $_POST["materia"];
$presentacion = $_POST["presentacion"];
$envase_presentacion = $_POST['envase_presentacion'];
$tapa_presentacion = $_POST['tapa_presentacion'];
$cantidad = $_POST['cantidad'];
$bodega = $_POST['bodega'];
$gramos = 0;

//Condiciones de gramos por materia
 if($presentacion == "cuarto"){
     $gramos = 125 * $cantidad;
 }else if($presentacion == "media"){
    $gramos = 250 * $cantidad;
 }else if($presentacion == "libra"){
    $gramos = 500 * $cantidad;
 }else if($presentacion == "litro"){
    $gramos = 1000 * $cantidad;
 }else if($presentacion == "galon"){
    $gramos = 3750 * $cantidad;
 }else if($presentacion == "garrafa"){
    $gramos = 20000 * $cantidad;
 }

 $sql_stock = $conexion->query("SELECT * FROM $bodega WHERE id = $materia");
 foreach($sql_stock as $data){
   $stock = $data['stock'];
 }
 $sql_stock = $conexion->query("SELECT * FROM $bodega WHERE id = $envase_presentacion");
 foreach($sql_stock as $data){
   $stock_e = $data['stock'];
 }
 $sql_stock = $conexion->query("SELECT * FROM $bodega WHERE id = $tapa_presentacion");
 foreach($sql_stock as $data){
   $stock_t = $data['stock'];
 }
 $nuevo_stock = $stock - $gramos;
 $nuevo_stock_e = $stock_e - $cantidad;
 $nuevo_stock_t = $stock_t - $cantidad;

try {
    $sql = "INSERT INTO `items_liquidos`( `materia_prima`,`presentacion`, `envase`, `tapa`, `cantidad`, `gramos`, `usuario`, `order_date`) 
    VALUES ($materia,'$presentacion',$envase_presentacion,$tapa_presentacion,$gramos,'$user','$date')";
    $execute = $conexion->query($sql);
    if($execute){
        $sql_ = $conexion->query("UPDATE $bodega SET stock = $nuevo_stock WHERE id = $materia");
        $sql_1 = $conexion->query("UPDATE $bodega SET stock = $nuevo_stock_e WHERE id = $envase_presentacion");
        $sql_2 = $conexion->query("UPDATE $bodega SET stock = $nuevo_stock_t WHERE id = $tapa_presentacion");
        echo $sql_;
    }else{
        echo $sql;
    }
} catch (\Exception $err) {
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "err" => $err
    ]);
    // echo $order_id;
}
