<?php

include '../conexion.php';

$asesor = $_POST["asesor"];
$nit = $_POST["nit"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$empresa = $_POST["empresa"];
$tel_asesor = $_POST["telefono_asesor"];
$codigo = $_POST["codigo"];


// print_r($_POST);
// exit;
try {
    $consulta_actualizar = $conexion->query("UPDATE proveedor SET empresa = '$empresa', asesor='$asesor', telefono = $telefono, direccion = '$direccion', telefono_asesor = $tel_asesor, nit = $nit WHERE codigo = $codigo");

    if ($consulta_actualizar) {
        http_response_code(200);
        echo json_encode([
            "title" => "PERFECTO",
            "text" => "Proveedor Actualizado Correctamente",
            "icon" => "success"
        ]);
        return;
    }
    echo "No se pudo actualizar";
    return;
} catch (\Exception $err) {
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "err" => $err
    ]);
}