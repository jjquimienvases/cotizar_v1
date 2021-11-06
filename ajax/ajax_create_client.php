<?php

include "../globals.php";

//aqui voy a recibir mis variables

$cedula = $_POST['cedula'];
$name = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$puntos_n = 0;
$puntos_p = 0;
$venta_condicion = $_POST['tipo_cliente'];
//aqui voy a consultar si el cliente exite

$sql = $cnx->query("SELECT * FROM clientes WHERE cedula = $cedula");
$num = mysqli_num_rows($sql);

if ($num > 0) {

    foreach ($sql as $data) {
        $id_client = $data['id'];
    }

    //update
    $sql_update = $cnx->query("UPDATE clientes SET nombres = '$name',direccion = '$direccion', ciudad = '$ciudad', telefono = '$telefono', email = '$email', venta_condicion = '$venta_condicion',cedula = $cedula WHERE id = $id_client");

    if ($sql_update) {
        echo 2;
    } else {
        echo "na";
    }
} else {
    $sql_insert = $cnx->query("INSERT INTO `clientes`(`nombres`, `cedula`, `direccion`, `ciudad`, `telefono`, `email`, `puntos_perfumeria`, `puntos_naturales`, `venta_condicion`, `credito`, `descuento`) 
 VALUES ('$name',$cedula,'$direccion','$ciudad',$telefono,'$email',0,0,'$venta_condicion',0,0)");

    if ($sql_insert) {
        echo 1;
    } else {
        echo "nc";
    }
}
