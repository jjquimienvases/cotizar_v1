<?php
function conectar()
{
  $servidor = "173.230.154.140";
  $nombreBd = "cotizar";
  $usuario = "cotizar";
  $pass = "LeinerM4ster";
  $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}