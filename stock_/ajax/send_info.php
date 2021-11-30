<?php

 include '../conexion.php';
session_start();
$user = $_SESSION['user'];
$id_rol = $_SESSION['id_rol'];
$date = date('Y-m-d');
$status = "pendiente";
//variables
$sku = $_POST['id'];
$item = $_POST['contratipo'];
$antiguo_stock = $_POST['stock'];
$nuevo_stock = $_POST['nuevo_stock'];


// print_r($_POST);

// return;
 
$sql_consulta = $conexion->query("SELECT * FROM stocks_uploads WHERE id_rol = $id_rol AND sku = $sku AND estado = 'pendiente'");
if( mysqli_num_rows($sql_consulta) > 0 ){
    foreach($sql_consulta as $data){
        $code = $data['sku'];
        $stocks = $data['nuevo_stock'];
        if($sku == $code){
            $nuevo_stocks = $stocks + $nuevo_stock;
            $sql_update = $conexion->query("UPDATE stocks_uploads SET nuevo_stock = $nuevo_stocks WHERE sku = $sku AND id_rol = $id_rol AND estado = 'pendiente'");
        }
    }
    if($sql_update){
        echo $sql_update;
    }else{
        echo 0;
    }
    
}else{
     $sql =$conexion->query("INSERT INTO `stocks_uploads`(`sku`, `contratipo`, `nuevo_stock`, `antiguo_stock`, `usuario`, `id_rol`, `fecha`,`estado`) 
     VALUES ($sku,'$item',$nuevo_stock,$antiguo_stock,'$user',$id_rol,'$date','$status')") ;
    
    //  $execute = $conexion->query($sql);
    
     if($sql){
         echo $sql;
     }else{
         echo 0;
     }
}