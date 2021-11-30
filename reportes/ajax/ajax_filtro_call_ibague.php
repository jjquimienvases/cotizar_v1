<?php

$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];
include "../scripts/consulta_call_i.php";
include "../variables.php";



// echo $inicio;

// return;
$data = array();

$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallIbague($inicio, $fin),
        "pendiente" => getConsultaCallIbaguePendiente($inicio, $fin),
        "no_recoge" => getConsultaCallIbagueNoRecoge($inicio, $fin),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallIbague($inicio, $fin,$metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);