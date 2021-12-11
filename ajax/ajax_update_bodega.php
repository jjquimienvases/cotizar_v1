<?php

$con = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');  

$id = $_POST['id'];
$unidad = $_POST['unidad'];
$ubicacion = $_POST['ubicacion'];

$puntos = ['producto','producto_av','producto_d1','productos_ibague','productos_ibague2'];

foreach($puntos as $punto){
    if($punto == "producto_av"){
      $sql = $con->query("UPDATE $punto SET ubicacion ='$ubicacion', unidad = '$unidad' WHERE id = $id");
    }else{
      $sql = $con->query("UPDATE $punto SET unidad = '$unidad' WHERE id = $id");
    }
} 

if($sql){
    echo $id;
}else{
    echo 0;
}