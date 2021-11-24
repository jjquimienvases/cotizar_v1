<?php
function conectar()
{
  $servidor = "127.0.0.1";
  $nombreBd = "cotizar";
  $usuario = "cotizar";
  $pass = "LeinerM4ster";
  $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}
