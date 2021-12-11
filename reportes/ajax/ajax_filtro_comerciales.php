<?php
include "../scripts/consultas_filtro.php";
include "../variables.php";
$data = array();
$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];

foreach ($comerciales as $vendor) {
    array_push($data, [
        "comercial" => $vendor,
        "ventas" => getConsultaUsuarios($vendor, $inicio, $fin)
    ]);
}

echo json_encode($data);
