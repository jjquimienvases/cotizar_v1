<?php

include '../conexion.php';
session_start();

// require '../../vendor/autoload.php';
// use Automattic\WooCommerce\Client;

$user = $_SESSION['user'];
$date_time = date('Y-m-d H:m:s');
$item_id = $_POST['id'];
$item_name = $_POST['item'];
$stock = $_POST['stock'];
$rol = $_POST['rol'];
$user_id = $_POST['user_id'];
$ubicacion = $_POST['ubicacion'];
$unidad = $_POST['unidad'];
$costo = $_POST['Costo'];
$categoria = $_POST['categoria'];
$minima = $_POST['minima'];
$maxima = $_POST['maxima'];
$p_name = $_POST['proveedor_name'];
$sql = "";
$bodega = "";
if ($rol == 2) {
    $bodega = "producto";
} else if ($rol == 3) {
    $bodega = "producto_d1";
} else if ($user_id == 26) {
    $bodega = "productos_ibague";
} else if ($user_id == 27) {
    $bodega = "productos_ibague2";
} else if ($rol == 7) {
    $bodega = "productos_ibague";
} else if ($rol == 6) {
    $bodega = "producto_av";
} else {
    $bodega = "producto_av";
}




$search_stock = $conexion->query("SELECT * FROM $bodega WHERE id = $item_id");
foreach($search_stock as $data_stock){
    $stock_anterior = $data_stock['stock'];
}



if ($rol == 5 or $rol == 1 or $rol == 8) {
 
    
        $sql_op =$conexion->query("UPDATE producto SET contratipo = '$item_name', gramo = $costo, id_categoria = $categoria, unidad = '$unidad', minimo = $minima, maximo = $maxima,visibilidad = 1 WHERE id = $item_id");
            $sql_op_1 = $conexion->query("UPDATE producto_d1 SET contratipo = '$item_name', gramo = $costo, id_categoria = $categoria, unidad = '$unidad', minimo = $minima, maximo = $maxima, visibilidad = 1 WHERE id = $item_id");
                    $sql_op_2 =$conexion->query("UPDATE productos_ibague SET contratipo = '$item_name', gramo = $costo, id_categoria = $categoria, unidad = '$unidad', minimo = $minima, maximo = $maxima, visibilidad = 1 WHERE id = $item_id");
                            $sql_op_3 = $conexion->query("UPDATE productos_ibague2 SET contratipo = '$item_name', gramo = $costo, id_categoria = $categoria, unidad = '$unidad', minimo = $minima, maximo = $maxima,visibilidad = 1 WHERE id = $item_id");
        
    
    $sql = $conexion->query("UPDATE producto_av SET stock = $stock, contratipo = '$item_name', gramo = $costo, id_categoria = $categoria, ubicacion = '$ubicacion', unidad = '$unidad', minimo = '$minima', maximo = '$maxima',  name_prov = '$p_name' WHERE id = $item_id");
} else {
    $sql_av = "UPDATE $bodega SET ubicacion = '$ubicacion', unidad = '$unidad' WHERE id = $item_id";
    $sql_ = "UPDATE $bodega SET stock = $stock,ubicacion = '$ubicacion', unidad = '$unidad' WHERE id = $item_id";
}



//APARTADO PARA ACTUALIZAR INFORMACION EN LA TIENDA
// formula para obtener precios de venta 
include '../formulas.php';

if ($rol == 5 or $rol == 1 or $rol == 8) {
   
     
    if($sql){
       $sql_insert_update = $conexion->query("INSERT INTO changes_stock (item_id,contratipo,cantidad_editada,cantidad_anterior,usuario,order_date) VALUES ($item_id,'$item_name',$stock,$stock_anterior,'$user','$date_time')");    
    }else{
        echo $sql;
        
    }
} else if ($user_id == 26) {
    $execute = $conexion->query($sql_);
       if($execute){
       $sql_insert_update = $conexion->query("INSERT INTO changes_stock (item_id,contratipo,cantidad_editada,cantidad_anterior,usuario,order_date) VALUES ($item_id,'$item_name',$stock,$stock_anterior,'$user','$date_time')");    
    }else{
        echo "El error es".mysqli_error();
    }
} else if ($user_id == 37) {
    $execute = $conexion->query($sql_av);
       if($execute){
       $sql_insert_update = $conexion->query("INSERT INTO changes_stock (item_id,contratipo,cantidad_editada,cantidad_anterior,usuario,order_date) VALUES ($item_id,'$item_name',$stock,$stock_anterior,'$user','$date_time')");    
    }else{
        echo "El error es".mysqli_error();
    }
} else {
    echo 0;
}

echo $sql_insert_update;
