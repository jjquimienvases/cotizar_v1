<?php

 include '../../globals.php';

  
 $id = $_POST['id'];
 $cedula = $_POST['cedulas'];
 $nombres = $_POST['nombres'];
 $direccion = $_POST['direccion'];
 $ciudad = $_POST['ciudad'];
 $telefono = $_POST['telefono'];
 $email = $_POST['email'];
 $porcentaje = $_POST['porcentaje'];

 $sql = $cnx->query("UPDATE clientes SET cedula = $cedula, nombres = '$nombres', direccion = '$direccion', telefono = '$telefono', ciudad = '$ciudad', email = '$email', descuento = $porcentaje WHERE id = $id ");

 if($sql){
     echo $sql;
 }else{
     echo 0;
 }