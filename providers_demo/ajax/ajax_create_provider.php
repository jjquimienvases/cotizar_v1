<?php

include '../conexion.php';

$compania = $_POST['razon_social'];
$asesor = $_POST['asesor_providers_orders'];
$telefono = $_POST['telefono_fijo_orders'];
$telefono_asesor = $_POST['telefono_asesor_providers'];
$direccion = $_POST['direccion_provider_orders'];
$nit = $_POST['nit'];

//validando datos 


//consultando si ese proveedor ya esta registrado

$sql_proveedor_exist = $con->query("SELECT count(*) as total_proveedores FROM proveedor WHERE nit = $nit");
$data = mysqli_fetch_assoc($sql_proveedor_exist);
$cuenta = $data['total_proveedores'];


if ($cuenta > 0) {
    $did = $con->query("UPDATE proveedor SET empresa = '$compania', asesor = '$asesor', telefono = '$telefono', telefono_asesor = '$telefono_asesor', direccion = '$direccion' WHERE nit = $nit");
} else {
    $did = $con->query("INSERT INTO proveedor (empresa,asesor,telefono,nit,telefono_asesor,direccion) VALUES ('$compania','$asesor','$telefono','$nit','$telefono_asesor','$direccion')");
}

if ($did) {
    echo $compania;
} else {
    echo 0;
}