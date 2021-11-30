<?php
include "../scripts/consultas.php";

$cot = $_GET["cotizacion"];

include "../conexion.php";
$select_cedula = $con->query("SELECT * FROM factura_orden WHERE order_id = $cot");
foreach($select_cedula as $data){
 $cedula = $data['cedula'];
}
// $cot = 76;
echo json_encode(GetCreditoCliente($cedula));