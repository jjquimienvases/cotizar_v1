<?php


include "../scripts/consultas_sql.php";
include "../variables.php";
$data = array();
$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallMostrador(),
        "pendiente" => getConsultaCallMostradorPendiente(),
        "no_recoge" => getConsultaCallMostradorNoRecoge(),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallMostrador($metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);
