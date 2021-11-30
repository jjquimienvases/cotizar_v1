<?php 

 include 'conexion.php';
  session_start();

 $user_rol = $_SESSION['id_rol'];
 $user_name = $_SESSION['user'];
 $user_id = $_SESSION['userid'];
 $nombres = $_SESSION['first_name']." ".$_SESSION['last_name'];
 $punto_de_venta = "";
   
   
   if($user_rol == 4){
       $punto_de_venta = "Call Center";
   }else if($user_rol == 2){
       $punto_de_venta = "Mostrador Principal";
   }else if($user_rol == 3){
       $punto_de_venta = "Mostrador D1";
   }else if($user_id == 26 ){
       $punto_de_venta = "Ibague 1 ";
   }else if($user_id == 27){
       $punto_de_venta = "Ibague 2";
   }else if($user_id == 20){
       $punto_de_venta = "Oficina";
   }else{
       $punto_de_venta = "Desarrollador";
   }
   
  $monto = $_POST['monto']; 
  $novedad = $_POST['novedad'];
  $fecha = date("Y-m-d");
  
     $consulta_sql = $con ->query("INSERT INTO novedades_gastos (novedad,usuario,monto,user_id,punto_venta,order_date) VALUES ('$novedad','$user_name','$monto','$user_id','$punto_de_venta','$fecha')");
       if($consulta_sql){
    //  $consulta_sql = $con ->query("INSERT INTO start_day (usuario,punto_venta,id_rol_usuario,monto,order_date) VALUES ('$user_name','$punto_de_venta',$user_id,'$monto','$fecha')");
         echo $consulta_sql;
    //   echo 0;
  }else{
    //  $consulta_sql = $con ->query("INSERT INTO start_day (usuario,punto_venta,id_rol_usuario,monto,order_date) VALUES ('$user_name','$punto_de_venta',$user_id,'$monto','$fecha'");
      echo 0;
  }


?>