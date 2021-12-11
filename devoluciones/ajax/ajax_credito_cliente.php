<?php
include "../scripts/consultas.php";

$cot = $_GET["cotizacion"];

$con = new mysqli('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

$select_cedula = $con->query("SELECT * FROM factura_orden WHERE order_id = $cot");
foreach($select_cedula as $data){
 $cedula = $data['cedula'];
}
// $cot = 76;
echo json_encode(GetCreditoCliente($cedula));