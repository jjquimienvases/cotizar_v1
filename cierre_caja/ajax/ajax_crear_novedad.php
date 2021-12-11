<?php
 include '../conexion.php';
 session_start();
 $user_rol = $_SESSION['id_rol'];
 $user_id = $_SESSION['userid'];
 $user_name = $_SESSION['user'];
 $date = DATE('Y-m-d');

 $punto_de_venta = "";
 if($user_rol == 4){
     $punto_de_venta = "Call Center";
 }else if($user_rol == 2){
     $punto_de_venta = "mostradorjj";
 }else if($user_rol == 3){
     $punto_de_venta = "mostradord1";
 }else if($user_id == 26 ){
     $punto_de_venta = "mostrador_ibague_1";
 }else if($user_id == 27){
     $punto_de_venta = "mostrador_ibague_2";
 }else if($user_id == 20){
     $punto_de_venta = "Oficina";
 }else{
     $punto_de_venta = "Desarrollador";
 }


 $novedad = $_POST['novedad'];
 $monto = $_POST['monto']; 

 $consulta_sql = $conexion->query("INSERT INTO novedades_gastos (novedad,usuario,monto,user_id,punto_venta,order_date) VALUES ('$novedad','$user_name','$monto','$user_id','$punto_de_venta','$date')");
 if($consulta_sql){
   echo $consulta_sql;
}else{
echo 0;
}