<?php

include "../scripts/consultas_filtro.php";
$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];
echo json_encode(getConsultaMostradorPendientes($punto, $inicio, $fin));
