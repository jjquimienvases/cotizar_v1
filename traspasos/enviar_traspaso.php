<?php
$conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

  $bodega_receiver_id = 0;
  $bodega_send_id = 0;
  $codigo = 0;
  $info_adicional = "";
  $estado = "solicitud";
 //aqui vamos a capturar los datos
  $producto = $_POST['producto'];
  $codigo = $_POST['codigo'];
  $cantidad = $_POST['cantidad'];
  $bodegaSend = $_POST['envia'];
  $bodegaReceiver = $_POST['recibe'];
  $solicita = $_POST['solicita'];
  
  
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


//consulta SQL

// $sqlInsertSolicitud = "INSERT INTO traspasos (codigo, producto, cantidad, bodega_salida, bodega_entrada, solicita, estado)
// VALUES ('$codigo','$producto','$cantidad','$bodegaSend','$bodegaReceiver','$solicita','$estado')";

$sqlInsertSolicitud = "INSERT INTO traspasos (codigo, producto, cantidad, bodega_salida, bodega_entrada, solicita, estado,aprueba, empaca,id_rol_bodega_salida,id_rol_bodega_entrada)
VALUES ('$codigo','$producto','$cantidad','$bodegaSend','$bodegaReceiver','$solicita','$estado','$info_adicional','$info_adicional','$bodega_send_id','$bodega_receiver_id')";


$did = mysqli_query($conexion, $sqlInsertSolicitud);


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//
//    return;

  echo $did;
 ?>
