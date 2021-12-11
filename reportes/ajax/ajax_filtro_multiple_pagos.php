<?php

include "../scripts/consultas_filtro.php";
$inicio = $_GET["fecha_inicio"];
$fin = $_GET["fecha_final"];

// $inicio = "2021-06-21";
// $fin = "2021-06-25";

echo json_encode(getConsultaMetodosMultiples($inicio, $fin));
