<?php


include "../scripts/consultas_sql.php";
include "../variables.php";
$data = array();
$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallIbague(),
        "pendiente" => getConsultaCallIbaguePendiente(),
        "no_recoge" => getConsultaCallIbagueNoRecoge(),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallIbague($metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);