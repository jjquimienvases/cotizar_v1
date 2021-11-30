<?php 

include "../scripts/consultas.php";

$cot = $_GET["cotizacion"];
// $cot = 76;
echo json_encode(GetConsultaItems($cot));

