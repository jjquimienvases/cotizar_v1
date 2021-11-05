<?php
function conectar(){
  $servidor="localhost";
  $nombreBd="cotpruebas";
  $usuario="root";
  $pass="";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}
?>
