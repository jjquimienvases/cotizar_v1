<?php

//  include '../conexion.php';
 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');
  
 $id = $_POST['id'];
 $cedula = $_POST['cedulas'];
 $nombres = $_POST['nombres'];
 $direccion = $_POST['direccion'];
 $ciudad = $_POST['ciudad'];
 $telefono = $_POST['telefono'];
 $email = $_POST['email'];
 $porcentaje = $_POST['porcentaje'];

 $sql = $con->query("UPDATE clientes SET cedula = $cedula, nombres = '$nombres', direccion = '$direccion', telefono = '$telefono', ciudad = '$ciudad', email = '$email', descuento = $porcentaje WHERE id = $id ");

 if($sql){
     echo $sql;
 }else{
     echo 0;
 }