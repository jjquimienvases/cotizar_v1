<?php

include '../conexion.php';

$codigo = $_POST["codigo"];




try {
    $consulta_delete = $conexion->query("DELETE FROM proveedor WHERE codigo = $codigo");
    if ($consulta_delete) {
        http_response_code(200);
        echo json_encode([
            "title" => "PERFECTO",
            "text" => "Este proveedor fue eliminado correctamente",
            "icon" => "success"
        ]);
        return;
    }
    echo "No se pudo Eliminar";
    return;
} catch (\Exception $err) {
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "err" => $err
    ]);
}
