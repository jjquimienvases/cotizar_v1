<?php
include "../scripts/consultas.php";
include "../../globals.php";

$cot = $_GET["cotizacion"];

$select_cedula = $cnx->query("SELECT * FROM factura_orden WHERE order_id = $cot");
foreach ($select_cedula as $data) {
    $cedula = $data['cedula'];
}
// $cot = 76;
echo json_encode(GetCreditoCliente($cedula));
