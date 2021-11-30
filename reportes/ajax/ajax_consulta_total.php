<?php
include "../scripts/consultas_sql.php";
include "../variables.php";
$data = array();

foreach ($puntos_de_venta as $punto) {
    $item = [
        "punto" => $punto,
        "pendiente" => getConsultaMostradorPendientes($punto),
        "efectivas" => getConsultaMostrador($punto),
        "descuento" => getConsultaMostradorDescuentos($punto),
        "anulada" => getConsultaMostradorAnular($punto),
        "finish" => getConsultaCierreCaja($punto),
        "novedades" => getConsultaNovedades($punto),
        "abono" => getConsultaNewAbono($punto),
    ];
    $item["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($item["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodos($punto, $metodo)
        ]);
    }
       foreach ($canal as $canales) {
        array_push($item["pago"], [
            "metodo" => $canales,
            "ventas" => getConsultaCanal($punto, $canales)
        ]);
    }

    array_push($data, $item);
}

echo json_encode($data);
