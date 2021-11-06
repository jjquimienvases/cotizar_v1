<?php

include_once "clases/Conexion.php";

$conexion = new Conexion();
$cnx = $conexion->conectar();
$cnx_pruebas = $conexion->conectar("cotizar");