<?php


include "../scripts/consultas_sql.php";
include "../variables.php";
$data = array();
$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallIbague2(),
        "pendiente" => getConsultaCallIbague2Pendiente(),
        "no_recoge" => getConsultaCallIbague2NoRecoge(),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallIbague2($metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);