<?php

include '../conexion.php';

$compania = $_POST['empresa'];
$asesor = $_POST['asesor'];
$telefono = $_POST['telefono'];
$telefono_asesor = $_POST['tel_asesor'];
$direccion = $_POST['direccion'];
$nit = $_POST['nit'];

//validando datos 


//consultando si ese proveedor ya esta registrado

$sql_proveedor_exist = $conexion->query("SELECT count(*) as total_proveedores FROM proveedor WHERE nit = $nit");
$data = mysqli_fetch_assoc($sql_proveedor_exist);
$cuenta = $data['total_proveedores'];


if ($cuenta > 0) {
    $did = $conexion->query("UPDATE proveedor SET empresa = '$compania', asesor = '$asesor', telefono = '$telefono', telefono_asesor = '$telefono_asesor', direccion = '$direccion' WHERE nit = $nit");
} else {
    $did = $conexion->query("INSERT INTO proveedor (empresa,asesor,telefono,nit,telefono_asesor,direccion) VALUES ('$compania','$asesor','$telefono','$nit','$telefono_asesor','$direccion')");
}

if ($did) {
    echo $did;
} else {
    echo 0;
}
