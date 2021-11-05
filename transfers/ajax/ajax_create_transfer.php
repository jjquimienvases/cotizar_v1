<?php
include '../conexion.php';
session_start();
$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
$bodega_entrada = "";
$estado = "pendiente";
$date = date("Y-m-d h:i:s");

if ($user_rol == 2) {
    $bodega_entrada = "producto";
} else if ($user_rol == 3) {
    $bodega_entrada = "producto_d1";
} else if ($user_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($user_rol == 4) {
    $bodega_entrada = "producto_av";
} else if ($user_id == 27) {
    $bodega_entrada = "productos_ibague2";
} else if ($user_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}


//variables
$item_code = $_POST['item_code'];
$item_name = $_POST['item_name'];
$bodega_salida = $_POST['bodega_salida'];
$quantity = $_POST['quantity'];
$gr_actual = $_POST['gramos_actuales'];

//debo cambiar la logica para que 

#Primero debe consultar si tiene traspaso en pendiente, si es asi, vamos a seguir metiendo productos a ese traspaso (cha)
#debe verficar si los productos que se estan solicitando son de la misma bodega, si son de bodegas diferentes hacer traslados diferentes (NO ES NECESARIO);
#dependiendo de la bodega, si ahi traslados en piende de dichas bodegas segui metiendo productos segun seleccione el usuario
#en caso tal de que las primeras condiciones no se cumplan, generar un nuevo ingreso de traslado (order - items) 
#hacer que el boton de finalizar solicitud cambie el estado del traspaso y los productos a solicitud_finalizada
#en la tabla de informacion mostrar la informacion apartir de la persona qe esta conectada, poner condiciones para que puedan ver
#los productos que tengan en pendiente pero si es la bodega que empaca y despacha solo puede ver las que estan en solicitud finalizada



//consultando si existe un traspaso abierto   
$sql_consulta = $con->query("SELECT * FROM traspaso_orden WHERE bodega_entrada = '$bodega_entrada' AND estado LIKE '%pendiente%' ORDER BY order_date DESC LIMIT 1");
$existencias = mysqli_num_rows($sql_consulta);


if ($existencias != 0) {
    foreach ($sql_consulta as $data) {
        $order = $data['transfer_id'];
        $sql_exist_item = $con->query("SELECT * FROM traspaso_producto_id WHERE item_code = $item_code AND transfer_id = $order");
        $existencia_item = mysqli_num_rows($sql_exist_item);
        if($existencia_item != 0){
            foreach($sql_exist_item as $data_item){
              $cantidad_registrada = $data_item['item_quantity'];
              $id_ = $data_item['id'];
              $new_quantity = $cantidad_registrada  + $quantity; 
              $sql_update_items = $con->query("UPDATE traspaso_producto_id SET item_quantity = $new_quantity WHERE id = $id_");
            }

            if($sql_update_items){
                echo $sql_update_items;
            }else{
                echo 0;
            }
        }else{
        $sql_insert_item = $con->query("INSERT INTO `traspaso_producto_id`(`transfer_id`, `item_code`, `item_name`, `item_quantity`, `bodega_entrada`, `bodega_salida`, `item_status`, `order_date`,`gr_actual`) 
        VALUES ($order,$item_code,'$item_name',$quantity,'$bodega_entrada','$bodega_salida','$estado','$date',$gr_actual)");
        
        if ($sql_insert_item) {
            echo $sql_insert_item;
        } else {
            echo 0;
        }
    }
}
} else {
    $sql_insert  = $con->query("INSERT INTO `traspaso_orden`(`solicitante`, `bodega_entrada`, `bodega_salida`, `estado`, `order_date`) 
 VALUES ('$user','$bodega_entrada','$bodega_salida','$estado','$date')");
    $last_insert = mysqli_insert_id($con);
    $sql_insert_item = "INSERT INTO `traspaso_producto_id`(`transfer_id`, `item_code`, `item_name`, `item_quantity`, `bodega_entrada`, `bodega_salida`, `item_status`, `order_date`,`gr_actual`) 
 VALUES ($last_insert,$item_code,'$item_name',$quantity,'$bodega_entrada','$bodega_salida','$estado','$date',$gr_actual)";
    $execute = $con->query($sql_insert_item);

  
    if ($execute) {
        echo $execute;
    } else {
        echo 0;
    }
}



