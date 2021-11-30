<?php
function conectar(){
  $servidor="173.230.154.140";
  $nombreBd="jjquimienvases";
  $usuario="root";
  $pass="pthEY89$/g4e=";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}

$conexion = conectar();
 ?>
