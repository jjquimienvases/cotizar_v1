<?php
function conectar(){
  $servidor="ftp.jjquimienvases.com";
  $nombreBd="jjquimienvases_cotizar";
  $usuario="jjquimienvases_jjadmin";
  $pass="LeinerM4ster";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}
?>

<!--function conectar(){-->
<!--  $servidor="ftp.jjquimienvases.com";-->
<!--  $nombreBd="jjquimienvases_cotizar";-->
<!--  $usuario="jjquimienvases_jjadmin";-->
<!--  $pass="LeinerM4ster";-->
<!--  $conexion = new mysqli($servidor,$usuario-->