<?php

include 'conexion.php';



$bodega_receiver_id = 0;

$bodega_send_id = 0;

$codigo = 0;

$info_adicional = "";

$estado = "solicitud";





//aqui vamos a capturar los datos

 $producto = $_POST['producto'];

 $codigo = $_POST['codigo'];

 $cantidad = $_POST['cantidad'];

 $bodegaSend = $_POST['bodega_origen'];

 $bodegaReceiver = "";

 $rol_usuario = $_POST['rol'];
 $user_id = $_POST['user_id'];
 $categoria = $_POST['categoria'];



   if ($rol_usuario == 1) {

     $bodegaReceiver = "producto_av";

   }else if($rol_usuario == 2){

     $bodegaReceiver = "producto";

   }else if($rol_usuario == 3){

     $bodegaReceiver = "producto_d1";

   }else if($rol_usuario == 4 OR $rol_usuario == 6){

     $bodegaReceiver = "producto_av";

   }else if($user_id == 27){
       $bodegaReceiver = "productos_ibague2";
   }else if($rol_usuario == 7){

     $bodegaReceiver = "productos_ibague";

   }
   else if($rol_usuario == 9){

     $bodegaReceiver = "producto_av";

   }

 $solicita = $_SESSION['user'];



 // Bodega Salida id

   if ($bodegaSend != "") {

       if ($bodegaSend == "producto") {

            $bodega_send_id = 2;

       }else if($bodegaSend == "producto_av"){

            $bodega_send_id = 4;

       }else if($bodegaSend == "producto_d1"){

            $bodega_send_id = 3;

       }else{

            $bodega_send_id = 7;

       }

   }

   // bodega de entrada id

   if (isset($bodegaReceiver)) {

       if ($bodegaReceiver == "producto") {

            $bodega_receiver_id = 2;

       }else if($bodegaReceiver == "producto_av"){

            $bodega_receiver_id = 4;

       }else if($bodegaReceiver == "producto_d1"){

            $bodega_receiver_id = 3;

       }else{

            $bodega_receiver_id = 7;

       }

   }

// fin ID bodegas





//consultas de insercion

$sqlInsertSolicitud = "INSERT INTO traspasos (codigo, producto, cantidad, bodega_salida, bodega_entrada, solicita, estado,aprueba, empaca,id_rol_bodega_salida,id_rol_bodega_entrada,id_categoria)

VALUES ('$codigo','$producto','$cantidad','$bodegaSend','$bodegaReceiver','$solicita','$estado','$info_adicional','$info_adicional','$bodega_send_id','$bodega_receiver_id','$categoria')";





$did = mysqli_query($conexion, $sqlInsertSolicitud);



echo $did;







 ?>