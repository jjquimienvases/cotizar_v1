<?php


include "../scripts/consultas_filtro.php";
include "../variables.php";
$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];

foreach ($puntos_de_venta as $punto) {
    
echo json_encode(getConsultaNovedades($punto,$inicio, $fin));
}
