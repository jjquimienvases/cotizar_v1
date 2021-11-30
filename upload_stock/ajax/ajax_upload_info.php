<?php
include '../conexion.php';


$item_id = $_POST['id'];
$item_name = $_POST['contratipo'];
$last_stock = $_POST['stock'];
$new_stock = $_POST['new_stock'];
$bodega = $_POST['bodega'];
$user = $_POST['user_name'];
$user_id = $_POST['user_id'];
$date = DATE('Y-m-d H:m:s');
$status = "pendiente";


//consulta, exite este dato registrado?
$sql_consulta = $con->query("SELECT * FROM stocks_upload_information WHERE id_user = $user_id AND item_code = $item_id AND status = '$status'");

if( mysqli_num_rows($sql_consulta) > 0 ){
    foreach($sql_consulta as $data){
        $code = $data['item_code'];
        $stocks = $data['new_stock'];
        if($item_id == $code){
            $nuevo_stocks = $stocks + $new_stock;
            $sql_update = $con->query("UPDATE stocks_upload_information SET new_stock = $nuevo_stocks WHERE item_code = $code AND id_user = $user_id AND status = 'pendiente'");
        }
    }
    if($sql_update){
        echo $sql_update;
    }else{
        echo 0;
    }
    
}else{
     $sql_insert = $con->query("INSERT INTO `stocks_upload_information`(`item_code`, `item_name`, `last_stock`, `new_stock`, `user`, `order_date`, `status`,`id_user`,`bodega`)
 VALUES ($item_id,'$item_name',$last_stock,$new_stock,'$user','$date','$status',$user_id,'$bodega')");

 if($sql_insert){
     echo $sql_insert;
 }else{
     echo 0;
 }
}




