<?php
include "../scripts/consultas_sql.php";
include "../variables.php";
$data = array();

foreach ($comerciales as $vendor) {
    array_push($data, [
        "comercial" => $vendor,
        "ventas" => getConsultaUsuarios($vendor)
    ]);
}

echo json_encode($data);
