<?php

$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];
include "../scripts/consulta_call_m.php";
include "../variables.php";



// echo $inicio;

// return;
$data = array();

$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallMostrador($inicio, $fin),
        "pendiente" => getConsultaCallMostradorPendiente($inicio, $fin),
        "no_recoge" => getConsultaCallMostradorNoRecoge($inicio, $fin),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallMostrador($inicio, $fin,$metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);
