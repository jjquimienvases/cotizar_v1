<?php

$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];
include "../scripts/consulta_call_i2.php";
include "../variables.php";



// echo $inicio;

// return;
$data = array();

$items_ = [];
    $items_ = [
        "finalizada" => getConsultaCallIbague2($inicio, $fin),
        "pendiente" => getConsultaCallIbague2Pendiente($inicio, $fin),
        "no_recoge" => getConsultaCallIbague2NoRecoge($inicio, $fin),
    ];
   
    $items_["pago"] = [];
    foreach ($metodos as $metodo) {
        array_push($items_["pago"], [
            "metodo" => $metodo,
            "ventas" => getConsultaMetodosCallIbague2($inicio, $fin,$metodo)
        ]);
    }

    array_push($data, $items_);


echo json_encode($data);