<?php

 
include "../scripts/consultas.php";
include "../variables.php";
$data = array();

foreach($puntos_de_venta as $punto){
    $item = [
        "punto" => $punto,
        "positivo" =>getConsultaPositivos($punto) ,
        "negativo" =>getConsultaNegativos($punto) ,
        "todos" => getConsultaInventarios($punto) ,
        "items" => getConsultaOtrosItems($punto),
        "perfumeria" => getConsultaPerfumeria($punto),
        "perfumeria_ambiental" =>getConsultaPerfumeria_Ambiental($punto)  
    ];
    array_push($data, $item);
}

echo json_encode($data);