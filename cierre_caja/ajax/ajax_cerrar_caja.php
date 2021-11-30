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

$conexion = conectar();
// $conexion = new mysqli('localhost', 'root', '', 'cotpruebas');
session_start();
$user_rol = $_SESSION['id_rol'];
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['user'];
$date = DATE('Y-m-d');

$punto_de_venta = "";
if ($user_rol == 4) {
    $punto_de_venta = "Call Center";
} else if ($user_rol == 2) {
    $punto_de_venta = "mostradorjj";
} else if ($user_rol == 3) {
    $punto_de_venta = "mostradord1";
} else if ($user_id == 26) {
    $punto_de_venta = "mostrador_ibague_1";
} else if ($user_id == 27) {
    $punto_de_venta = "mostrador_ibague_2";
} else if ($user_id == 20) {
    $punto_de_venta = "Oficina";
} else {
    $punto_de_venta = "Desarrollador";
}

$efectivo = $_POST["efectivo"];
$datafono = $_POST["datafono"];
$davivienda = $_POST["davivienda"];
$bancolombia = $_POST["bancolombia"];
$consulta_verificar = $conexion->query("SELECT * FROM finish_day WHERE punto_venta = '$punto_de_venta' AND order_date LIKE '%$date%' AND id_rol_usuario = $user_id");
$row_cnt = mysqli_num_rows($consulta_verificar);
if ($row_cnt == 0) {
    $consulta_sql = $conexion->query("INSERT INTO finish_day (usuario,punto_venta,id_rol_usuario,efectivo,order_date,datafono,davivienda,bancolombia) VALUES ('$user_name','$punto_de_venta',$user_id,'$efectivo','$date','$datafono','$davivienda','$bancolombia')");
    echo $consulta_sql;
} else {
    echo 0;
}
