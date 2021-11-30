<?php 
 include 'conexion.php';
  session_start();

 $user_rol = $_SESSION['id_rol'];
 $user_name = $_SESSION['user'];
 $user_id = $_SESSION['userid'];
 
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
   
  $monto = $_POST['monto']; 
  $fecha = date("Y-m-d");
   
  $consulta_verificar = $con ->query("SELECT * FROM finish_day WHERE punto_venta = '$punto_de_venta' AND order_date LIKE '%$fecha%' AND id_rol_usuario = $user_id ");

  $row_cnt = mysqli_num_rows($consulta_verificar);
//      if($consulta_verificar){
//       echo $row_cnt."my";
//   }else{
//       echo "leiner";
//   }
  
  if($row_cnt == 0){
     $consulta_sql = $con ->query("INSERT INTO finish_day (usuario,punto_venta,id_rol_usuario,monto,order_date) VALUES ('$user_name','$punto_de_venta',$user_id,'$monto','$fecha')");
     echo $consulta_sql;
    //   echo 0;
  }else{
    //  $consulta_sql = $con ->query("INSERT INTO start_day (usuario,punto_venta,id_rol_usuario,monto,order_date) VALUES ('$user_name','$punto_de_venta',$user_id,'$monto','$fecha'");
      echo 0;
  }
//   if($consulta_sql){
//       echo $consulta_sql;
//   }else{
//       echo 0;
//   }
?>