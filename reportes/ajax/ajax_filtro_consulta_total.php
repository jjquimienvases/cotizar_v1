<?php

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// $method = $_SERVER['REQUEST_METHOD'];
// if ($method == "OPTIONS") {
//     die();
// }


$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];
include "../scripts/consultas_filtro.php";
include "../variables.php";
$data = array();


// $puntos_de_venta = ["mostradorjj", "mostradord1", "mostrador_ibague_1", "mostrador_ibague_2", "bancolombia"];
// $comerciales = ["tamara", "maria", "sergio", "velasco", "nidia", "karen", "leiner", "michel", "elizabeth", "diego", "linda", "jimenez"];

foreach ($puntos_de_venta as $punto) {
    $item = [
        "punto" => $punto,
        "pendiente" => getConsultaMostradorPendientes($punto, $inicio, $fin),
        "efectivas" => getConsultaMostrador($punto, $inicio, $fin),
        "descuento" => getConsultaMostradorDescuentos($punto, $inicio, $fin),
        "anulada" => getConsultaMostradorAnular($punto, $inicio, $fin),
        "finish" => getConsultaCierreCaja($punto, $inicio, $fin),
        "novedades" => getConsultaNovedades($punto,$inicio, $fin),
        "abono" => getConsultaNewAbono($punto,$inicio, $fin),
    ];
    $item["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($item["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodos($punto, $metodo, $inicio, $fin)
        ]);
    }
       foreach ($canal as $canales) {
        array_push($item["pago"], [
            "metodo" => $canales,
            "ventas" => getConsultaCanal($punto, $canales,$inicio, $fin)
        ]);
    }
    array_push($data, $item);
}

echo json_encode($data);
